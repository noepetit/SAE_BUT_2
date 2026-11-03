<?php
namespace App\Views;

class LoginView
{
    public function __construct(private array $errors, private array $old, private string $csrfToken){}
    public function show(): void
    {
        ob_start();
        ?>
        <section class="login-section">
            <h1>Connexion</h1>
            <form action="index.php?action=login" method="POST">
                <input type="hidden" name="csrf_token" value="<?=htmlspecialchars($this->csrfToken)?>">
                <div class="login-container">
                    <?php if (isset($this->errors['global'])) :?>
                        <p class="err"><?=htmlspecialchars($this->errors['global'])?></p>
                    <?php endif;?>
                    <div class="login-card">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?=htmlspecialchars($this->old['email'] ?? '')?>" placeholder="votre@email.com" required>
                    </div>
                    <div class="login-card">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" placeholder="********" required>
                    </div>
                    <button type="submit" class="btn">Se connecter</button>
                </div>
            </form>
            <div>
                <p href="index.php?action=forgotPassword">Mot de passe oublié ?</p>
                <p>Pas encore inscrit ?  <a href="index.php?action=register">S'inscrire</a> </p>
            </div>
        </section>

        <?php

        (new Layout('Connexion - CyberCigales', ob_get_clean()))->show();
    }
}