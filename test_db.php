<?php
require __DIR__ . '/Assets/Includes/autoloader.php';

use APP\Models\Database;
try {
    Database::getInstance()->getConnection();
    echo 'connected';
}   catch (\Throwable $e) {
    echo 'echec'.get_class($e);
}