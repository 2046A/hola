<?php
/**
 * Creator: Dean
 * Date: 2016/8/5
 * Logger.php
 */

namespace Org\Xiang\Log;


interface Logger
{
    public function setLevel($level);
    public function log($msg);
}