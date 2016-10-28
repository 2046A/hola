<?php
/**
 * RequestForm.php
 * Date: 2016/10/28
 */

namespace Application\Http\Request;
use Symfony\Component\HttpFoundation\Request;

//实现validate方法，会在执行前自动验证
class RequestForm extends Request
{
    //比如这样...
    public function validate()
    {

    }
}