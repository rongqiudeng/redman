<?php
/**
 * Created by PhpStorm.
 * User: rongqiu
 * Date: 17-11-6
 * Time: 下午3:02
 */
// [ 应用入口文件 ]
//跨域访问Session
ini_set('session.cookie_test', ".test.dev");
// 定义应用目录
define('APP_PATH', __DIR__ . '/redman/');
// 加载框架引导文件
require __DIR__ . '/core/start.php';
