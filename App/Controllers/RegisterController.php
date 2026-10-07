<?php
namespace App\Controllers;
use Assets\Includes\Database;
use App\Models\UserRepository;
use App\Views\RegisterView;
use Assets\Includes\Exceptions\ControllerException;
use PDOException;

class RegisterController
{
    public function execute(): void
    {
        $userRepository = new UserRepository(Database::getInstance()->getConnection());
        $errors = [];
        $old = [];
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            (new RegisterView($errors, $old, $_SESSION['csrf_token']))->show();
            return;
        }
        $token = $_POST["csrf_token"] ?? '';
        if ($token === '' || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            throw new ControllerException('requete invalide');
        }
        $last_name = trim($_POST['last_name'] ?? '');
        $first_name = trim($_POST['first_name'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $old = [
            'last_name' => $last_name,
            'first_name' => $first_name,
            'username' => $username,
            'email' => $email
        ];
        // géstion erreur coté serveurs
        if ($last_name === '' || mb_strlen($last_name) > 50) {
            $errors['last_name'] = 'Le nom est invalide';
        }
        if ($first_name === '' || mb_strlen($first_name) > 50) {
            $errors['first_name'] = 'Le prenom est invalide';
        }
        if (mb_strlen($username) <3 || mb_strlen($username) > 50) {
            $errors['username'] = 'L\'username est invalide';
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false || mb_strlen($email) > 255) {
            $errors['email'] = 'L\'email est invalide';
        }
        if (mb_strlen($password) < 8) {
            $errors['password'] = 'Le mot de passe est trop court';
        }
        if (!empty($errors)) {
            (new RegisterView($errors, $old, $_SESSION['csrf_token']))->show();
            return;
        }
        if ($userRepository->emailOrUsernameExists($email, $username)) {
            $errors['global'] ='Email ou username existant';
            (new RegisterView($errors, $old, $_SESSION['csrf_token']))->show();
            return;
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        try{
            $userRepository->createUser($email, $username, $first_name, $last_name, $hashedPassword);
        }catch(PDOException $e){
            if ($e->getCode() === '23000') {
                $errors['global'] = 'Email ou username existant';
            }else {
                error_log($e->getMessage());
                $errors['global'] = 'une erreur est survenue';
            }
            (new RegisterView($errors, $old, $_SESSION['csrf_token']))->show();
            return;
        }
        unset($_SESSION['csrf_token']);
        header('Location: index.php?action=login');
        exit();
    }
}