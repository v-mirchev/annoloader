<?php
/**
 * Description of Interface
 *
 * @author vladsun
 */
class AnnoLoader_Dependency_Type_Abstract
{
	protected $namespace = array();
	protected $files	 = array();
	protected $basePath	 = '';
	protected $extension = '';


	/**
	 * @param string $dependency
	 *
	 * @return array|false
	 */
	public function getFiles($dependency, $currentFile) {}

	/**
	 * @param string $basePath
	 */
	public function setBasePath($basePath)
	{
		$this->basePath = $basePath;
	}

	/**
	 * @return string
	 */
	public function getBasePath()
	{
		return $this->basePath;
	}

	/**
	 * @param string $extension
	 */
	public function setExtension($extension)
	{
		$this->extension = trim($extension, '. ');
	}

	/**
	 * @return string
	 */
	public function getExtension()
	{
		return $this->extension;
	}

	/**
	 * @param array $files
	 */
	public function setFilesList($files)
	{
		$this->files = $files;
	}

	/**
	 * @return array
	 */
	public function getFilesList()
	{
		return $this->files;
	}

	/**
	 * @param array $namespace
	 */
	public function setNamespace($namespace)
	{
		$this->namespace = $namespace;
	}

	/**
	 * @return array
	 */
	public function getNamespace()
	{
		return $this->namespace;
	}
}
