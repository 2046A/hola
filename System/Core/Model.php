<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 2016/7/21
 * Time: 23:57
 */
namespace System\Core;

class Model
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $conn;
    /**
     * @var ProxyContainer
     */
    protected $container;
    public function __construct()
    {
        $this->container = ProxyContainer::getInstance();
        $this->conn = $this->container->database->getConnection();
    }
}