<?php

class AnnoLoader_Dependency_Reader_Annotation
{
	protected $namespace = '';
	protected $aliasMap;

	protected $keywords = array();

	public function __construct($namespace, $keywords, $aliasMap = array())
	{
		$this->namespace	= $namespace ? trim($namespace, '- ').'-' : '';
		$this->aliasMap		= $aliasMap	? $aliasMap : array();
		$this->keywords		= $keywords ? $keywords : array();
	}

	protected function getAnnotation($annotationName)
	{
		if (isset($this->keywords[$annotationName]))
			return $annotationName;

		if (isset($this->aliasMap[$annotationName]) && isset($this->keywords[$this->aliasMap[$annotationName]]))
			return $this->aliasMap[$annotationName];

		return false;
	}

	function read($fileName, $size = 4096)
	{
		if (!file_exists($fileName))
			throw new AnnoLoader_Dependency_Reader_Exception('File [ '.$filename.' ] does not exist');

		$docs = file_get_contents($fileName, false, null, 0, $size);

		if (preg_match('#/\*\*(.+)?\*/#s', $docs, $docs) === false)
			return false;

		unset($docs[0]);

		if (preg_match_all('#^\s*\*\s*@'. $this->namespace .'(?<key>[a-zA-Z_0-9-]+)(?<value>.+)?$#m', $docs[1], $docs) === false)
			return false;

		unset($docs[0]);
		unset($docs[1]);
		unset($docs[2]);

		$annotations = array();

		foreach ($docs['key'] as $ix => $annotationName)
		{
			if (false === $annotationName = $this->getAnnotation($annotationName))
				throw new AnnoLoader_Dependency_Reader_Exception('Dependency annotation [ '.$annotationName.' ] not recognized');

			$annotationValue = $docs['value'][$ix];

			if (!isset($annotations[$annotationName]))
				$annotations[$annotationName] = array();

			$annotations[$annotationName][$ix] = trim($annotationValue);
		}

		return $annotations;
	}
}
