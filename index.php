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
            (new \App\Controllers\Login\LoginController())->execute();      // mettre bon chemin quand finit
            exit;
        }

        if ($_GET['action'] === 'profil') {
            (new \App\Controllers\Profil\ProfilController())->execute();
            exit;
        }

        if ($_GET['action'] === 'logout') {
            (new \App\Controllers\Logout\LogoutController())->execute();    // mettre bon chemin quand finit
            exit;
        }
        if ($_GET['action'] === 'forgotPassword') {
            (new \App\Controllers\ForgotPassword\ForgotPasswordController())->execute();
            exit;
        }
        if ($_GET['action'] === 'resetPassword') {
            (new \App\Controllers\ResetPassword\ResetPasswordController())->execute();
            exit;
        }
        if ($_GET['action'] === 'mention') {
            (new \App\Views\mentionsLegales())->execute();
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
