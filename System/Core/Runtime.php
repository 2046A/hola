<?php
/**
 * Creator: Dean
 * Date: 2016/7/20
 * larger.php
 */
namespace System\Core;
use Symfony\Component\HttpFoundation;
use Symfony\Component\Yaml\Yaml;

/**
 * Class Runtime 包含一些基础配置和核心运行时
 * @package System\Core
 */
class Runtime
{
    /**
     * @var ProxyContainer
     */
    private $proxy_container;
    /**
     * @var array  一些框架配置文件
     */
    public $config;

    public function __construct()
    {
        $this->proxy_container = ProxyContainer::getInstance();
        $this->proxy_container->config(SYS_PATH.DIRECTORY_SEPARATOR."Config", "services.yaml");
        //$this->proxy_container->config(APP_PATH.DIRECTORY_SEPARATOR."Config",)
        $this->proxy_container->load('System\Core', SYS_PATH.DIRECTORY_SEPARATOR."Core");
        $this->proxy_container->load('Application\Controller', APP_PATH.DIRECTORY_SEPARATOR."Controller");
        $this->proxy_container->load('Application\Model', APP_PATH.DIRECTORY_SEPARATOR."Model");
        $this->proxy_container->load('Application\Object', APP_PATH.DIRECTORY_SEPARATOR."Object");
        $this->loadUserHelper();
        $this->loadSysHelper();
        $lib = $this->getUserLib();
        if(!empty($lib)){
            foreach($lib as $value){
                $segments = explode('\\', $value);
                $userLib = $segments[0];
                $this->proxy_container->load($userLib, APP_PATH.DIRECTORY_SEPARATOR."Lib".DIRECTORY_SEPARATOR.$userLib);
            }
        }
        $this->proxy_container->config(APP_PATH.DIRECTORY_SEPARATOR."Config", "services.yaml");
        $this->config = $this->getConfig();
    }

    //从配合文件中解析route信息并注册到Router
    private function parseRoute()
    {

    }

    private function loadHelper($handler, $path)
    {
        while(($filename = readdir($handler)) !== false){
            if($filename != "." && $filename != ".."){
                include $path. DIRECTORY_SEPARATOR. $filename;
            }
        }
        closedir($handler);
    }

    public function loadUserHelper()
    {
        $path = APP_PATH. DIRECTORY_SEPARATOR . "Helpers";
        $handler = opendir($path);
        $this->loadHelper($handler, $path);
    }

    public function loadSysHelper()
    {
        $path = SYS_PATH. DIRECTORY_SEPARATOR. "Helpers";
        $handler = opendir($path);
        $this->loadHelper($handler, $path);
    }

    /**
     * @return array()  用户lib目录
     */
    private function getUserLib()
    {
        $lib = Yaml::parse(file_get_contents(APP_PATH.DIRECTORY_SEPARATOR."Config".DIRECTORY_SEPARATOR."lib.yaml"));
        return $lib['lib'];
    }

    private function getConfig()
    {
        $config = $lib = Yaml::parse(file_get_contents(APP_PATH.DIRECTORY_SEPARATOR."Config".DIRECTORY_SEPARATOR."config.yaml"));
        return $config;
    }
    /**
     * 淡淡的忧伤...
     */
    public function handle()
    {
        $request = HttpFoundation\Request::createFromGlobals();
        $this->proxy_container->request = $request;
        $path = $request->getPathInfo();
        if ($path == "/"){
            $default = $this->config['router']['default'];
            $defaultController = '\Application\Controller\\'. $default;
            $controller = new $defaultController;
            $defaultIndex = $this->config['router']['defaultIndex'];
            if (!empty($defaultIndex)){
                if (method_exists($controller, $defaultIndex)){
                    $response = $controller->$defaultIndex();
                    return $controller->_set_response($response);
                    //return $response;
                    //return $controller->$defaultIndex();
                }
            }
            return $controller->index();
        } else {
            $seg = explode("/", $path);
            $baseController = '\Application\Controller\\'.ucfirst($seg[1]).'Controller';
            if (class_exists($baseController)) {
                $controller = new $baseController;
                if (!isset($seg[2])) {
                    if (method_exists($controller, 'index')) {
                        $response = $controller->index();
                        return $controller->_set_response($response);
                        //return $response;
                        //return $controller->index();
                    } else {
                        exit("fatal error from mine...");
                    }
                }
                if (method_exists($controller, $seg[2])){
                    $response = $controller->$seg[2]();
                    return $controller->_set_response($response);
                    //return $controller->$seg[2]();
                }
            } else{
                exit("fatal error from mine..");
            }
        }
        //.....
        //unset($controller);
    }
}