<?php

namespace App\Views;

class SitemapView
{
    public function show(): void {
        ob_start();
        ?>

        <section>
            <h2>Les pages du site</h2>

            <ul>
                <li>
                    <a href="index.php">Accueil</a>
                </li>
                <li>
                    <a href="index.php?action=register">Inscription</a>
                </li>
                <li>
                    <a href="index.php?action=login">Connexion</a>
                </li>
                <li>
                    <a href="index.php?action=forgotPassword">
                        Mot de passe oublié
                    </a>
                </li>
                <li>
                    Nouveau mot de passe : accessible avec le lien
                    reçu par e-mail.
                </li>
                <li>
                    <a href="index.php?action=profil">
                        Mon profil — connexion nécessaire
                    </a>
                </li>
                <li>
                    <a href="index.php?action=sitemap">Plan du site</a>
                </li>
            </ul>
        </section>

        <?php
        $content = ob_get_clean();

        $layout = new Layout('Plan du site', $content);
        $layout->show();
    }
}