<?php
namespace App\Views;

class ForgotPasswordView
{
    public function __construct(
        private array $errors,
        private string $email,
        private string $message,
        private string $csrfToken
    ) {}

    public function show(): void
    {
        ob_start();
        ?>
        <section>
            <h2>Mot de passe oublié</h2>
            <p>Entrez l'adresse email de votre compte pour recevoir un lien.</p>

            <?php if (isset($this->errors['global'])) : ?>
                <p><?= htmlspecialchars($this->errors['global']) ?></p>
            <?php endif; ?>
            <?php if ($this->message !== '') : ?>
                <p><?= htmlspecialchars($this->message) ?></p>
            <?php endif; ?>

            <form action="index.php?action=forgotPassword" method="POST">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($this->csrfToken) ?>">
                <label for="email">Adresse e-mail</label>
                <input type="email" id="email" name="email" maxlength="255" autocomplete="email"
                       value="<?= htmlspecialchars($this->email) ?>" required>
                <button type="submit">Recevoir le lien</button>
            </form>
            <p><a href="index.php?action=login">Retour à la connexion</a></p>
        </section>
        <?php
        (new Layout('Mot de passe oublié - CyberCigales', ob_get_clean()))->show();
    }
}
