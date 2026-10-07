<?php
namespace App\Controllers;
use Assets\Includes\Database;
use App\Models\UserRepository;
use App\Views\LoginView;
use Assets\Includes\Exceptions\ControllerException;

class LoginController
{
    public function execute(): void
    {
        $userRepository = new UserRepository(Database::getInstance()->getConnection());
        $errors = [];
        $old = [];
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            (new LoginView($errors, $old, $_SESSION['csrf_token']))->show();
            return;
        }
        $token = $_POST["csrf_token"] ?? '';
        if ($token === '' || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            throw new ControllerException('requete invalide');
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $old = ['email' => $email];

        $user =$userRepository->findByEmail($email);
        if ($user === null || !password_verify($password, $user->pwd_hash)) {
            $errors['global'] = 'identifiant incorrect';
            (new LoginView($errors, $old, $_SESSION['csrf_token']))->show();
            return;
        }
        session_regenerate_id(true);
        unset($_SESSION['csrf_token']);
        $_SESSION['user_id'] = $user->id;
        header('Location: index.php');
        exit();
    }
}