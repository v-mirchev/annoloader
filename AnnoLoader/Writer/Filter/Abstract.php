<?php
class AnnoLoader_Writer_Filter_Abstract
{
	/**
	 *
	 * @param string $input
	 * @return string
	 */
	public function filter($input, $fileName)
	{
		return $input;
	}
}
