<?php

session_start();

use Assets\Includes\Exceptions\ControllerException;

require __DIR__ . '/Assets/Includes/autoloader.php';

try {
    if (filter_input(INPUT_GET, 'action')) {
        if ($_GET['action'] === 'register') {
            (new \App\Controllers\Register\RegisterController())->execute();
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
} catch (\RuntimeException $e) {
    (new \App\Views\Error('Erreur de connexion à la base de données'))->show();
}