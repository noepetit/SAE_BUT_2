<?php
namespace App\Controllers;

use Assets\Includes\Database;
use App\Models\UserRepository;
use App\Views\ProfileView;

class ProfileController
{
    public function execute(): void
    {
        // Si on n'est pas connecté, redirection vers login
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }

        // On récupère les infos de l'utilisateur en BDD
        $userRepository = new UserRepository(Database::getInstance()->getConnection());
        $user = $userRepository->findById($_SESSION['user_id']);

        // Sécurité supplémentaire : si l'utilisateur a été supprimé
        if ($user === null) {
            header('Location: index.php?action=logout');
            exit();
        }

        //On affiche la vue en lui passant l'objet utilisateur
        (new ProfileView($user))->show();
    }
}