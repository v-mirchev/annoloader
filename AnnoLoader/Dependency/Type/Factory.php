<?php
/**
 * Description of Factory
 *
 * @author vladsun
 */
class AnnoLoader_Dependency_Type_Factory
{
	public static $types = array();

	/**
	 *
	 * @param string $dependencyName
	 * @return AnnoLoader_Dependency_Type_Abstract
	 */
	public function create($dependencyName)
	{
		if (empty(self::$types[$dependencyName]))
		{
			switch ($dependencyName)
			{
				case 'requires-file'		: 
					self::$types[$dependencyName] = new AnnoLoader_Dependency_Type_File();
					break;
				case 'required'		:
					self::$types[$dependencyName] = new AnnoLoader_Dependency_Type_Self();
					break;
				case 'requires-class'		:
					self::$types[$dependencyName] = new AnnoLoader_Dependency_Type_Class();
					break;
				case 'requires-namespace'		:
					self::$types[$dependencyName] = new AnnoLoader_Dependency_Type_Namespace();
					break;
				case 'requires-directory'		 :
					self::$types[$dependencyName] = new AnnoLoader_Dependency_Type_Directory_Single();
					break;
				case 'requires-directory-tree' :
					self::$types[$dependencyName] = new AnnoLoader_Dependency_Type_Directory_Tree();
					break;
				default:
					throw new AnnoLoader_Dependency_Type_Exception('Dependency rule ['. $dependencyName .'] not recognized.');
			}
		}

		return self::$types[$dependencyName];
	}
}
