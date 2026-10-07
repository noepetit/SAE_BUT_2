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
    <h1><?= htmlspecialchars($this->title); ?></h1>
    <nav>
        <a href="/index.php">Accueil</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Page dispo connecté -->
            <a href="/index.php?action=profil">Profil</a>
            <a href="/index.php?action=logout">Se déconnecter</a>
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
    <p>&copy; <?= date('Y'); ?> - Tous droits réservés.</p>
    <a href="/index.php?action=mention">Mentions légales</a>
</footer>
<script src="/Assets/Scripts/konami.js"></script>
</body>
</html>
<?php
}
}
