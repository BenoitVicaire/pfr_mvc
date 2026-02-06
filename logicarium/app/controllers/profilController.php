<?php
namespace App\Controllers\ProfilController;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../models/profilModel.php';

use App\model\ProfilModel\ProfilRepository;
use App\utils\Database\DatabaseConnection;

class Profil{

    public function displayProfil(){
        require __DIR__ . '/../../templates/profil.php';
    }

    public function updateAvatar(){
        if(!isset($_SESSION['user']['id'])){
            throw new \Exception("Avatar non trouvé");
        }
        // Récupération des données JSON envoyées par JS
        $data = json_decode(file_get_contents("php://input"), true);
        $avatarId = (int)($data['avatar_id'] ?? 0);

        if($avatarId<0){
            throw new \Exception("avatar_Id invalide");
        }
        $profilRepository = new ProfilRepository(new DatabaseConnection);
        $profilRepository->updateAvatar($avatarId, $_SESSION['user']['id']);

        echo json_encode(['success' => true]);
    }
    
}
