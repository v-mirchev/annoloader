<?php

require_once 'PHPUnit/Framework.php';

require_once CLASS_PATH .'/AnnoLoader/Dependency/Reader/Annotation.php';
require_once CLASS_PATH .'/AnnoLoader/Dependency/Reader/Exception.php';

/**
 * Test class for AnnoLoader_Dependency_Reader_Annotation.
 * Generated by PHPUnit on 2011-01-14 at 14:07:53.
 */
class AnnoLoader_Dependency_Reader_AnnotationTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var AnnoLoader_Dependency_Reader_Annotation
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
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

		$this->object = new AnnoLoader_Dependency_Reader_Annotation('annoloader', $this->keywords, $this->aliasMap);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {

	}

	/**
	 * @expectedException AnnoLoader_Dependency_Reader_Exception
	 */
	public function testReadException()
	{
		$this->object->read(JS_PATH . '/AnnotationReader/exception.js');
	}
	
	public function testRead()
	{
		$actualResult = $this->object->read(JS_PATH . '/AnnotationReader/test.js');

		$expectedResult = array
		(
			"requires-file"	=> array
			(
				"1.js",
				"2.js",
			),
			
			"requires-class"	=> array
			(
				"Ext.Namespace.Class1",
				"Ext.Namespace.Class2",
			),

			"requires-namespace"	=> array
			(
				"Ext.Namespace",
			),

			"requires-directory"	=> array
			(
				"ex/grid",
			),

			"requires-directory-tree"	=> array
			(
				"ex/data",
			),
		);

		$this->assertEquals($expectedResult, $actualResult, 'Annotations read do not match expected.');
	}

	public function testRead_Empty()
	{
		$actualResult = $this->object->read(JS_PATH . '/AnnotationReader/empty.js');
		$this->assertTrue(empty($actualResult), 'No annotations should be read.');

		$actualResult = $this->object->read(JS_PATH . '/AnnotationReader/emptyAnno.js');
		$this->assertTrue(empty($actualResult), 'No annotations should be read.');
	}

	public function testRead_WrongNamespace()
	{
		$actualResult = $this->object->read(JS_PATH . '/AnnotationReader/wrongNamespace.js');
		$this->assertTrue(empty($actualResult), 'No annotations should be read.');
	}

}

?>