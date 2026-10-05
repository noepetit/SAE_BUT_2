<?php
namespace Assets\Includes;
use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private PDO $connection;
    private function __construct()
    {
        $paths = [__DIR__ . '/../../../.env', __DIR__ . '/../../.env']; # second chemin pour développement en local
        $env = false;

        foreach ($paths as $path) {
            if (is_readable($path)) {
                $env = parse_ini_file($path, false, INI_SCANNER_RAW);
                break;
            }
        }
        if ($env === false) {
            throw new \RuntimeException("Unable to parse the environment file.");
        }
        /*
         * on test ici avec la boucle foreach le bon chemin selon
         * si nous sommes sur le serveur ou si nous sommes en local.
         * si chemin trouvé on initialise le ".env", qui ne sera plus false, donc ne lance pas une erreur.
         *
         * intialisation ".env" avec "parse_ini_file" qui renvoie un tableau associatif, on récupéra les valeurs après.
         * scanner_mode prend pour paramètre INI_SCANNER_RAW pour que les variables ne soient pas analysé
         * ce qui créerait des erreurs en cas de caractère spéciaux
         */
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
        /*
         * try : on essaye de se connecter en PDO à la base de données, l'objet PDO est stocké dans $connection
         * les id de connection étant stocké dans le ".env" sont séléctionné.
         */
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