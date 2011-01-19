<?php
/**
 * Description of List
 *
 * @author vladsun
 */
class AnnoLoader_Dependency_Builder_List implements Iterator
{
	protected $basePath;
	protected $namespace;
	protected $extension;
	protected $filePaths;
	protected $fileDescriptorPrototype;
	protected $dependencyReader;
	protected $directoryIterator;
	protected $files;
	protected $dependencyAdapterFactory;

	protected $position = 0;

	function rewind()
	{
        $this->position = 0;
    }

    function current()
	{
        return $this->files[$this->position]->getName();
    }

    function key()
	{
        return $this->position;
    }

    function next()
	{
        $this->position ++;
    }

    function valid()
	{
        return isset($this->array[$this->position]);
    }

	public function __construct
	(
		$basePath,
		$extension,
		$namespace,
		$directoryIterator,
		$fileDescriptorPrototype,
		$dependencyReader,
		$dependencyAdapterFactory
	)
	{
		$this->position = 0;

		$this->basePath = $basePath;
		$this->extension = $extension;
		$this->namespace = $namespace;
		$this->directoryIterator = $directoryIterator;
		$this->fileDescriptorPrototype = $fileDescriptorPrototype;
		$this->dependencyReader = $dependencyReader;
		$this->dependencyAdapterFactory = $dependencyAdapterFactory;
	}

	protected function buildList()
	{
		$this->filePaths = $this->directoryIterator->get($this->basePath, $this->extension);
		
		$this->files = array();

		foreach ($this->filePaths as $path => $v)
		{
			$file = clone $this->fileDescriptorPrototype;
			$file->setName($path);

			$this->files[$path] = $file;
		}

		$this->filePaths = null;
	}

	public function get()
	{
		return $this->files;
	}

	protected function sortByPriority()
	{
		usort($this->files, function ($a, $b)
		{
			if ($a->hasRequirements() != $b->hasRequirements())
				return $a->hasRequirements() > $b->hasRequirements() ? -1 : +1;

			if ($a->getPriority() < $b->getPriority()) return -1;
			if ($a->getPriority() > $b->getPriority()) return +1;

			return ($a->getName() < $b->getName()) ? -1 : 1;
		});
	}

	protected function createDependency($dependencyType)
	{
		$dependencyType = $this->dependencyAdapterFactory->create($dependencyType);

		$dependencyType->setNamespace($this->namespace);
		$dependencyType->setBasePath($this->basePath);
		$dependencyType->setFilesList($this->files);
		$dependencyType->setExtension($this->extension);

		return $dependencyType;
	}

	public function build()
	{
		$this->buildList();

		foreach ($this->files as $file)
		{
			if (false !== $dependencies = $this->dependencyReader->read($file->getName()))
			{
				foreach ($dependencies as $dependencyType => $dependency)
				{
					$dependencyType = $this->createDependency($dependencyType);

					$fileDependencieSets = array();
					foreach ($dependency as $dependencyEntity)
						$fileDependencieSets[] = $dependencyType->getFiles($dependencyEntity, $file);

					foreach ($fileDependencieSets as $fileDependencySet)
						foreach ($fileDependencySet as $fileDependency)
							$this->files[$fileDependency]->addDependant($file);
				}
			}
		}

		$this->sortByPriority();

		$this->rewind();
	}
}
