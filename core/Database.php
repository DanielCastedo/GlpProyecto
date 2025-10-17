<?php
namespace Core;
use PDO; use PDOException;

class Database {
    private static ?PDO $pdo = null;
    public static function pdo(): PDO {
        if (!self::$pdo) {
            $cfg = require __DIR__ . '/../config/config.php';
            $db = $cfg['db'];
            $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=%s',
                $db['host'],$db['port'],$db['name'],$db['charset']);
            try {
                self::$pdo = new PDO($dsn, $db['user'], $db['pass'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                http_response_code(500);
                die('DB connection failed: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
