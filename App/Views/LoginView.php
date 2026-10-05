<?php
namespace App\Views;
class LoginView
{
    public function __construct(private array $errors, private array $old, private string $csrfToken){}
    public function show(): void
    {
        ob_start();
        ?>
        <section>
            <h2>Connexion</h2>

            <?php if (isset($this->errors['global'])) :?>
                <p><?=htmlspecialchars($this->errors['global'])?></p>
            <?php endif;?>

            <form action="index.php?action=login" method="POST">
                <input type="hidden" name="csrf_token" value="<?=htmlspecialchars($this->csrfToken)?>">
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?=htmlspecialchars($this->old['email'] ?? '')?>" placeholder="votre@email.com" required>
                </div>
                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="********" required>
                </div>
                <button type="submit">Se connecter</button>
            </form>
            <div>
                <a href="index.php?action=forgotPassword">Mot de passe oublié ?</a>
                <br>
                <a href="#">Pas encore inscrit ? S'inscrire</a>
            </div>
        </section>

        <?php

        (new Layout('Connexion - CyberCigales', ob_get_clean()))->show();
    }
}