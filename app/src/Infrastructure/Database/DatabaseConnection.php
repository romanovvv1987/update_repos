<?php
namespace App\Infrastructure\Database;

use PDO;

/**
 *  DatabaseConnection Singleton
 */
class DatabaseConnection
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            $dsn = sprintf(
                "pgsql:host=%s;port=%s;dbname=%s;user=%s;password=%s",
                DB_HOST,
                DB_PORT,
                DB_NAME,
                DB_USER,
                DB_PASS
            );
            self::$connection = new PDO($dsn);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$connection;
    }

}