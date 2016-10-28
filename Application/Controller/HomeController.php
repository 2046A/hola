<?php
/**
 * Creator: Dean
 * Date: 2016/7/20
 * Home.php
 */
namespace Application\Controller;
use System\Core\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        //这里是必须要操作的一个步骤，至少在我这里是这样...
        parent::__construct();
    }

    public function index()
    {
        $this->logger->log("what the fuck");

        holy();
        return view("other.twig");
    }
}