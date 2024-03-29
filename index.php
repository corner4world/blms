<?php
/*****************************************************************************
 * SAAS 根 
 * ===========================================================================
 * 版权所有  上海实玮网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.seevia.cn
 * ---------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ===========================================================================
 * $开发: 上海实玮$
 * $Id$
*****************************************************************************/

    define('WEBROOT_DIR', '');

    if (!defined('DS')) {
        define('DS', DIRECTORY_SEPARATOR);
    }

    if (!defined('ROOT')) {
        define('ROOT', dirname(__FILE__).DS.'app');//	define('ROOT', dirname(dirname(dirname(__FILE__))));
    }

    if (!defined('APP_DIR')) {
        define('APP_DIR',  'web'); //	define('APP_DIR', basename(dirname(dirname(__FILE__))));
    }
    /* 缓存路径 */
    if (!defined('TMP')) {
        define('TMP', dirname(ROOT).DS.'data'.DS.'web'.DS);
    }

    if (!defined('CAKE_CORE_INCLUDE_PATH')) {
        define('CAKE_CORE_INCLUDE_PATH', ROOT);
    }

    if (!defined('WWW_ROOT')) {
        define('WWW_ROOT', dirname(__FILE__).DS);
    }

    $path = dirname(ROOT).DS.'data'.DS.'database.php';
    if (!file_exists($path)) {
        	$host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
		$webroot = isset($_SERVER['PHP_SELF'])?dirname($_SERVER['PHP_SELF']).'/':'/';
		$webroot = str_replace('\\','/',$webroot);
	 	$webroot = str_replace('//','/',$webroot);
		$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
		$post=isset($_SERVER['SERVER_PORT'])?$_SERVER['SERVER_PORT']:'80';
		$host = $http_type.$host.($post!='80'&&$post!='443'?(":".$post):'');
		header('Location:'.$host.$webroot.'tools/installs');
		exit();
    }

    if (!defined('CORE_PATH')) {
        define('APP_PATH', ROOT.DS.APP_DIR.DS);
        define('CORE_PATH', CAKE_CORE_INCLUDE_PATH.DS);
    }
    if (!include(CORE_PATH.'cake'.DS.'bootstrap.php')) {
        trigger_error('CakePHP core could not be found.  Check the value of CAKE_CORE_INCLUDE_PATH in APP/webroot/index.php.  It should point to the directory containing your '.DS.'cake core directory and your '.DS.'vendors root directory.', E_USER_ERROR);
    }

    if (isset($_GET['url']) && $_GET['url'] === 'favicon.ico') {
        return;
    } else {
        $Dispatcher = new Dispatcher();
        $Dispatcher->dispatch();
    }

    if (Configure::read() > 0) {
        echo '<!-- '.round(getMicrotime() - $TIME_START, 4).'s -->';
    }
