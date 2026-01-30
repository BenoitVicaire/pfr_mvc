<?php

namespace App\model\LoginModel;

use App\Utils\Database\DatabaseConnection;
class User{
    public int $id;
    public string $name;
    public string $password;
    public string $created_at;
    public string $email;
    public int $avatar;
}

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

    public function getUserById($id){
        $statement = $this->connection->getConnection()->prepare(
             "SELECT u.id, u.password, u.email, u.avatar
            FROM users u
            WHERE u.id = :id
            LIMIT 1;"
        );
        $statement->execute(['id' => $id]);
        $user = $statement->fetch(\PDO::FETCH_ASSOC);
        return $user;
    }

    public function createAccount(User $user) : bool{
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO users (`email`, `password`, `name`, `created_at`)
            VALUES(?, ?, ?, NOW())"
        );
        return $statement->execute(([
            $user->email,
            $user->password,
            $user->name,
            ]));
    }
}