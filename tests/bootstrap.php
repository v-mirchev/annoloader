<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @author vladsun
 */

define("CLASS_PATH", "/www/site/annoloader");
define("JS_PATH", CLASS_PATH. "/scripts/test");

// TODO: check include path
ini_set('include_path', ini_get('include_path').PATH_SEPARATOR.dirname(__FILE__).'/../../../../usr/share/php/PHPUnit'.PATH_SEPARATOR.dirname(__FILE__).'/../../../../var/www/library/current/zend/library');

require_once CLASS_PATH . '/AnnoLoader/Dependency/Reader/Exception.php';
require_once CLASS_PATH . '/AnnoLoader/Dependency/Reader/Annotation.php';

require_once CLASS_PATH . '/AnnoLoader/Namespace/Map.php';
require_once CLASS_PATH . '/AnnoLoader/Namespace/Mapper.php';

require_once CLASS_PATH . '/AnnoLoader/Dependency/Builder/List.php';
require_once CLASS_PATH . '/AnnoLoader/Dependency/Builder/File.php';

require_once CLASS_PATH . '/AnnoLoader/Dependency/Type/Abstract.php';
require_once CLASS_PATH . '/AnnoLoader/Dependency/Type/File.php';
require_once CLASS_PATH . '/AnnoLoader/Dependency/Type/Class.php';
require_once CLASS_PATH . '/AnnoLoader/Dependency/Type/Namespace.php';
require_once CLASS_PATH . '/AnnoLoader/Dependency/Type/Directory/Single.php';
require_once CLASS_PATH . '/AnnoLoader/Dependency/Type/Directory/Tree.php';
require_once CLASS_PATH . '/AnnoLoader/Dependency/Type/Exception.php';
require_once CLASS_PATH . '/AnnoLoader/Dependency/Type/Factory.php';

require_once CLASS_PATH . '/AnnoLoader/Directory/Iterator.php';

require_once CLASS_PATH . '/AnnoLoader/Writer.php';
require_once CLASS_PATH . '/AnnoLoader/Writer/Filter/Abstract.php';
require_once CLASS_PATH . '/AnnoLoader/Writer/Filter/JSMin.php';


require_once CLASS_PATH . '/AnnoLoader/Dependency/Type/Abstract.php';