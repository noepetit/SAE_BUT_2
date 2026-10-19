<?php

require __DIR__ . '/Exceptions/ControllerException.php';

spl_autoload_register(function (string $class): void {
    $path = dirname(__DIR__,2) .'/src/' . str_replace('\\', '/', $class) . '.php';
    if (is_file($path)) {
        require $path;
    }
});