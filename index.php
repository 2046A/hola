<?php
/**
 * Creator: Dean
 * Date: 2016/7/20
 * index.php 前端控制器
 */
use System\Core;

defined('SYS_PATH') or define("SYS_PATH", __DIR__. DIRECTORY_SEPARATOR . "System");
defined("APP_PATH") or define("APP_PATH", __DIR__. DIRECTORY_SEPARATOR . "Application");
include_once SYS_PATH . DIRECTORY_SEPARATOR . "Component" . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
include_once SYS_PATH . DIRECTORY_SEPARATOR . "Core". DIRECTORY_SEPARATOR . "ProxyContainer.php";
include_once SYS_PATH . DIRECTORY_SEPARATOR . "Core". DIRECTORY_SEPARATOR . "Runtime.php";

$runtime = new Core\Runtime();
$response = $runtime->handle();
$response->send();

//end of the day...