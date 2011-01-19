<?php
/**
 * Description of JS
 *
 * @author vladsun
 */
class AnnoLoader_Facade_CSS extends AnnoLoader_Facade_Abstract
{
	public function __construct($basePath, $namespaceMap, $extension = 'css')
	{
		parent::__construct($basePath, $namespaceMap, $extension);

		$this->aliasMap = array
		(
			'after-file'				=> 'requires-file',
			'after-class'				=> 'requires-class',
		);

	}
	public function write($output = false, $namer = true)
	{
		$writer = new AnnoLoader_Writer($this->listBuilder);

		if ($namer)
			$writer->addFilter(new AnnoLoader_Writer_Filter_Namer());

		if (!$output)
			return $writer->write(false);

		$writer->write(true);
		return null;
	}
}
