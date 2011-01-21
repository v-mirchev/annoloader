<?php
require_once 'AnnoLoader/Dependency/Reader/Exception.php';
require_once 'AnnoLoader/Dependency/Reader/Annotation.php';

require_once 'AnnoLoader/Namespace/Map.php';
require_once 'AnnoLoader/Namespace/Mapper.php';

require_once 'AnnoLoader/Dependency/Builder/List.php';
require_once 'AnnoLoader/Dependency/Builder/File.php';

require_once 'AnnoLoader/Dependency/Type/Abstract.php';
require_once 'AnnoLoader/Dependency/Type/File.php';
require_once 'AnnoLoader/Dependency/Type/Class.php';
require_once 'AnnoLoader/Dependency/Type/Namespace.php';
require_once 'AnnoLoader/Dependency/Type/Directory/Single.php';
require_once 'AnnoLoader/Dependency/Type/Directory/Tree.php';

require_once 'AnnoLoader/Dependency/Type/Exception.php';
require_once 'AnnoLoader/Dependency/Type/Factory.php';

require_once 'AnnoLoader/Directory/Iterator.php';

require_once 'AnnoLoader/Writer.php';
require_once 'AnnoLoader/Writer/Filter/Abstract.php';
require_once 'AnnoLoader/Writer/Filter/JSMin.php';
require_once 'AnnoLoader/Writer/Filter/Namer.php';

require_once 'AnnoLoader/Facade/Abstract.php';
require_once 'AnnoLoader/Facade/JS.php';
require_once 'AnnoLoader/Facade/CSS.php';

require_once 'AnnoLoader/Cache/Abstract.php';
require_once 'AnnoLoader/Cache/Null.php';
require_once 'AnnoLoader/Cache/Manager.php';

$cache = new AnnoLoader_Cache_Manager('cache/js');

$js = new AnnoLoader_Facade_JS
(
	'/www/site/annoloader/scripts/test/AnnoLoader/js/ux',
	array
	(
		'Ext.ux'	=> '/',
	)
);

$js->setCacheManager(new AnnoLoader_Cache_Manager('cache/js'));

$js->output(true);

exit();
