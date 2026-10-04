<?php

use Assets\Includes\Exceptions\ControllerException;

require __DIR__ . '/Assets/Includes/autoloader.php';
session_start();
try {
    if (filter_input(INPUT_GET, 'action')) {
        if ($_GET['action'] === 'register') {
            (new \App\Controllers\Inscription\InscriptionController())->execute();
            exit;
        }
        if ($_GET['action'] === 'login') {
            (new \App\Controllers\Login\LoginController())->execute();
            exit;
        }

        if ($_GET['action'] === 'logout') {
            (new \App\Controllers\Logout\LogoutController())->execute();
            exit;
        }
        throw new ControllerException('La page que vous recherchez n\'existe pas');
    }

    (new \App\Controllers\Home\HomeController())->execute();
} catch (ControllerException $e) {
    (new \App\Views\Error($e->getMessage()))->show();
}