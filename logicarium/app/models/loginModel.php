<?php

namespace App\model\LoginModel;

use App\Utils\Database\DatabaseConnection;

class LoginRepository{
    private DatabaseConnection $connection;

    public function __construct(DatabaseConnection $connection){
        $this->connection = $connection;
    }

    public function getUserByEmail($email){
        $statement = $this->connection->getConnection()->prepare(
            "SELECT u.id, u.password, u.email
            FROM users u
            WHERE u.email = :email
            LIMIT 1;"
        );
        $statement->execute(['email' => $email]);
        $user = $statement->fetch(\PDO::FETCH_ASSOC);
        return $user;
    }

    public function createAccount(string $email, string $password, string $name) : bool{
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO users (`email`, `password`, `name`, `created_at`)
            VALUES(?, ?, ?, NOW())"
        );
        return $statement->execute(([$email,$password,$name]));
    }
}