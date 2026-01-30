<?php
session_start();

require_once __DIR__ . '/../app/controllers/loginController.php';
require_once __DIR__ . '/../app/controllers/forumController.php';
require_once __DIR__ . '/../app/controllers/homepageController.php';

use App\Controllers\LoginController\Login;
use App\Controllers\ForumController\Forum;
use App\Controllers\HomepageController\Homepage;

try{
    $routes =[
        'login' => fn() =>(new Login())->displayLoginPage(),
        'logout' => fn() =>(new Login())->logout(),
        'submitLogin' => fn() =>(new Login())->login($_POST['email'],$_POST['password']),
        'submitCreateAccount' => fn() =>(new Login())->createAccount($_POST['email'],$_POST['password'],$_POST['password2'],$_POST['name']),
        'forum' => fn() =>(new Forum())->displayForum(),
        'createNewThread' => fn() =>(new Forum())->createNewThread(),
        'submitCreateThread' => fn() =>(new Forum())->submitCreateThread($_POST['title'],$_POST['description'],$_POST['content']),
        'homepage' => fn() =>(new Homepage())->displayHomepage(),
        'thread' => fn() =>(new Forum())->displayThread($_GET['thread_id']),
        '' => fn() =>(new Homepage())->displayHomepage(),
    ];
    
    $action=$_GET['action'] ?? null;

    if(!isset($routes[$action])){
        throw new \Exception("Erreur 404", 404);
    }
    $routes[$action]();

    
}catch(Exception $e){
    $errorMessage = $e->getMessage();
    require('../templates/errors.php');
}