<?php
/**
 * Creator: Dean
 * Date: 2016/8/4
 * User.php
 */

namespace Application\Model;
use System\Core\Model;

class User extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function showDB()
    {
        $db = $this->conn->getDatabase();
        $mailer = $this->container->mailer;
        $mailer->transport();
        return $db;
    }
}