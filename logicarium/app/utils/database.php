<?php

namespace App\Utils\Database;

class DatabaseConnection
{
    private ?\PDO $database = null;

    public function getConnection(): \PDO
    {
        if ($this->database === null) {
            $this->database = new \PDO(
                'mysql:host=localhost;
                dbname=logicariumDB;
                charset=utf8',
                'root',
                'root',
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                ]);
        }

        return $this->database;
    }
}
