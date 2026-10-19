<?php
namespace App\Views;

class ResetPasswordView
{
    private array $error;
    private string $token;
    private bool $valid_token;
    private string $csrfToken;
    private bool $success;

    public function __construct(
        array $error,
        string $token,
        bool $valid_token,
        string $csrfToken,
        bool $success
    ) {
        $this->error = $error;
        $this->token = $token;
        $this->valid_token = $valid_token;
        $this->csrfToken = $csrfToken;
        $this->success = $success;
    }

    public function show(): void
    {
        ob_start();
        ?>

        <section>
            <h2>Nouveau mot de passe</h2>

            <?php if ($this->success) : ?>

                <p>Votre mot de passe a été modifié.</p>
                <a href="index.php?action=login">Se connecter</a>

            <?php else : ?>

                <?php if (isset($this->error['global'])) : ?>
                    <p>
                        <?= htmlspecialchars($this->error['global']) ?>
                    </p>
                <?php endif; ?>

                <form action="index.php?action=resetPassword" method="POST">

                    <input
                            type="hidden"
                            name="csrf_token"
                            value="<?= htmlspecialchars($this->csrfToken) ?>"
                    >

                    <div>
                        <label for="token">Code de réinitialisation</label>

                        <input
                                type="text"
                                id="token"
                                name="token"
                                value="<?= htmlspecialchars($this->token) ?>"
                                minlength="64"
                                maxlength="64"
                                pattern="[a-f0-9]{64}"
                                autocomplete="off"
                                spellcheck="false"
                                required
                        >

                        <p>
                            Si ce champ est vide, copiez-collez
                            le code reçu par e-mail.
                        </p>
                    </div>

                    <p>
                        Choisissez un mot de passe d'au moins 8 caractères.
                    </p>

                    <div>
                        <label for="password">Nouveau mot de passe</label>

                        <input
                                type="password"
                                id="password"
                                name="password"
                                minlength="8"
                                maxlength="72"
                                autocomplete="new-password"
                                required
                        >
                    </div>

                    <div>
                        <label for="password_confirmation">
                            Confirmez le mot de passe
                        </label>

                        <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                minlength="8"
                                maxlength="72"
                                autocomplete="new-password"
                                required
                        >
                    </div>

                    <button type="submit">Modifier mon mot de passe</button>
                </form>

                <p>
                    <a href="index.php?action=forgotPassword">
                        Demander un nouveau lien
                    </a>
                </p>

            <?php endif; ?>
        </section>

        <?php
        $content = ob_get_clean();

        $layout = new Layout(
                'Nouveau mot de passe - CyberCigales',
                $content
        );

        $layout->show();
    }
}