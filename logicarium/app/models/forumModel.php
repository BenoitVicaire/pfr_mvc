<?php 
namespace App\Model\ForumModel;
use App\Utils\Database\DatabaseConnection;

class Thread{
    public int $id;
    public string $title;
    public string $content;
    public string $created_at;
    public string $created_by;
    public string $last_update;
}

class ForumRepository{
    private DatabaseConnection $connection;

    public function __construct(DatabaseConnection $connection){
        $this->connection = $connection;
    }
    
    public function getThreads():array{
        $sql=
        "SELECT 
            t.id,
            t.title,
            t.content,
            t.created_by,
            DATE_FORMAT(t.creation_date,'%d/%m/%Y à %Hh%imin%ss') as created_at,
            DATE_FORMAT(t.last_update, '%d/%m/%Y à %Hh%imin%ss') as last_update
        FROM threads t
        ORDER BY t.last_update DESC";

        $statement = $this->connection->getConnection()->query($sql);

        $threads=[];
        while (($row = $statement->fetch())){
            $thread = new Thread();
            $thread->id =(int) $row['id'];
            $thread->title = $row['title'];
            $thread->content = $row['content'];
            $thread->created_by = $row['created_by'];
            $thread->created_at = $row['created_at'];
            $thread->last_update = $row['last_update'];
            
            $threads[]= $thread;
        }
        return $threads;
    }
}