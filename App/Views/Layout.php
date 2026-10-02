<?php

namespace App\Views;

class Layout
{
public function __construct(private string $title, private string $content) {}
public function show(): void
{
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($this->title); ?></title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; display: flex; flex-direction: column; min-height: 100vh; }
        header { background: #333; color: #fff; padding: 1rem; }
        nav a { color: #fff; margin-right: 15px; text-decoration: none; }
        main { flex: 1; padding: 2rem; }
        footer { background: #222; color: #aaa; text-align: center; padding: 1rem; }
    </style>
</head>
<body>
<header>
    <h1><?= htmlspecialchars($this->title); ?></h1>
    <nav>
        <a href="/index.php">Accueil</a>
        <a href="/index.php?action=contact">Contact</a>
        <a href="/index.php?action=register">S'inscrire</a>
        <a href="/index.php?action=login">Se connecter</a>
    </nav>
</header>
<main>
    <?= $this->content; ?>
</main>
<footer>
    <p>&copy; <?= date('Y'); ?> - Tous droits réservés.</p>
</footer>
</body>
</html>
<?php
}
}