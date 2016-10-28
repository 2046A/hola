<?php
/**
 * Test.php
 * Date: 2016/10/28
 */

namespace Application\Http\Middleware;
use Symfony\Component\HttpFoundation\Request;

class Test
{
    //在进入之前执行
    public function handle(Request $request)
    {
        return $request;
    }

    //在返回之后执行
    public function terminate(Request $request)
    {

    }
}