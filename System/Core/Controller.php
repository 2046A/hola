<?php
/**
 * Creator: Dean
 * Date: 2016/7/20
 * Controller.php 定义了controller超类，内部包含di，view，model相关所有的信息
 */
namespace System\Core;
use Symfony\Component\HttpFoundation;

class Controller
{
    /**
     * @var array
     */
    protected $head_list;
    /**
     * @var \Twig_Environment
     */
    //protected  $template;
    /**
     * @var \System\core\ProxyContainer
     */
    protected $services;
    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;
    /**
     * @var \Symfony\Component\HttpFoundation\Response
     */
    protected $response;

    public function __construct()
    {
        $this->services = ProxyContainer::getInstance();
        //$this->template = $this->services->template->getEngine();
        $this->request = $this->services->request;
        $this->response = new HttpFoundation\Response();
        $this->head_list = array();
    }
    public function __destruct()
    {
        ProxyContainer::getInstance()->database->getConnection()->close();
    }

    public function header($key, $value)
    {
        $this->head_list[$key] = $value;
    }
    public function _set_response($content)
    {
        $this->response->setContent($content);
        if(!empty($this->head_list)){
            foreach($this->head_list as $key=>$value){
                $this->response->headers->set($key, $value);
            }
        }
        return $this->response;
    }

    public function __get($key)
    {
        return $this->services->$key;
    }

}