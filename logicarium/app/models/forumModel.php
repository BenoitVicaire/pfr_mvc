<?php 
namespace App\Model\ForumModel;
use App\Utils\Database\DatabaseConnection;
class Category{
    public int $id;
    public string $name;
    public string $description;
}

class Thread{
    public int $id;
    public string $title;
    public string $category_id;
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
                                    // Partie Thread
    // Retourne toutes les catégories
    public function getCategorys(){
        $sql=
        "SELECT
            c.id,
            c.name,
            c.description
        FROM category c";

        $statement = $this->connection->getConnection()->query($sql);

        $categorys=[];
        while(($row = $statement->fetch())){
            $category = new Category();
            $category->id=(int) $row['id'];
            $category->name=$row['name'];
            $category->description=$row['description'];

            $categorys[]=$category;
        }
        return $categorys;
    }
                                    // Partie Thread
    // Retourne la liste des threads par categories
    public function getThreadsByCategory():array{
        $sql = 
        "SELECT 
            t.id AS thread_id,
            t.title,
            t.description AS thread_description,
            t.content,
            t.category_id,
            u.name,
            c.id AS category_id,
            c.name AS category_name,
            c.description AS category_description,
            DATE_FORMAT(t.created_at,'%d/%m/%Y à %Hh%imin') as created_at,
            DATE_FORMAT(t.last_update, '%d/%m/%Y à %Hh%imin') as last_update
        FROM threads t
        JOIN users u
            ON u.id = t.created_by
        JOIN category c
            ON c.id = t.category_id
        
        ORDER BY c.name, t.last_update DESC";

        $statement= $this->connection->getConnection()->query($sql);

        $threadsByCategory=[];
        while (($row = $statement->fetch())){
            $thread = new Thread();
            $thread->id =(int) $row['thread_id'];
            $thread->title = $row['title'];
            $thread->description = $row['thread_description'];
            $thread->content = $row['content'];
            $thread->created_by = $row['name'];
            $thread->created_at = $row['created_at'];
            $thread->last_update = $row['last_update'];

            $categoryId = (int) $row['category_id'];

            if (!isset($threadsByCategory[$categoryId])) {
                $threadsByCategory[$categoryId] = [
                    'id' => $categoryId,
                    'name' => $row['category_name'],
                    'description' => $row['category_description'],
                    'threads' => []
                ];
            }
            
            $threadsByCategory[$row['category_id']]['threads'][]= $thread;
        }
        return $threadsByCategory;
    }
    // Prend un id, retourne le Thread correspondant
    public function getThreadById($thread_id):Thread{
        $statement = $this->connection->getConnection()->prepare(
            "SELECT 
                t.id,
                t.title,
                t.description,
                t.content,
                u.name,
                DATE_FORMAT(t.created_at,'%d/%m/%Y à %Hh%imin') as created_at,
                DATE_FORMAT(t.last_update, '%d/%m/%Y à %Hh%imin') as last_update
            FROM threads t
            JOIN users u
                ON u.id = t.created_by
            WHERE t.id = :thread_id ;"
        );
        $statement->execute(['thread_id'=>$thread_id]);
        $data = $statement->fetch(\PDO::FETCH_ASSOC);
        if(!$data){
            throw new \Exception("Thread introuvable");
        }

        $thread = new Thread();
        $thread->id =(int) $data['id'];
        $thread->title = $data['title'];
        $thread->description = $data['description'];
        $thread->content = $data['content'];
        $thread->created_by = $data['name'];
        $thread->created_at = $data['created_at'];
        $thread->last_update = $data['last_update'];
            
        return $thread;
    }
    // Creér le thread en BDD
    public function createThread(Thread $thread): int {
        $statement=$this->connection->getConnection()->prepare(
            "INSERT INTO threads(`title`, `category_id`, `description`, `content`, `created_at`, `created_by`, `last_update`)VALUES( ?, ?, ?, ?, NOW(), ?, NOW())"
        );
        $statement->execute([
            $thread->title,
            $thread->category_id,
            $thread->description,
            $thread->content,
            $thread->created_by,
        ]);
        return (int) $this->connection->getConnection()->lastInsertId();
    }

                                    //Partie Comments
    // Prend un thread_id, return la liste des commentaires de ce thread
    public function getCommentsByThreadId($thread_id):array{
        $statement= $this->connection->getConnection()->prepare(
            "SELECT
            c.id,
            c.content,
            c.created_at,
            u.name AS created_by
            FROM comments c
            JOIN threads t
                ON c.thread_id = t.id
            JOIN users u
                ON c.created_by = u.id
            WHERE t.id= ?"
        );

        $statement->execute([$thread_id]);
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

    // Créer un commentaire en bdd
     public function createComment(Comment $comment): bool {
        $statement=$this->connection->getConnection()->prepare(
            "INSERT INTO comments( `content`, `created_at`, `created_by`, `thread_id`)VALUES( ?, NOW(), ?, ? )"
        );
    return $statement->execute([
        $comment->content,
        $comment->created_by,
        $comment->thread_id,
        ]);
    }
    

}