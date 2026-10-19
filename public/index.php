<?php
use \Core\Exceptions\ControllerException;

require __DIR__ . '/../src/Core/autoloader.php';

session_set_cookie_params(
    [
        'path' => '/',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax'
    ]
);

$routes=[];
foreach (glob(__DIR__ . 'App/Controllers/*Controller.php') as $file){
    $className = basename($file, '.php');
    $name = str_replace('Controller', '', $className);
    $route = lcfirst($name);
    $routes[$route] = 'App\\Controllers\\' . $className;
}
session_start();
try {
    $action = filter_input(INPUT_GET, 'action') ?: 'home';

    if (!array_key_exists($action, $routes)) {
        throw new ControllerException('La page que vous recherchez n\'existe pas');
    }

    (new $routes[$action]())->execute();
}
catch (ControllerException $e) {
    (new App\Views\Error($e->getMessage()))->show();
} catch (\RuntimeException $e) {
    (new App\Views\Error('Erreur de connexion à la base de données'))->show();
}
