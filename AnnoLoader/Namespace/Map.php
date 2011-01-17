<?php

class AnnoLoader_Namespace_Map
{
	protected $namespaceLength  = 2;
	protected $namespaceMap = array();

	public function __construct($namespaceMap = array(), $namespaceLength = 2)
	{
		$this->namespaceMap = $namespaceMap;
		$this->namespaceLength = $namespaceLength;
	}

	public function setNamespaceMap($namespaceMap)
	{
		$this->namespaceMap = $namespaceMap;
	}

	public function getNamespaceMap()
	{
		return $this->namespaceMap;
	}

	public function getNamespacePath($namespace)
	{
		return isset($this->namespaceMap[$namespace]) ? $this->namespaceMap[$namespace] : null;
	}

	public function setNamespaceLength($namespaceLength)
	{
		$this->namespaceLength = $namespaceLength;
	}

	public function getNamespaceLength()
	{
		return $this->namespaceLength;
	}
}