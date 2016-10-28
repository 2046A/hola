<?php
/**
 * Router.php
 * Date: 2016/10/28
 */

namespace System\Core;
use Symfony\Component\Routing;

class Router
{
    /**
     * @var Routing\RouteCollection
     */
    private $collection;
    public function __construct()
    {
        $this->collection = new Routing\RouteCollection();
    }
    public function addRoute($relativePath, $handler, $name)
    {
        $route = new Routing\Route($relativePath, $handler);
        $this->collection->add($name, $route);
    }

    public function findHandler($relativePath)
    {
        $context = new Routing\RequestContext("/");
        $matcher = new Routing\Matcher\UrlMatcher($this->collection, $context);
        $params = $matcher->match($relativePath);
        return $params;
    }
}