<?php

class Database
{
    private static $conn = null;

    private function __construct()
    {
    }

    public static function getConnection()
    {
        if (self::$conn === null) {
            try {
                $config = require __DIR__ . '/../../public/config/app.php';

                $dsn = "mysql:host={$config['DB_HOST']};dbname={$config['DB_NAME']};charset=utf8mb4";

                self::$conn = new PDO(
                    $dsn,
                    $config['DB_USER'],
                    $config['DB_PASSWORD'],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false
                    ]
                );

            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        return self::$conn;
    }
}
