<?php
if($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'http'){
	echo '<html><head><meta http-equiv="refresh" content="0;url=https://blogbyken.com"></head></html>';
	exit();
}

/*if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}*/


// comment out the following two lines when deployed to production
/*defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');*/

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/config/web.php');

(new yii\web\Application($config))->run();
