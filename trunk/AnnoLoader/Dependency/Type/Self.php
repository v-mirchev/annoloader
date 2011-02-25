<?php
/**
 * Description of File
 *
 * @author vladsun
 */
class AnnoLoader_Dependency_Type_Self extends AnnoLoader_Dependency_Type_Abstract
{
	public function getFiles($dependency, $currentFile)
	{
		return array($currentFile);
	}
}
