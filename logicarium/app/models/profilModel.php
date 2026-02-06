<?php

namespace App\model\ProfilModel;

use App\Utils\Database\DatabaseConnection;

class ProfilRepository{
    private DatabaseConnection $connection;

    public function __construct(DatabaseConnection $connection){
        $this->connection = $connection;
    }

    public function updateAvatar($avatar_id, $user_id){
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE users
            SET avatar_id = ?
            WHERE id = ?"
        );
        return $statement->execute([$avatar_id,$user_id]);
    }
}