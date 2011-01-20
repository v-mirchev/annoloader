<?php
/**
 * Description of Null
 *
 * @author vladsun
 */
class AnnoLoader_Cache_Null extends AnnoLoader_Cache_Abstract
{
	public function __construct()
	{

	}

	public function read()
	{
		return false;
	}

	public function write($content) {}
}
