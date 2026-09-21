<?php

require __DIR__ . '/Assets/Includes/autoloader.php';

try {
    if (filter_input(INPUT_GET, 'action')) {
        if ($_GET['action'] === 'register') {
            (new \App\Controllers\Register\RegisterController())->execute();
            exit;
        }
        throw new ControllerException('La page que vous recherchez n\'existe pas');
    }

    (new \App\Controllers\Home\HomeController())->execute();
} catch (ControllerException $e) {
    (new \App\Views\Error($e->getMessage()))->show();
}