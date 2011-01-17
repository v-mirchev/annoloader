<?php

class AnnoLoader_Namespace_Mapper
{
	/**
	 *
	 * @var AnnoLoader_Namespace_Map
	 */
	protected $namespaceMap = null;

	public function __construct($namespaceMap = null)
	{
		$this->namespaceMap = $namespaceMap;
	}

	public function setNamespaceMap($namespaceMap)
	{
		$this->namespaceMap = $namespaceMap;
	}

	public function getNamespaceMap()
	{
		return $this->namespaceMap;
	}

	protected function findNamespacePath($classNameParts)
	{
		if (count($classNameParts) <= $this->namespaceMap->getNamespaceLength())
			return false;

		$namespace = implode('.', array_slice($classNameParts, 0, $this->namespaceMap->getNamespaceLength()));

		return $this->namespaceMap->getNamespacePath($namespace) ? $this->namespaceMap->getNamespacePath($namespace) : false;
	}

	protected function getPath($classnameParts, $namespacePath)
	{
		if (false === $nameSpacePath = $this->findNamespacePath($classnameParts))
			return implode('/', $classnameParts);
		else
			return $nameSpacePath.'/'.implode('/', array_slice($classnameParts, $this->namespaceMap->getNamespaceLength()));
	}

	public function map($className)
	{
		$classNameParts = explode('.', $className);
		return $this->getPath($classNameParts, $this->findNamespacePath($classNameParts));
	}
}