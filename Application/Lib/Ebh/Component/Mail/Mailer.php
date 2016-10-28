<?php
/**
 * Creator: Dean
 * Date: 2016/7/20
 * Mailer.php
 */
namespace Ebh\Component\Mail;

class Mailer
{
    private $transport;
    public function __construct($transport)
    {
        $this->transport = $transport;
    }

    public function transport()
    {
        echo "try transport: $this->transport\n";
    }
}