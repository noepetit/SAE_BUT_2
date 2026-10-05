<?php
namespace App\Controllers\ResetPassword;

use Assets\Includes\Database;
use App\Models\PasswordResetRepository;
use App\Models\UserRepository;
use App\Views\ResetPasswordView;

class ResetPasswordController
{
    public function execute(): void
    {
        header('Cache-Control: no-store');
        header('Referrer-Policy: no-referrer');

        if (!isset($_SESSION['password_csrf'])) {
            $_SESSION['password_csrf'] = bin2hex(random_bytes(32));
        }

        $isPost = $_SERVER['REQUEST_METHOD'] === 'POST';

        if ($isPost) {
            $token = filter_input(INPUT_POST, 'token') ?: '';
        } else {
            $token = filter_input(INPUT_GET, 'token') ?: '';
        }

        $connection = Database::getInstance()->getConnection();
        $resetRepository = new PasswordResetRepository($connection);
        $userRepository = new UserRepository($connection);

        $errors = [];
        $success = false;
        $request = null;

        try {
            $connection->beginTransaction();

            $tokenHash = hash('sha256', $token);
            $request = $resetRepository->findValidByToken($tokenHash);

            if ($request === null) {
                $errors['global'] = 'Ce lien est invalide ou expiré.';
            } elseif ($isPost) {
                $csrfToken = filter_input(INPUT_POST, 'csrf_token') ?: '';
                $password = filter_input(INPUT_POST, 'password') ?: '';
                $confirmation = filter_input(INPUT_POST, 'password_confirmation') ?: '';

                if (!hash_equals($_SESSION['password_csrf'], $csrfToken)) {
                    $errors['global'] = 'Formulaire invalide. Rouvrez le lien reçu.';
                } elseif (mb_strlen($password) < 8) {
                    $errors['global'] = 'Le mot de passe doit contenir au moins 8 caractères.';
                } elseif (strlen($password) > 72 || str_contains($password, "\0")) {
                    $errors['global'] = 'Le mot de passe est trop long ou invalide.';
                } elseif ($password !== $confirmation) {
                    $errors['global'] = 'Les deux mots de passe sont différents.';
                } else {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                    $userRepository->updatePwd($request->user_id, $passwordHash);
                    $resetRepository->deleteByUserId($request->user_id);

                    $success = true;
                }
            }

            $connection->commit();
        } catch (\Throwable $e) {
            if ($connection->inTransaction()) {
                $connection->rollBack();
            }

            $request = null;
            $success = false;
            $errors['global'] = 'Une erreur est survenue. Réessayez plus tard.';
            error_log('Réinitialisation : échec (' . get_class($e) . ')');
        }

        if ($success) {
            unset($_SESSION['user_id']);
            session_regenerate_id(true);
        }

        $valid_token = $request !== null && !$success;

        (new ResetPasswordView(
            $errors,
            $token,
            $valid_token,
            $_SESSION['password_csrf'],
            $success
        ))->show();
    }
}