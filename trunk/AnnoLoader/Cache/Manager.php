<?php
/**
 * Description of Manager
 *
 * @author vladsun
 */
class AnnoLoader_Cache_Manager extends AnnoLoader_Cache_Abstract
{
	public function read()
	{
		if (file_exists($this->cachePath))
			return "/** CACHED!!! /* \n\n ".file_get_contents($this->cachePath);
		else
			return false;
	}

	public function write($content)
	{
		file_put_contents($this->cachePath, $content);
	}
}
