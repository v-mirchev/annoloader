<?php
/**
 * Description of Class
 *
 * @author vladsun
 */
class AnnoLoader_Dependency_Type_Namespace extends AnnoLoader_Dependency_Type_Abstract
{
	public function getFiles($dependency, $currentFile)
	{
		$dependency	= $this->namespace->map($dependency.'.');

		if (false === $dependency = realpath($this->basePath.'/'.$dependency))
			throw new AnnoLoader_Dependency_Type_Exception ("Namespace:: File [ $this->basePath.'/'.$fileName.'.'.$this->extension ], defined in [ $currentFile ] does not exist.");

		$paths = array();
		foreach ($this->files as $path => $value)
		{
			$path_parts = pathinfo($path);

			if (strpos($path_parts['dirname'].'/', realpath($dependency).'/') === 0)
				$paths[] = $path;
		}

		return $paths;
	}
}