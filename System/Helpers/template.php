<?php
//一些帮助函数
//namespace System\Helpers;
//use System\Core\ProxyContainer;

if(!function_exists("view")) {
    function view($path, $data=false){
        $view = System\Core\ProxyContainer::getInstance()->template->getEngine(); //获取template引擎
        if($data) return $view->render($path, $data);
        else return $view->render($path);
    }
}