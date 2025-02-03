<?php
declare(strict_types=1);

namespace App\Util;

use PDO;

class Sql {
    private static ?PDO $pdo = null;

    public static function bdd(): PDO
    {
        if (self::$pdo == null) {
            self::$pdo = self::connection();
        }
        return self::$pdo;
    }

    private static function connection(): PDO
    {
        try {
            $db = new PDO("mysql:host=localhost;dbname=p6-tomtroc", 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        }
        catch (\PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
}
