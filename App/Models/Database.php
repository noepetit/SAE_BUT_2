<?php
namespace App\Models;
use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private PDO $connection;

    private function __construct()
    {
        $paths = [__DIR__ . '/../../../.env', __DIR__ . '/../../.env'];
        $env = false;
        foreach ($paths as $path)
        {
            if (is_readable($path)) {
                $env = parse_ini_file($path, false, INI_SCANNER_RAW);
                break;
            }
        }
        if ($env === false) {
            throw new \RuntimeException("Unable to parse the environment file.");
        }
        try {
            $this->connection = new PDO('mysql:dbname='.$env['DB_NAME'].
                ';host='.$env['DB_HOST'].';charset=utf8mb4',
                $env['DB_USER'],
                $env['DB_PWD'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_EMULATE_PREPARES => false]);
        }
        catch (PDOException $e) {
            error_log($e->getMessage());
            throw new \RuntimeException("Unable to connect to the database.");
        }
    }
    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function getConnection(): PDO
    {
        return $this->connection;
    }

}