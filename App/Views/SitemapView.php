<?php

namespace App\Views;

class SitemapView
{
    public function show(int $page, int $totalPages): void
    {
        ob_start();
        ?>
        <section>
            <h2>Les pages du site</h2>

            <?php if ($page === 1): ?>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php?action=register">Inscription</a></li>
                    <li><a href="index.php?action=login">Connexion</a></li>
                </ul>
            <?php else: ?>
                <ul>
                    <li><a href="index.php?action=forgotPassword">Mot de passe oublié</a></li>
                    <li>Nouveau mot de passe : accessible avec le lien reçu par e-mail.</li>
                    <li><a href="index.php?action=profil">Mon profil — connexion nécessaire</a></li>
                    <li><a href="index.php?action=sitemap">Plan du site</a></li>
                </ul>
            <?php endif; ?>

            <nav class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?action=sitemap&page_num=<?= $page - 1; ?>">&laquo; Précédent</a>
                <?php endif; ?>
                <span>Page <?= $page; ?> / <?= $totalPages; ?></span>
                <?php if ($page < $totalPages): ?>
                    <a href="?action=sitemap&page_num=<?= $page + 1; ?>">Suivant &raquo;</a>
                <?php endif; ?>
            </nav>
        </section>
        <?php
        $content = ob_get_clean();
        (new Layout('Plan du site', $content))->show();
    }
}