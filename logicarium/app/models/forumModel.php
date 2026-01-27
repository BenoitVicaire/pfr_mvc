<?php 
namespace App\Model\ForumModel;
use App\Utils\Database\DatabaseConnection;

class ForumRepository{
    private DatabaseConnection $connection;

    public function __construct(DatabaseConnection $connection){
        $this->connection = $connection;
    }
    
    public function getThreads(){
        $statement=
        "SELECT t.title, t.content, t.created_by, t.creation_date
        FROM thread t";

        return $this->connection
            ->getConnection()
            ->query($statement)
            ->fetchAll(\PDO::FETCH_ASSOC);
    }
}