<?php
use Assets\Includes\Exceptions\ControllerException;
require __DIR__ . '/Assets/Includes/autoloader.php';
session_start();
try {
    if (filter_input(INPUT_GET, 'action')) {
        if ($_GET['action'] === 'register') {
            (new \App\Controllers\RegisterController())->execute();
            exit;
        }
        if ($_GET['action'] === 'login') {
            (new \App\Controllers\LoginController())->execute();
            exit;
        }

        if ($_GET['action'] === 'profil' || $_GET['action'] === 'profile') {
            (new \App\Controllers\ProfileController())->execute();
            exit;
        }

        if ($_GET['action'] === 'logout') {
            (new \App\Controllers\LogoutController())->execute();
            exit;
        }
        if ($_GET['action'] === 'forgotPassword') {
            (new \App\Controllers\ForgotPasswordController())->execute();
            exit;
        }
        if ($_GET['action'] === 'resetPassword') {
            (new \App\Controllers\ResetPasswordController())->execute();
            exit;
        }
        if ($_GET['action'] === 'sitemap') {
            (new \App\Controllers\SitemapController())->execute();
            exit;
        }
        if ($_GET['action'] === 'mention') {
            require_once __DIR__ . '/App/Views/mentionsLegales.php';
            exit;
        }
        throw new ControllerException('La page que vous recherchez n\'existe pas');
    }

    (new \App\Controllers\HomeController())->execute();
} catch (ControllerException $e) {
    (new \App\Views\Error($e->getMessage()))->show();
} catch (\RuntimeException $e) {
    (new \App\Views\Error('Erreur de connexion à la base de données'))->show();
}
