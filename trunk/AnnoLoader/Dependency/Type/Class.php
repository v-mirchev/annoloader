<?php
/**
 * Description of Class
 *
 * @author vladsun
 */
class AnnoLoader_Dependency_Type_Class extends AnnoLoader_Dependency_Type_Abstract
{
	public function getFiles($dependency, $currentFile)
	{
		$fileName	= $this->namespace->map($dependency);

		if (false === $path = realpath($this->basePath.'/'.$fileName.'.'.$this->extension))
			throw new AnnoLoader_Dependency_Type_Exception ("Class:: File [ $this->basePath.'/'.$fileName.'.'.$this->extension ], defined in [ $currentFile ] does not exist.");


		if (!isset($this->files[$path]))
			throw new AnnoLoader_Dependency_Type_Exception ("Class:: File [ $path ], defined in [ $currentFile ] does not exist.");

		return array($path);
	}
}