<?php

namespace App\model\loginModel;

use App\utils\Database\DatabaseConnection;

Class Login{
    public DatabaseConnection $connection;

    public function loginUser($email,$password){
        $statement = $this->connection->getConnection()->prepare(
            "SELECT u.id, u.password
            FROM users 
            WHERE u.email = :email
            LIMIT 1;"
        );
        $statement->execute(['email' => $email]);
        $user = $statement->fetch(\PDO::FETCH_ASSOC);
    }
}