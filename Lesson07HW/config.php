<?php
define('SITE_ROOT', __DIR__);
define('WWW_ROOT', SITE_ROOT . '/htdocs');

define('DATA_DIR', SITE_ROOT . '/data');
define('LIB_DIR', SITE_ROOT . '/lib');
define('TPL_DIR', SITE_ROOT . '/templates');

define('SMARTY_DIR', SITE_ROOT . '/lib/smarty/');

define('SITE_TITLE', 'Урок 6');

/*
require_once(LIB_DIR . '/functions.php');
require_once(DATA_DIR . '/pages.php');
require_once(DATA_DIR . '/users.php');
require_once(DATA_DIR . '/goods.php');
*/

function myAutoload($className)
{
	$file = LIB_DIR . '/' . $className . '.php';
	if (is_file($file)) {
		require_once($file);
	}
	return false;
}

spl_autoload_register('myAutoload');

?>
