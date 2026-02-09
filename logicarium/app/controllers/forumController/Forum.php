<?php 
namespace App\Controllers\ForumController;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use App\Model\ForumModel\Category;
use App\Model\ForumModel\Comment;
use App\Model\ForumModel\ForumRepository;
use App\Model\ForumModel\Thread;
use App\Utils\Database\DatabaseConnection;

class Forum{
    public function displayForum(){
        $forumRepository = new ForumRepository(new DatabaseConnection());
        $categories = $forumRepository->getCategories();
        $threadsByCategory = $forumRepository->getThreadsByCategory();
        require __DIR__ . '/../../templates/forum/forum.php';
    }

    public function createNewThread(){
        $forumRepository = new ForumRepository(new DatabaseConnection());
        $categories = $forumRepository->getCategories();
        require __DIR__ . '/../../templates/forum/createThread.php';
    }

    public function submitCreateThread(){
        $postData=$_POST;
        if(!isset($_SESSION['user']['id'])){
            throw new \Exception("Vous devez être connecté pour effectué cette action");
        }
        if(!isset($postData['title'],$postData['description'],$postData['content'],$postData['category_id'])){
            throw new \Exception("Formulaire de création de Thread Incorrect");
        }
        $title=htmlentities(strip_tags($postData['title']), ENT_QUOTES, 'UTF-8');
        $category_id=htmlentities(strip_tags($postData['category_id']));
        $description=htmlentities(strip_tags($postData['description']), ENT_QUOTES, 'UTF-8');
        $content=htmlentities(strip_tags($postData['content']), ENT_QUOTES, 'UTF-8');
        
        $thread = new Thread();
        $thread->setTitle($title);
        $thread->setCategoryId((int)$category_id);
        $thread->setDescription($description);
        $thread->setContent($content);
        $thread->setCreatedBy((int)$_SESSION['user']['id']);



        $forumRepository = new ForumRepository(new DatabaseConnection());
        $thread_Id=$forumRepository->createThread($thread);
        header('Location: index.php?action=thread&thread_id=' . $thread_Id);
    }

    public function displayThread(int $thread_id){
        if(!isset($_GET['thread_id']) || $_GET['thread_id']<1){
            throw new \Exception("Le thread n'existe pas");
        }
        $forumRepository = new ForumRepository(new DatabaseConnection());
        $thread = $forumRepository->getThreadById($thread_id);
        $comments = $forumRepository->getCommentsByThreadId($thread_id);
        require __DIR__ . '/../../templates/forum/thread.php';
    }

    public function createComment(int $thread_id){
         if(!isset($_GET['thread_id']) || $_GET['thread_id']<1){
            throw new \Exception("Le thread n'existe pas");
        }
        $thread_id=$_GET['thread_id'];
        $forumRepository = new ForumRepository(new DatabaseConnection());
        require __DIR__ . '/../../templates/forum/createComment.php';
    }

    public function submitCreateComment(int $thread_id){
        if(!isset($_SESSION['user']['id'])){
            throw new \Exception("Vous devez être connecté pour effectué cette action");
        }
        $postData=$_POST;

        if(!isset($postData['content'])){
            throw new \Exception("Formulaire de création de Thread Incorrect");
        }
        $content=htmlentities(strip_tags($postData['content']), ENT_QUOTES, 'UTF-8');
        
        $comment = new Comment();
        $comment->setContent($content);
        $comment->setCreatedBy((int)$_SESSION['user']['id']);
        $comment->setThreadId((int)$thread_id);



        $forumRepository = new ForumRepository(new DatabaseConnection());
        $forumRepository->createComment($comment);
        header('Location: index.php?action=thread&thread_id=' . $thread_id);
    }
}

