<?php

namespace App\Utils\Database;


class DatabaseConnection{

    private ?\PDO $database = null;
    private string $host;
    private string $dbName;
    private string $user;
    private string $pass;

    public function __construct(){
        $dotenv = parse_ini_file(__DIR__ . '/../../../conf.env');

        $this->host = $dotenv['DB_HOST'];
        $this->dbName = $dotenv['DB_NAME'];
        $this->user = $dotenv['DB_USER'];
        $this->pass = $dotenv['DB_PASS'];
    }


    public function getConnection(): \PDO
    {
        if ($this->database === null) {
            $this->database = new \PDO(
                "mysql:host={$this->host};
                dbname={$this->dbName};
                charset=utf8",
                $this->user,
                $this->pass,
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                ]);
        }

        return $this->database;
    }
}
