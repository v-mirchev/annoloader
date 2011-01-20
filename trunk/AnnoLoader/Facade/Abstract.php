<?php
/**
 * Description of Abstract
 *
 * @author vladsun
 */
class AnnoLoader_Facade_Abstract
{
	public $namespaceMap = null;
	public $basePath		= '';
	public $extension	= 'css';

	public $listBuilder;
	public $cacheManager = null;

	public $keywords;
	public $aliasMap;
	public $annotationNamespace = 'annoloader';

	
	public function __construct($basePath, $namespaceMap, $extension)
	{
		$this->basePath		= $basePath;
		$this->namespaceMap = $namespaceMap;
		$this->extension	= $extension;

		$this->keywords = array
		(
			'requires-file'				=> true,
			'requires-class'			=> true,
			'requires-directory-tree'	=> true,
			'requires-directory'		=> true,
			'requires-namespace'		=> true,
		);

		$this->setCacheManager(null);
	}

	public function setCacheManager($cacheManager)
	{
		$this->cacheManager = $cacheManager ? $cacheManager : new AnnoLoader_Cache_Null();
	}

	public function build()
	{
		$this->listBuilder = new AnnoLoader_Dependency_Builder_List
		(
			$this->basePath,
			$this->extension,
			new AnnoLoader_Namespace_Mapper(new AnnoLoader_Namespace_Map($this->namespaceMap)),
			new AnnoLoader_Directory_Iterator(),
			new AnnoLoader_Dependency_Builder_File(),
			new AnnoLoader_Dependency_Reader_Annotation($this->annotationNamespace, $this->keywords, $this->aliasMap),
			new AnnoLoader_Dependency_Type_Factory()
		);

		$this->listBuilder->build();
	}

	public function output($output = false)
	{
		if (false !== $content = $this->cacheManager->read())
		{
			if ($output)
			{
				echo $content;
				return null;
			}
			else
			{
				return $content;
			}
		}

		$this->build();
		$content = $this->write(false);

		$this->cacheManager->write($content);

		if ($output)
			echo $content;
		else
			return $content;
	}

	protected function write($output = false)
	{

	}

}
