<?php
namespace App\Controllers;

use Assets\Includes\Database;
use App\Models\UserRepository;
use App\Models\PasswordResetRepository;
use App\Views\ForgotPasswordView;

class ForgotPasswordController
{
    public function execute(): void
    {
        header('Cache-Control: no-store');
        $errors = [];
        $email = '';
        $message = '';

        if (!isset($_SESSION['password_csrf'])) {
            $_SESSION['password_csrf'] = bin2hex(random_bytes(32));
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $csrfToken = filter_input(INPUT_POST, 'csrf_token') ?: '';
            $email = trim(filter_input(INPUT_POST, 'email') ?: '');

            if (!hash_equals($_SESSION['password_csrf'], $csrfToken)) {
                $errors['global'] = 'Formulaire invalide.';
            } elseif (strlen($email) > 255 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['global'] = 'Entrez une adresse e-mail valide.';
            } else {
                $message = 'Si un compte correspond à cette adresse, un lien vous sera envoyé. ' . 'Si vous venez de faire une demande, patientez une minute.';

                if (time() - ($_SESSION['password_last_request'] ?? 0) >= 60) {
                    $_SESSION['password_last_request'] = time();
                    try {
                        $connection = Database::getInstance()->getConnection();
                        $userRepository = new UserRepository($connection);
                        $resetRepository = new PasswordResetRepository($connection);
                        $config = require __DIR__ . '/../../Assets/Includes/password_reset_config.php';
                        $user = $userRepository->findByEmail($email);

                        if ($user !== null) {
                            $token = bin2hex(random_bytes(32));
                            $tokenHash = hash('sha256', $token);

                            $resetRepository->createResetToken($user->id, $tokenHash);
                            $resetPage = rtrim($config['site_url'], '/');
                            $link = $resetPage . '&token=' . $token;
                            $body = "Bonjour,\n\n"
                                . "Pour choisir un nouveau mot de passe, cliquez sur ce lien :\n"
                                . $link . "\n\n"
                                . "Votre code de réinitialisation :\n"
                                . $token . "\n\n"
                                . "Le code sera automatiquement rempli sur la page.\n"
                                . "Sinon, copiez-collez le code dans le champ prévu.\n\n"
                                . "Si le lien ne fonctionne pas, ouvrez cette page :\n"
                                . $resetPage . "\n\n"
                                . "Ce code expire dans 30 minutes. Ne le partagez pas.\n";
                            $headers = [
                                'From' => $config['mail_from'],
                                'Content-Type' => 'text/plain; charset=UTF-8'
                            ];
                            $sent = mail($user->email, 'CyberCigales - Mot de passe oublie', $body, $headers);
                            if (!$sent) {
                                $resetRepository->deleteToken($tokenHash);
                            }
                        }
                    } catch (\Throwable $e) {
                        error_log('Mot de passe oublie : echet (' . get_class($e) . ')');
                    }
                }
            }
        }

        (new ForgotPasswordView($errors, $email, $message, $_SESSION['password_csrf']))->show();
    }
}

