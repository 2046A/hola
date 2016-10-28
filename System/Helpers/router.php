<?php

if(!function_exists("route")){
    //添加相应的路由器
    function route($relativePath, $controller, $name)
    {
        System\Core\ProxyContainer::getInstance()->Router->addRoute($relativePath, $controller, $name);
        //(new System\Core\Router())->addRoute($relativePath, $controller, $name);
    }
    function findHandler($relativePath)
    {
        return System\Core\ProxyContainer::getInstance()->Route->findHandler($relativePath);
    }
}