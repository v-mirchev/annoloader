<?php
/**
 * Description of Deirectory
 *
 * @author vladsun
 */
class AnnoLoader_Dependency_Type_Directory_Single extends AnnoLoader_Dependency_Type_Abstract
{
	public function getFiles($dependency, $currentFile)
	{
		if (false === $dependency = realpath($this->basePath.'/'.$dependency))
			throw new AnnoLoader_Dependency_Type_Exception ("Directory [ $dependency ], defined in [ $currentFile ] does not exist.");

		$paths = array();

		foreach ($this->files as $path => $value)
		{
			$path_parts = pathinfo($path);

			if ($path_parts['dirname'] == $dependency)
				$paths[] = $path;
		}

		return $paths;
	}
}
