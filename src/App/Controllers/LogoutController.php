<?php
namespace App\Controllers;

class LogoutController
{
    public function execute(): void
    {
        session_start();
        session_unset();
        session_destroy();
        
        header('Location: /index.php');
        exit();
    }
}