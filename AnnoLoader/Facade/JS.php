<?php
/**
 * Description of JS
 *
 * @author vladsun
 */
class AnnoLoader_Facade_JS
{
	protected $namespaceMap = null;
	protected $basePath		= '';
	protected $extension	= 'js';

	protected $listBuilder;

	public $keywords;
	public $aliasMap;
	public $annotationNamespace = 'annoloader';

	public function __construct($basePath, $namespaceMap, $extension = 'js')
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

		$this->aliasMap = array
		(
			'after-file'				=> 'requires-file',
			'after-class'				=> 'requires-class',
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

	public function write($output = false, $jsmin = false, $namer = true)
	{
		$writer = new AnnoLoader_Writer($this->listBuilder);

		if ($jsmin)
			$writer->addFilter(new Annoloader_Writer_Filter_JSMin());

		if ($namer)
			$writer->addFilter(new Annoloader_Writer_Filter_Namer());

		if (!$output)
			return $writer->write(false);

		$writer->write(true);
		return null;
	}
}
