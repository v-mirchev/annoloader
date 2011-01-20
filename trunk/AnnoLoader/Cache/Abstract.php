<?php
/**
 * Description of Abstract
 *
 * @author vladsun
 */
abstract class AnnoLoader_Cache_Abstract
{
	public function __construct($cachePath)
	{
		$this->cachePath = $cachePath;
	}

	abstract public function read();
	abstract public function write($content);
}
