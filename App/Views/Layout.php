<?php

namespace App\Views;

class Layout
{
private string $content;private string $title;public function __construct(string $title, string $content)
{
    $this->title = $title;
    $this->content = $content;
}

public function show(): void
{
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Notre site présente une description d'un jeu ludique autour de la cybersécurité">
    <title><?= htmlspecialchars($this->title); ?></title>
    <link rel="stylesheet" href="/Assets/css/styles.css">
    <link rel="icon" type="image/png" href="/Assets/img/favicon.png">
</head>
<body id="top">
<header>
    <a href="index.php" class="site-title">CyberCigales</a>
    <input type="checkbox" id="menu-toggle" class="menu-toggle" aria-label="Menu de navigation">
    <label for="menu-toggle" class="burger-btn">
        <span></span>
        <span></span>
        <span></span>
    </label>
    <nav class="nav-menu">
        <a href="index.php">Accueil</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Page dispo connecté -->
            <a href="index.php?action=profil">Profil</a>
            <a href="index.php?action=logout">Se déconnecter</a>
        <?php else: ?>
            <!-- Pages dispo deconnecté -->
            <a href="/index.php?action=register">S'inscrire</a>
            <a href="/index.php?action=login">Se connecter</a>
        <?php endif; ?>
    </nav>
</header>
<main>
    <?= $this->content; ?>
</main>
<footer>
    <p><a href="index.php?action=sitemap">Plan du site</a></p>
    <p>&copy; <?= date('Y'); ?> - Tous droits réservés.</p>
    <a href="/index.php?action=mention">Mentions légales</a>
    <a href="#top" class="scrollTop" aria-label="Remonter en haut de la page" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;>
        <span class="arrow"></span>
    </a>
</footer>
<script src="/Assets/Scripts/konami.js"></script>
</body>
</html>
<?php
}
}
