<?php
namespace App\Controllers;

use \App\Models\UserRepository;
use \App\Views\ProfileView;
use \Core\Database;

class ProfileController
{
    public function execute(): void
    {

        // Si on n'est pas connecté, redirection vers login
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }
        // Connection à la base de donnée.
        $userRepository = new UserRepository(Database::getInstance()->getConnection());

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
            $userRepository->deleteUser($_SESSION['user_id']);
            $_SESSION = [];
            session_destroy();
            header('Location: index.php?action=login');
            exit();
        }

        $error = null;
        $success = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_username'])){
            $newUsername = trim($_POST['username'] ?? '');
            if ($newUsername === ''){
                $error = 'Le nom d\'utilisateur ne peut pas être vide';
            } else {
                $exist = $userRepository->findByUsername($newUsername);
                if ($exist !== null && $exist->id != $_SESSION['user_id']) {$error = 'Nom d\'utilisateur déjâ existant';}
                else{
                    $userRepository->updateUsername($_SESSION['user_id'], $newUsername);
                    $success = 'Pseudo mis à jour.';
                }
            }

        }

        // On récupère les infos de l'utilisateur en BDD
        $user = $userRepository->findById($_SESSION['user_id']);

        // Sécurité supplémentaire : si l'utilisateur a été supprimé
        if ($user === null) {
            header('Location: index.php?action=logout');
            exit();
        }

        //On affiche la vue en lui passant l'objet utilisateur
        (new ProfileView($user, $error, $success))->show();
    }
}