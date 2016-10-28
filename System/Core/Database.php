<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 2016/7/21
 * Time: 22:47
 */
namespace System\Core;
use Doctrine\DBAL;

class Database
{
    private $config;
    private $conn;
    public function __construct()
    {
        $this->config = new DBAL\Configuration();
    }
    public function connect($dbname, $user, $password, $host, $driver)
    {
        $params = array(
            'dbname' => $dbname,
            'user' => $user,
            'password'=>$password,
            'host' => $host,
            'driver' => $driver
        );
        $this->conn = DBAL\DriverManager::getConnection($params, $this->config);
    }
    public function getConnection()
    {
        return $this->conn;
    }
}