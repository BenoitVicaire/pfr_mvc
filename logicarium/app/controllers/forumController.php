<?php 
namespace App\Controllers\forumController;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../models/forumModel.php';

use App\Model\ForumModel\Category;
use App\Model\ForumModel\Comment;
use App\Model\ForumModel\ForumRepository;
use App\Model\ForumModel\Thread;
use App\Utils\Database\DatabaseConnection;

class Forum{
    public function displayForum(){
        $forumRepository = new ForumRepository(new DatabaseConnection());
        $categorys = $forumRepository->getCategorys();
        $threadsByCategory = $forumRepository->getThreadsByCategory();
        require __DIR__ . '/../../templates/forum/forum.php';
    }

    public function createNewThread(){
        $forumRepository = new ForumRepository(new DatabaseConnection());
        $categorys = $forumRepository->getCategorys();
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
        
        $thread =new Thread;
        $thread->title=$title;
        $thread->category_id=$category_id;
        $thread->description=$description;
        $thread->content=$content;
        $thread->created_by=$_SESSION['user']['id'];


        $forumRepository = new ForumRepository(new DatabaseConnection());
        $thread_Id=$forumRepository->createThread($thread);
        header('Location: index.php?action=thread&thread_id=' . $thread_Id);
    }

    public function displayThread($thread_id){
        if(!isset($_GET['thread_id']) || $_GET['thread_id']<1){
            throw new \Exception("Le thread n'existe pas");
        }
        $forumRepository = new ForumRepository(new DatabaseConnection());
        $thread = $forumRepository->getThreadById($thread_id);
        $comments = $forumRepository->getCommentsByThreadId($thread_id);
        require __DIR__ . '/../../templates/forum/thread.php';
    }

    public function createComment($thread_id){
         if(!isset($_GET['thread_id']) || $_GET['thread_id']<1){
            throw new \Exception("Le thread n'existe pas");
        }
        $thread_id=$_GET['thread_id'];
        $forumRepository = new ForumRepository(new DatabaseConnection());
        require __DIR__ . '/../../templates/forum/createComment.php';
    }

    public function submitCreateComment($thread_id){
        if(!isset($_SESSION['user']['id'])){
            throw new \Exception("Vous devez être connecté pour effectué cette action");
        }
        $postData=$_POST;

        if(!isset($postData['content'])){
            throw new \Exception("Formulaire de création de Thread Incorrect");
        }
        $content=htmlentities(strip_tags($postData['content']), ENT_QUOTES, 'UTF-8');
        
        $comment =new Comment;
        $comment->content=$content;
        $comment->created_by=$_SESSION['user']['id'];
        $comment->thread_id=$thread_id;


        $forumRepository = new ForumRepository(new DatabaseConnection());
        $forumRepository->createComment($comment);
        header('Location: index.php?action=thread&thread_id=' . $thread_id);
    }
}

