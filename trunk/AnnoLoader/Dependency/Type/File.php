<?php
/**
 * Description of File
 *
 * @author vladsun
 */
class AnnoLoader_Dependency_Type_File extends AnnoLoader_Dependency_Type_Abstract
{
	public function getFiles($dependency, $currentFile)
	{
		$path = realpath($this->basePath.'/'.$dependency);

		if (!isset($this->files[$path]))
			throw new AnnoLoader_Dependency_Type_Exception ("File [ $path ], defined in [ $currentFile ] does not exist.");
		
		return array($path);
	}
}
