<?php
/**
 * Description of JS
 *
 * @author vladsun
 */
class AnnoLoader_Facade_JS extends AnnoLoader_Facade_Abstract
{
	public function __construct($basePath, $namespaceMap = array(), $extension = 'js')
	{
		parent::__construct($basePath, $namespaceMap, $extension);
	}

	public function write($output = false, $jsmin = false, $namer = true)
	{
		$writer = new AnnoLoader_Writer($this->listBuilder->get());

		if ($jsmin)
			$writer->addFilter(new Annoloader_Writer_Filter_JSMin());

		if ($namer)
			$writer->addFilter(new Annoloader_Writer_Filter_Namer());

		if (!$output)
			return $writer->write(false);

		$writer->write(true);
		return null;
	}
}
