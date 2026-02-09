<?php

namespace App\Model\LoginModel;

use App\Utils\Database\DatabaseConnection;
use App\Model\UserModel\User;

class LoginRepository{
    private DatabaseConnection $connection;

    public function __construct(DatabaseConnection $connection){
        $this->connection = $connection;
    }

    public function getUserByEmail(string $email) : ?User{
        $statement = $this->connection->getConnection()->prepare(
            "SELECT u.id, u.password, u.email, u.avatar_id
            FROM users u
            WHERE u.email = :email
            LIMIT 1;"
        );
        $statement->execute(['email' => $email]);
        $data = $statement->fetch(\PDO::FETCH_ASSOC);
        if(!$data){
            return null;
        }
        $user = new User();
        $user->setId((int) $data['id']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setAvatar((int) $data['avatar']);

        return $user;
    }

    public function getUserById(int $id): ?User{
        $statement = $this->connection->getConnection()->prepare(
             "SELECT u.id, u.password, u.email, u.avatar
            FROM users u
            WHERE u.id = :id
            LIMIT 1;"
        );
        $statement->execute(['id' => $id]);
        $data = $statement->fetch(\PDO::FETCH_ASSOC);
        if(!$data){
            return null;
        }
        $user = new User();
        $user->setId((int) $data['id']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setAvatar((int) $data['avatar']);

        return $user;
    }

    public function createAccount(User $user) : bool{
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO users (`email`, `password`, `name`, `created_at`)
            VALUES(?, ?, ?, NOW())"
        );
        return $statement->execute([
            $user->getEmail(),
            $user->getPassword(),
            $user->getName(),
            ]);
    }
}