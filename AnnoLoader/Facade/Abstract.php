<?php
/**
 * Description of Abstract
 *
 * @author vladsun
 */
class AnnoLoader_Facade_Abstract
{
	protected $namespaceMap = null;
	protected $basePath		= '';
	protected $extension	= 'css';

	protected $listBuilder;

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

}
