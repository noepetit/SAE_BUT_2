<?php

spl_autoload_register(function (string $class): void {
    $path = str_replace('\\', '/', $class) . '.php';
    if (is_file($path)) {
        require $path;
    }
});