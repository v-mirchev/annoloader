<?php

class AnnoLoader_Writer_Filter_Namer extends AnnoLoader_Writer_Filter_Abstract
{
	public function filter($input, $fileName)
	{
		return '/*** '.$fileName.'***/'.PHP_EOL.$input.PHP_EOL.PHP_EOL;
	}
}
