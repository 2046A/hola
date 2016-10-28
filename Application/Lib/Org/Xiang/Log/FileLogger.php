<?php
/**
 * Creator: Dean
 * Date: 2016/8/5
 * FileLogger.php
 */

namespace Org\Xiang\Log;


class FileLogger implements Logger
{
    private $level;
    public function __construct($level){
        $this->level = $level;
    }

    public function setLevel($level)
    {
        $this->level = $level;
    }
    public function log($msg)
    {
        echo $msg;
    }
}