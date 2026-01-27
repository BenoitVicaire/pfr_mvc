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
        'submitCreateAccount' => fn() =>(new Login())->createAccount($_POST['email'],$_POST['password'],$_POST['name']),
        'forum' => fn() =>(new Forum())->displayForum(),
        'homepage' => fn() =>(new Homepage())->displayHomepage(),
        '' => fn() =>(new Homepage())->displayHomepage(),
    ];
    
    $action=$_GET['action'] ?? null;

    if(!isset($routes[$action])){
        throw new \Exception("Erreur 404", 404);
    }
    $routes[$action]();

    
    // $allowedAction= ['login', 'logout','submitLogin','submitCreateAccount','forum'];
    // if(isset($_GET['action']) && in_array($_GET['action'], $allowedAction)){
    //     switch($_GET['action']){
    //         case 'login':
    //             (new Login())->displayLoginPage();
    //             break;
    //         case 'logout':
    //             (new Login())->logout();
    //             break;
    //         case 'submitLogin':
    //             (new Login())->login($_POST['email'],$_POST['password']);
    //             break;
    //         case 'submitCreateAccount':
    //             (new Login())->createAccount($_POST['email'],$_POST['password'],$_POST['name']);
    //             break;
    //         case 'forum' :
    //             (new Forum())->displayForum();
    //             break;
    //         default:
    //             throw new Exception("Error 404", 404);
                
    //             break;
    //     }
    // }else{
    //     throw new \Exception("Error 404", 404);
        
    // }
}catch(Exception $e){
    $errorMessage = $e->getMessage();
    require('../templates/errors.php');
}