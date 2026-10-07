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

            <?php
            if ($this->success) {
                ?>
                <p>Votre mot de passe a été modifié.</p>
                <a href="index.php?action=login">Se connecter</a>
                <?php
            } else {
                if (isset($this->error['global'])) {
                    ?>
                    <p>
                        <?php echo htmlspecialchars($this->error['global']); ?>
                    </p>
                    <?php
                }

                if ($this->valid_token) {
                    ?>
                    <form action="index.php?action=resetPassword" method="POST">

                        <input
                            type="hidden"
                            name="token"
                            value="<?php echo htmlspecialchars($this->token); ?>"
                        >

                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?php echo htmlspecialchars($this->csrfToken); ?>"
                        >

                        <p>
                            Choisissez un mot de passe d'au moins 8 caractères.
                        </p>

                        <div>
                            <label for="password">
                                Nouveau mot de passe
                            </label>

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

                        <button type="submit">
                            Modifier mon mot de passe
                        </button>
                    </form>
                    <?php
                }
                ?>

                <p>
                    <a href="index.php?action=forgotPassword">
                        Demander un nouveau lien
                    </a>
                </p>

                <?php
            }
            ?>
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