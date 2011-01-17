<?php
/**
 * Description of File
 *
 * @author vladsun
 */
class AnnoLoader_Dependency_Builder_File
{
	protected $fileName;
	protected $dependendents = array();
	protected $priority = 0;
	protected $hasRequirements = false;

	public function __construct($fileName = null)
	{
		$this->fileName = $fileName;
	}

	public function getName()
	{
		return $this->fileName;
	}

	public function setName($fileName)
	{
		$this->fileName = $fileName;
	}

	public function addDependant(AnnoLoader_Dependency_Builder_File $dependencyFile)
	{
		$dependencyFile->increasePriority($this->getPriority() + 1);
		$this->dependendents[] = $dependencyFile;
	}

	public function hasRequirements()
	{
		return $this->hasRequirements;
	}

	public function setHasRequirements()
	{
		$this->hasRequirements = true;
	}

	public function getPriority()
	{
		return $this->priority;
	}

	public function increasePriority($priority = 1)
	{
		$this->hasRequirements = true;
		
		$this->priority += $priority;
		
		foreach ($this->dependendents as $depandent)
			$depandent->increasePriority($priority);
	}

	public function __clone()
	{
		$this->fileName = '';
		$this->priority = 0;
		$this->hasRequirements = false;
		$this->dependendents = array();
	}

	public function __toString()
	{
		return $this->fileName;
	}
}
