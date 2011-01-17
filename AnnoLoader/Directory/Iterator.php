<?php
/**
 * Description of Iterator
 *
 * @author vladsun
 */
class AnnoLoader_Directory_Iterator
{
	public function get($path, $extension)
	{
		$extension = trim($extension, '. ');
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::CURRENT_AS_FILEINFO));
		$iterator = new RegexIterator($iterator, '/^.+\.' . $extension . '$/');

		$paths = array();

		foreach ($iterator as $key => $value)
			$paths[realpath($key)] = null;

		return $paths;
	}
}
