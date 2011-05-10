<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
require_once(dirname(__FILE__).'/protected/components/vendor/SimplePieAutoloader.php');
spl_autoload_unregister(array('YiiBase','autoload'));


spl_autoload_register(array('YiiBase','autoload'));
Yii::createWebApplication($config)->run();
