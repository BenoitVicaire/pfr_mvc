<?php 
namespace App\Controllers\forumController;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../models/forumModel.php';

use App\Model\ForumModel\ForumRepository;
use App\Model\ForumModel\Thread;
use App\Utils\Database\DatabaseConnection;

class Forum{
    public function displayForum(){
        $forumRepository = new ForumRepository(new DatabaseConnection());
        $threads = $forumRepository->getThreads();
        require __DIR__ . '/../../templates/forum/forum.php';
    }

    public function createNewThread(){
        require __DIR__ . '/../../templates/forum/createThread.php';
    }

    public function submitCreateThread(){
        $postData=$_POST;
        if(!isset($_SESSION['user']['id'])){
            throw new \Exception("Vous devez être connecté pour effectué cette action");
        }
        if(!isset($postData['title'],$postData['description'],$postData['content'])){
            throw new \Exception("Formulaire de création de Thread Incorrect");
        }
        $title=htmlentities(strip_tags($postData['title']));
        $description=htmlentities(strip_tags($postData['description']));
        $content=htmlentities(strip_tags($postData['content']));
        
        $thread =new Thread;
        $thread->title=$title;
        $thread->description=$description;
        $thread->content=$content;
        $thread->created_by=$_SESSION['user']['id'];


        $forumRepository = new ForumRepository(new DatabaseConnection());
        $forumRepository->createThread($thread);
    }

    public function displayThread($thread_id){
        if(!isset($_GET['thread_id']) || $_GET['thread_id']<1){
            throw new \Exception("Le thread n'existe pas");
        }
        $forumRepository = new ForumRepository(new DatabaseConnection());
        $thread = $forumRepository->getThreadById($thread_id);
        require __DIR__ . '/../../templates/forum/thread.php';
    }
}

