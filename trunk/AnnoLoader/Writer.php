<?php
/**
 * Description of Builder
 *
 * @author vladsun
 */
class AnnoLoader_Writer
{
	protected $dependencyBuilder;
	protected $filters = array();

	public function __construct($dependencyBuilder)
	{
		$this->dependencyBuilder = $dependencyBuilder;
	}

	public function addFilter($filter)
	{
		$this->filters[] = $filter;
		return $this;
	}

	protected function applyFilters($input, $fileName)
	{
		foreach ($this->filters as $filter)
			$input = $filter->filter($input, $fileName);

		return $input;
	}


	public function write($output = false)
	{
		$content = '';
		foreach ($this->dependencyBuilder->get() as $fileInfo)
		{
			if ($output)
				echo $this->applyFilters(file_get_contents($fileInfo->getName()), $fileInfo->getName());
			else
				$content .= $this->applyFilters(file_get_contents($fileInfo->getName()), $fileInfo->getName());
		}

		if ($output)
			return null;
		else
			return $content;

	}

}
