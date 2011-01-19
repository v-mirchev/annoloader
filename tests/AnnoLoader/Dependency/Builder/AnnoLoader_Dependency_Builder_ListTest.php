<?php

require_once 'PHPUnit/Framework.php';

require_once CLASS_PATH . '/AnnoLoader/Dependency/Builder/List.php';

/**
 * Test class for AnnoLoader_Dependency_Builder_List.
 * Generated by PHPUnit on 2011-01-17 at 14:30:48.
 */
class AnnoLoader_Dependency_Builder_ListTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var AnnoLoader_Dependency_Builder_List
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		$this->keywords = array
		(
			'requires-file'				=> true,
			'requires-class'			=> true,
			'requires-directory-tree'	=> true,
			'requires-directory'		=> true,
			'requires-namespace'		=> true,
		);

		$this->aliasMap = array
		(
			'after-file'				=> 'requires-file',
			'after-class'				=> 'requires-class',
		);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{

	}

	public function testBuildFileDependencyOnly()
	{
		$this->object = new AnnoLoader_Dependency_Builder_List
		(
			JS_PATH.'/DependencyListBuilder/FileDependency/',
			'js',
			new AnnoLoader_Namespace_Mapper(new AnnoLoader_Namespace_Map(array
			(
			))),
			new AnnoLoader_Directory_Iterator(),
			new AnnoLoader_Dependency_Builder_File(),
			new AnnoLoader_Dependency_Reader_Annotation('annoloader', $this->keywords, $this->aliasMap),
			new AnnoLoader_Dependency_Type_Factory()
		);

		$expectedList = array
		(
			0 => JS_PATH . '/DependencyListBuilder/FileDependency/ux/0.js',
			1 => JS_PATH . '/DependencyListBuilder/FileDependency/ex/1.js',
			2 => JS_PATH . '/DependencyListBuilder/FileDependency/ex/2.js',
			3 => JS_PATH . '/DependencyListBuilder/FileDependency/ex/3.js',
			4 => JS_PATH . '/DependencyListBuilder/FileDependency/ex/4.js',
		);

		$this->object->build();
		
		$fileList = $this->object->get();
		$filePathsList = array();
		
		foreach ($fileList as $fileListItem)
		{
			$filePathsList[] = $fileListItem->__toString();
		}

		print_r($fileList);

		$this->assertEquals($expectedList, $filePathsList);
	}

	public function testBuildClassDependencyOnly()
	{
		$this->object = new AnnoLoader_Dependency_Builder_List
		(
			JS_PATH.'/DependencyListBuilder/ClassDependency/',
			'js',
			new AnnoLoader_Namespace_Mapper(new AnnoLoader_Namespace_Map(array
			(
				'Ext.ex'	=> 'ex',
				'Ext.ux'	=> 'ux',
			))),
			new AnnoLoader_Directory_Iterator(),
			new AnnoLoader_Dependency_Builder_File(),
			new AnnoLoader_Dependency_Reader_Annotation('annoloader', $this->keywords, $this->aliasMap),
			new AnnoLoader_Dependency_Type_Factory()
		);

		$expectedList = array
		(
			0 => JS_PATH . '/DependencyListBuilder/ClassDependency/ux/0.js',
			1 => JS_PATH . '/DependencyListBuilder/ClassDependency/ex/1.js',
			2 => JS_PATH . '/DependencyListBuilder/ClassDependency/ex/2.js',
			3 => JS_PATH . '/DependencyListBuilder/ClassDependency/ex/3.js',
			4 => JS_PATH . '/DependencyListBuilder/ClassDependency/ex/4.js',
		);


		$this->object->build();

		$fileList = $this->object->get();
		$filePathsList = array();

		foreach ($fileList as $fileListItem)
		{
			$filePathsList[] = $fileListItem->__toString();
		}
		$this->assertEquals($expectedList, $filePathsList);
	}

}

?>
