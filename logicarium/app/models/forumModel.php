<?php 
namespace App\Model\ForumModel;
use App\Utils\Database\DatabaseConnection;

class Thread{
    public int $id;
    public string $title;
    public string $description;
    public string $content;
    public string $created_at;
    public string $created_by;
    public string $last_update;
    public ?string $last_answer=null;
}
class Comment{
    public int $id;
    public string $content;
    public string $created_at;
    public string $created_by;
    public string $thread_id;
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
            t.description,
            t.content,
            u.name,
            DATE_FORMAT(t.created_at,'%d/%m/%Y à %Hh%imin%ss') as created_at,
            DATE_FORMAT(t.last_update, '%d/%m/%Y à %Hh%imin%ss') as last_update
        FROM threads t
        JOIN users u
            ON u.id = t.created_by
        ORDER BY t.last_update DESC";

        $statement = $this->connection->getConnection()->query($sql);

        $threads=[];
        while (($row = $statement->fetch())){
            $thread = new Thread();
            $thread->id =(int) $row['id'];
            $thread->title = $row['title'];
            $thread->description = $row['description'];
            $thread->content = $row['content'];
            $thread->created_by = $row['name'];
            $thread->created_at = $row['created_at'];
            $thread->last_update = $row['last_update'];
            
            $threads[]= $thread;
        }
        return $threads;
    }
    public function createThread(Thread $thread): bool {
        $statement=$this->connection->getConnection()->prepare(
            "INSERT INTO threads(`title`, `description`, `content`, `created_at`, `created_by`, `last_update`)VALUES( ?, ?, ?, NOW(), ?, NOW())"
        );
    return $statement->execute([
        $thread->title,
        $thread->description,
        $thread->content,
        $thread->created_by,
        ]);
    }

    public function getComments($thread_id):array{
        $statement= $this->connection->getConnection()->prepare(
            "SELECT
            c.id,
            c.content,
            c.created_at,
            c.created_by
            FROM comments c
            JOIN threads t
                ON c.thread_id = t.id
            WHERE t.id= ?"
        );

        $statement->execute(['t.id' => $thread_id]);
        $comments=[];
        while(($row = $statement->fetch())){
            $comment = new Comment();
            $comment->id=(int) $row['id'];
            $comment->content= $row['content'];
            $comment->created_at= $row['created_at'];
            $comment->created_by= $row['created_by'];

            $comments[]= $comment;
        }
        return $comments;
    }
}