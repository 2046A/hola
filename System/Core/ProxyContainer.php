<?php
/**
 * Creator: Dean
 * Date: 2016/7/25
 * Container.php
 */
namespace System\Core;
use Symfony\Component\DependencyInjection\ContainerBuilder;
# use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

class ProxyContainer
{
    /**
     * @var ContainerBuilder
     */
    private $container;
    private static $_instance;
    private function __construct()
    {
        $this->container = new ContainerBuilder();
    }
    private function __clone()
    {
        trigger_error("clone is not allowed", E_USER_ERROR);
    }
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function __get($name)
    {
        if ($this->container->has($name)) {
            return $this->container->get($name);
        } else {
            return null;
        }
    }

    public function __set($key, $value)
    {
        if ($this->container->has($key)) {
            return false;
        } else {
            $this->container->set($key, $value);
        }
    }

    public function config($config_dir, $config_file)
    {
        $loader = new YamlFileLoader($this->container, new FileLocator($config_dir));
        $loader->load($config_file);
    }
    public function load($prefix, $path)
    {
        $this->container->get('classloader')->addPrefix($prefix, $path);
        $this->container->get('classloader')->register();
    }
}