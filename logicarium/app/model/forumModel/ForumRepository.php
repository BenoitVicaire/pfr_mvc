<?php 

namespace App\Model\ForumModel;

use App\Utils\DatabaseConnection;
use App\Model\ThreadModel\Thread;
use App\Model\CategoryModel\Category;
use App\Model\CommentModel\Comment;

class ForumRepository{
    private DatabaseConnection $connection;

    public function __construct(DatabaseConnection $connection){
        $this->connection = $connection;
    }
                                    // Partie Thread
    // Retourne toutes les catégories
    public function getCategories():array{
        $sql=
        "SELECT
            c.id,
            c.name,
            c.description
        FROM category c";

        $statement = $this->connection->getConnection()->query($sql);

        $categories=[];
        while(($row = $statement->fetch())){
            $category = new Category();
            $category->setId((int)$row['id']);
            $category->setName($row['name']);
            $category->setDescription($row['description']);

            $categories[]=$category;
        }
        return $categories;
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
            t.category_id AS thread_category_id,
            t.created_by,
            u.name AS created_by_name,
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
            $thread->setId($row['thread_id']);
            $thread->setTitle($row['title']);
            $thread->setCategoryId((int)$row['thread_category_id']);
            $thread->setDescription($row['thread_description']);
            $thread->setContent($row['content']);
            $thread->setCreatedBy((int)$row['created_by']);
            $thread->setCreatedByName($row['created_by_name']);
            $thread->setCreatedAt($row['created_at']);
            $thread->setLastUpdate($row['last_update']);

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
    public function getThreadById(int $thread_id):Thread{
        $statement = $this->connection->getConnection()->prepare(
            "SELECT 
                t.id,
                t.title,
                t.description,
                t.content,
                t.created_by,
                u.name,
                a.url AS avatar_url,
                a.name AS avatar_name,
                DATE_FORMAT(t.created_at,'%d/%m/%Y à %Hh%imin') as created_at,
                DATE_FORMAT(t.last_update, '%d/%m/%Y à %Hh%imin') as last_update
            FROM threads t
            JOIN users u
                ON u.id = t.created_by
            LEFT JOIN avatar a
                ON a.id = u.avatar_id
            WHERE t.id = :thread_id ;"
        );
        $statement->execute(['thread_id'=>$thread_id]);
        $data = $statement->fetch(\PDO::FETCH_ASSOC);
        if(!$data){
            throw new \Exception("Thread introuvable");
        }
        $avatarUrl = !empty($data['avatar_url'])
            ? $data['avatar_url']
            : 'assets/images/avatar/Avatar_1.png';
        $avatarName = !empty($data['avatar_name'])
            ? $data['avatar_name']
            : "avatar 1";

        $thread = new Thread();
        $thread->setId((int)$data['id']);
        $thread->setTitle($data['title']);
        $thread->setDescription($data['description']);
        $thread->setContent($data['content']);
        $thread->setCreatedBy((int)$data['created_by']);
        $thread->setCreatedByName($data['name']); 
        $thread->setCreatedAt($data['created_at']);
        $thread->setLastUpdate($data['last_update']);
        $thread->setAvatarUrl($avatarUrl);
        $thread->setAvatarName($avatarName);
            
        return $thread;
    }
    // Creér le thread en BDD
    public function createThread(Thread $thread): int {
        $statement=$this->connection->getConnection()->prepare(
            "INSERT INTO threads(`title`, `category_id`, `description`, `content`, `created_at`, `created_by`, `last_update`)VALUES( ?, ?, ?, ?, NOW(), ?, NOW())"
        );
        $statement->execute([
            $thread->getTitle(),
            $thread->getCategoryId(),
            $thread->getDescription(),
            $thread->getContent(),
            $thread->getCreatedBy(),
        ]);
        return (int) $this->connection->getConnection()->lastInsertId();
    }

                                    //Partie Comments
    // Prend un thread_id, return la liste des commentaires de ce thread
    public function getCommentsByThreadId(int $thread_id):array{
        $statement= $this->connection->getConnection()->prepare(
            "SELECT
            c.id,
            c.content,
            c.created_at,
            c.created_by,
            u.name AS created_by_name
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
            $comment->setId((int)$row['id']);
            $comment->setContent($row['content']);
            $comment->setCreatedAt($row['created_at']);
            $comment->setCreatedBy((int)$row['created_by']);
            $comment->setCreatedByName($row['created_by_name']);

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
        $comment->getContent(),
        $comment->getCreatedBy(),
        $comment->getThreadId(),
        ]);
    }

}