<?php

require_once 'PHPUnit/Framework.php';

require_once CLASS_PATH . '/AnnoLoader/Dependency/Builder/File.php';

/**
 * Test class for AnnoLoader_Dependency_Builder_File.
 * Generated by PHPUnit on 2011-01-15 at 13:15:26.
 */
class AnnoLoader_Dependency_Builder_FileTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var AnnoLoader_Dependency_Builder_File
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new AnnoLoader_Dependency_Builder_File;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {

	}

    public function dataProvider_testSetGetName()
    {
        return array
		(
          array('file1', 'file1'),
          array('file2', 'file2'),
          array('file3', 'file3'),
          array('file4', 'file4'),
        );
    }

	/**
     * @dataProvider dataProvider_testSetGetName
     */
	public function testSetGetName($setName, $getName)
	{
		$this->object->setName($setName);
		$this->assertEquals($getName, $this->object->getName());
	}

	public function testIncreaseGetPriority()
	{
		$this->assertEquals(0, $this->object->getPriority(), 'Priority should be zero after initializing.');

		$this->object->increasePriority();
		$this->assertEquals(1, $this->object->getPriority());
		$this->object->increasePriority();
		$this->assertEquals(2, $this->object->getPriority());

		$this->object->increasePriority(3);
		$this->assertEquals(5, $this->object->getPriority());
		$this->object->increasePriority(10);
		$this->assertEquals(15, $this->object->getPriority());
	}


	public function testIncreasePriorityDependant()
	{
		$dependencyFile1 = new AnnoLoader_Dependency_Builder_File('file1');
		$dependencyFile2 = new AnnoLoader_Dependency_Builder_File('file1');

		$this->object->addDependant($dependencyFile1);
		$this->assertEquals(0, $this->object->getPriority());
		$this->assertEquals(1, $dependencyFile1->getPriority());

		$this->object->increasePriority();
		$this->assertEquals(1, $this->object->getPriority());
		$this->assertEquals(2, $dependencyFile1->getPriority());

		$this->object->increasePriority();
		$this->assertEquals(2, $this->object->getPriority());
		$this->assertEquals(3, $dependencyFile1->getPriority());


		$dependencyFile1->addDependant($dependencyFile2);
		$this->assertEquals(4, $dependencyFile2->getPriority());

		$this->object->increasePriority();
		$this->assertEquals(3, $this->object->getPriority());
		$this->assertEquals(4, $dependencyFile1->getPriority());
		$this->assertEquals(5, $dependencyFile2->getPriority());

		$dependencyFile1->increasePriority();
		$this->assertEquals(3, $this->object->getPriority());
		$this->assertEquals(5, $dependencyFile1->getPriority());
		$this->assertEquals(6, $dependencyFile2->getPriority());

		$dependencyFile2->increasePriority();
		$this->assertEquals(3, $this->object->getPriority());
		$this->assertEquals(5, $dependencyFile1->getPriority());
		$this->assertEquals(7, $dependencyFile2->getPriority());
	}


	public function testAddDependant()
	{
		$dependencyFile1 = new AnnoLoader_Dependency_Builder_File('file1');
		$dependencyFile2 = new AnnoLoader_Dependency_Builder_File('file1');

		$this->object->addDependant($dependencyFile1);
		$this->assertEquals(0, $this->object->getPriority());
		$this->assertEquals(1, $dependencyFile1->getPriority());

		$this->object->addDependant($dependencyFile2);
		$this->assertEquals(0, $this->object->getPriority());
		$this->assertEquals(1, $dependencyFile1->getPriority());
		$this->assertEquals(1, $dependencyFile2->getPriority());
	}

	public function testAddDependantSecondLevel()
	{
		$dependencyFile1 = new AnnoLoader_Dependency_Builder_File('file1');
		$dependencyFile2 = new AnnoLoader_Dependency_Builder_File('file1');

		$this->object->addDependant($dependencyFile1);
		$this->assertEquals(0, $this->object->getPriority());
		$this->assertEquals(1, $dependencyFile1->getPriority());

		$dependencyFile1->addDependant($dependencyFile2);
		$this->assertEquals(0, $this->object->getPriority());
		$this->assertEquals(1, $dependencyFile1->getPriority());
		$this->assertEquals(2, $dependencyFile2->getPriority());
	}

	public function test__clone() 
	{
		$clone = clone $this->object;

		$this->assertEquals(0, $clone->getPriority());
	}

	public function test__toString()
	{
		$this->object->setName('testName');
		$this->assertEquals('testName', $this->object->__toString());
	}

	public function test_setHasRequirements()
	{
		$this->assertFalse($this->object->hasRequirements());

		$this->object->setHasRequirements();
		$this->assertTrue($this->object->hasRequirements());
	}
}

?>
