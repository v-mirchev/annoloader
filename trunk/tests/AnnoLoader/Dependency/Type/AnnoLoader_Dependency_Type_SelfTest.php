<?php

require_once 'PHPUnit/Framework.php';

/**
 * Test class for AnnoLoader_Dependency_Type_Self.
 * Generated by PHPUnit on 2011-02-25 at 15:57:21.
 */
class AnnoLoader_Dependency_Type_SelfTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var AnnoLoader_Dependency_Type_Self
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new AnnoLoader_Dependency_Type_Self;

		$this->object->setFilesList(array
		(
			JS_PATH.'/DependencyTypeFile/1.js' => true,
			JS_PATH.'/DependencyTypeFile/2.js' => true,
		));

		$this->object->setBasePath(JS_PATH);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{

	}

	public function testGetFiles()
	{
		$dependency = 'DependencyTypeFile/1.js';

		$this->assertEquals
		(
			array(JS_PATH.'/DependencyTypeFile/1.js'),
			$this->object->getFiles($dependency, JS_PATH.'/DependencyTypeFile/1.js')
		);

		$dependency = 'DependencyTypeFile/2.js';
		$this->assertEquals
		(
			array(JS_PATH.'/DependencyTypeFile/2.js'),
			$this->object->getFiles($dependency, JS_PATH.'/DependencyTypeFile/2.js')
		);
	}
}

?>