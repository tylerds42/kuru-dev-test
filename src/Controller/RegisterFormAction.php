<?php

namespace Kuru\DevTest\Controller;

class RegisterFormAction
{
    public function execute() {

        if (isset($_SESSION['login'])) {
            header('Location: '. '/');
        }else{
            require __DIR__ . '/../view/register.phtml';
        }
    }
}