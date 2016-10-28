<?php
/**
 * Creator: Dean
 * Date: 2016/8/5
 * XiangLog.php
 */

namespace Org\Xiang\Log;


class XiangLog
{
    /**
     * @var Logger
     */
    private $logger;

    public function __construct($logger)
    {
        if(!($logger instanceof Logger)){
            exit("logger实例未继承Logger接口");
        }
        $this->logger = $logger;
    }
    public function setLogger($logger)
    {
        if(!($logger instanceof Logger)){
            exit("logger实例未继承Logger接口");
        }
        $this->logger = $logger;
    }
    public function log($msg)
    {
        $this->logger->log($msg);
    }
}