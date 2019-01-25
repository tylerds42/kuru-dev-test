<?php

namespace Kuru\DevTest\Controller;

class LoginFormAction
{

    public function execute()
    {
        if (isset($_SESSION['login'])) {
            header('Location: '. '/');
        }
        else{
            require __DIR__ . '/../view/login.phtml';
        }
    }
}