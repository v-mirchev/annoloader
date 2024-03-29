<?php

require_once 'PHPUnit/Framework.php';

require_once CLASS_PATH.'/AnnoLoader/Namespace/Map.php';
require_once CLASS_PATH.'/AnnoLoader/Namespace/Mapper.php';

/**
 * Test class for AnnoLoader_Namespace_Mapper.
 * Generated by PHPUnit on 2011-01-14 at 15:41:30.
 */
class AnnoLoader_Namespace_MapperTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var AnnoLoader_Namespace_Mapper
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		$this->object = new AnnoLoader_Namespace_Mapper();
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {

	}

    public function test__forceIgnoreWarningsOnTestsWithoutDatasets()
    {

	}

    public function dataProvider_testMapWithoutNamespaces()
    {
        return array
		(
			array('', ''),
			array('Ext', 'Ext'),
			array('Ext.grid', 'Ext/grid'),
			array('Ext.grid.Panel', 'Ext/grid/Panel'),
			array('Ext.grid.Panel.plugins', 'Ext/grid/Panel/plugins'),

			array('Ext.ex.grid.Panel.plugins', 'Ext/ex/grid/Panel/plugins'),
			array('Ext.ux.grid.Panel.plugins', 'Ext/ux/grid/Panel/plugins'),
        );
    }


	/**
     * @dataProvider dataProvider_testMapWithoutNamespaces
     */
	public function testMapWithoutNamespaces($className, $expectedPath)
	{
		$this->object = new AnnoLoader_Namespace_Mapper(new AnnoLoader_Namespace_Map(array()));
		$this->assertEquals($expectedPath, $this->object->map($className));
	}

    public function dataProvider_testMapWithNamespaces()
    {
        return array
		(
			array('', ''),
			array('Ext', 'Ext'),
			array('Ext.grid', 'Ext/grid'),
			array('Ext.grid.Panel', 'Ext/grid/Panel'),
			array('Ext.grid.Panel.plugins', 'Ext/grid/Panel/plugins'),

			array('Ext.ex.grid.Panel.plugins', 'lib/ex/grid/Panel/plugins'),
			array('Ext.ux.grid.Panel.plugins', 'lib/ux/grid/Panel/plugins'),
        );
    }


	/**
     * @dataProvider dataProvider_testMapWithNamespaces
     */
	public function testMapWithNamespaces($className, $expectedPath)
	{
		$this->object = new AnnoLoader_Namespace_Mapper(new AnnoLoader_Namespace_Map(array
		(
			'Ext.ex'	=> 'lib/ex',
			'Ext.ux'	=> 'lib/ux',
		)));
		$this->assertEquals($expectedPath, $this->object->map($className));
	}

}

?>
