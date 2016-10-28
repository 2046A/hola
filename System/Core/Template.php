<?php
/**
 * Creator: Dean
 * Date: 2016/7/26
 * Template.php
 */
namespace System\Core;

class Template
{
    /**
     * @var \Twig_Environment
     */
    private $engine;
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(APP_PATH . DIRECTORY_SEPARATOR . "View");
        $this->engine = new \Twig_Environment($loader, array(
            'cache' => APP_PATH. DIRECTORY_SEPARATOR . "Cache"
        ));
        $this->engine->setCache(false);
    }
    public function getEngine()
    {
        return $this->engine;
    }
}