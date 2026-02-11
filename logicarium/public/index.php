<?php
session_start();
define('BASE_URL', '/PFR_MVC/logicarium/public');
define('ROOT', realpath(__DIR__ . '/../') . '/');
require_once __DIR__ . '/../app/Utils/Autoloader.php';

use App\Utils\Autoloader;

Autoloader::register();

use App\Controllers\ContactController\Contact;
use App\Controllers\LoginController\Login;
use App\Controllers\ForumController\Forum;
use App\Controllers\HomepageController\Homepage;
use App\Controllers\MessagesController\Messages;
use App\Controllers\profilController\Profil;

try{
    $routes =[
        'login' => fn() =>(new Login())->displayLoginPage(),
        'logout' => fn() =>(new Login())->logout(),
        'submitLogin' => fn() =>(new Login())->login($_POST['email'],$_POST['password']),
        'submitCreateAccount' => fn() =>(new Login())->createAccount($_POST['email'],$_POST['password'],$_POST['password2'],$_POST['name']),
        'forum' => fn() =>(new Forum())->displayForum(),
        'createNewThread' => fn() =>(new Forum())->createNewThread(),
        'submitCreateThread' => fn() =>(new Forum())->submitCreateThread($_POST['title'],$_POST['category_id'],$_POST['description'],$_POST['content']),
        'homepage' => fn() =>(new Homepage())->displayHomepage(),
        'thread' => fn() =>(new Forum())->displayThread($_GET['thread_id']),
        'contact' => fn() =>(new Contact())->displayContact(),
        'myProfil' => fn() =>(new Profil())->displayProfil(),
        'messages' => fn() =>(new Messages())->displayMessages(),
        'createComment' => fn() =>(new Forum())->createComment($_GET['thread_id']),
        'submitCreateComment' => fn() =>(new Forum())->submitCreateComment($_POST['thread_id'],$_POST['content']),
        '' => fn() =>(new Homepage())->displayHomepage(),
    ];
    
    $action=$_GET['action'] ?? null;

    if(!isset($routes[$action])){
        throw new \Exception("Erreur 404", 404);
    }
    $routes[$action]();

    
}catch(Exception $e){
    $errorMessage = $e->getMessage();
    require('../templates/common/errors.php');
}