<?php
namespace App\Views;
class LoginView
{
    public function show(): void
    {
        ob_start();
        ?>
        <section>
            <h2>Connexion</h2>
            <form action="index.php?action=login" method="POST">
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="votre@email.com" required>
                </div>
                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="********" required>
                </div>
                <button type="submit">Se connecter</button>
            </form>
            <div>
                <a href="#">Mot de passe oublié ?</a>
                <br>
                <a href="#">Pas encore inscrit ? S'inscrire</a>
            </div>
        </section>

        <?php

        (new Layout('Connexion - CyberCigales', ob_get_clean()))->show();
    }
}