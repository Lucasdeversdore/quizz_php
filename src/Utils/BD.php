<?php

namespace App\Utils;

use PDO;
use RuntimeException;

class BD {
    private static ?PDO $pdo = null;

    public static function connection(): PDO {
        if (self::$pdo === null) {
            $dbFile = __DIR__ . '\bd\bd.db'; // Chemin défini
            if (!file_exists($dbFile)) {
                throw new RuntimeException("La base de données n'a pas été trouvée : {$dbFile}");
            }
            echo "Base de données utilisée : " . $dbFile . PHP_EOL; // Ajoute cette ligne pour vérifier le chemin
            self::$pdo = new PDO('sqlite:' . $dbFile);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
    
}

?>
