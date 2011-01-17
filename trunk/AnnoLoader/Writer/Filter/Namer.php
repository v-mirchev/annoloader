<?php

class Annoloader_Writer_Filter_Namer extends Annoloader_Writer_Filter_Abstract
{
	public function filter($input, $fileName)
	{
		return '/*** '.$fileName.'***/'.PHP_EOL.$input.PHP_EOL.PHP_EOL;
	}
}
