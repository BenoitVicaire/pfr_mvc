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
        "SELECT t.title, t.content, t.created_by, t.creation_date, t.last_update
        FROM thread t
        ORDER BY COUNT t.last_update DESC";

        return $this->connection
            ->getConnection()
            ->query($statement)
            ->fetchAll(\PDO::FETCH_ASSOC);
    }
}