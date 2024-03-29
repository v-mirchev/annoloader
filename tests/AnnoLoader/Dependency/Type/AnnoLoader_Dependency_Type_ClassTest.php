<?php

require_once 'PHPUnit/Framework.php';

require_once CLASS_PATH.'/AnnoLoader/Dependency/Type/Class.php';
require_once CLASS_PATH.'/AnnoLoader/Dependency/Type/Exception.php';
require_once CLASS_PATH.'/AnnoLoader/Namespace/Map.php';
require_once CLASS_PATH.'/AnnoLoader/Namespace/Mapper.php';

/**
 * Test class for AnnoLoader_Dependency_Type_Class.
 * Generated by PHPUnit on 2011-01-17 at 14:08:24.
 */
class AnnoLoader_Dependency_Type_ClassTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var AnnoLoader_Dependency_Type_Class
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		$this->object = new AnnoLoader_Dependency_Type_Class;

		$this->object->setFilesList(array
		(
			JS_PATH.'/DependencyTypeClass/ex/data/Store.js' => true,
			JS_PATH.'/DependencyTypeClass/ex/data/Record.js' => true,
		));

		$this->object->setBasePath(JS_PATH);
		$this->object->setExtension('js');
		$this->object->setNamespace(new AnnoLoader_Namespace_Mapper(new AnnoLoader_Namespace_Map(array
		(
			'Ext.ex'	=> 'DependencyTypeClass/ex',
		))));
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {

	}

	/**
	 * @covers AnnoLoader_Dependency_Type_Class::getFiles
	 */
	public function testGetFiles()
	{
		$dependency = 'Ext.ex.data.Store';
		$this->assertEquals(array(JS_PATH.'/DependencyTypeClass/ex/data/Store.js'), $this->object->getFiles($dependency, 'test'));
		$dependency = 'Ext.ex.data.Record';
		$this->assertEquals(array(JS_PATH.'/DependencyTypeClass/ex/data/Record.js'), $this->object->getFiles($dependency, 'test'));
	}

	/**
	 * @covers AnnoLoader_Dependency_Type_Class::getFiles
	 * @expectedException AnnoLoader_Dependency_Type_Exception
	 */
	public function testGetFilesException()
	{
		$dependency = 'Ext.ex.form.Panel';
		$this->object->getFiles($dependency, 'test');
	}
}

?>
