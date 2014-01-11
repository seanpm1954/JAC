<?php
defined('DS')? null :DEFINE('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT')? null : define('SITE_ROOT',DS.'Library'.DS.'Webserver'.DS.'Documents'.DS.'JAC');
defined('LIB_PATH')? null : define("LIB_PATH", SITE_ROOT.DS.'includes');

require_once(LIB_PATH.DS."config.php");
require_once(LIB_PATH.DS."functions.php");
require_once(LIB_PATH.DS."session.php");
require_once(LIB_PATH.DS."databaseObject.php");
require_once(LIB_PATH.DS."database.php");
require_once(LIB_PATH.DS."user.php");
require_once(LIB_PATH.DS."company.php");
require_once(LIB_PATH.DS."project.php");
require_once(LIB_PATH.DS."project_files.php");

?>