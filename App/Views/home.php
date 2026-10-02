<?php

namespace App\Views;

class Home
{
    public function show(): void
    {
        ob_start();
?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>CyberCigales</title>
        </head>
        <body>
            <header class="topbar">
                <div class="logo">CyberCigales</div>
                <nav>Accueil  Inscription  Connexion  Mentions légales</nav>
            </header>

            <main class="container">
                <section class="hero">
                    <div class="hero-text">
                        <h1>cybercigales</h1>
                        <p>Projet WEB ]</p>
                        <button>Inscription</button>
                    </div>
                </section>

                <section class="services">
                    <h2>services</h2>
                    <div class="cards">
                        <article>texte a mettre</article>
                        <article>texte a mettre</article>
                        <article>texte a mettre</article>
                    </div>
                </section>

                <section class="about">
                    <h2>À Propos de CyberCigales</h2>
                    <p>Texte de présentation du site.</p>
                </section>
            </main>

            <footer>Mentions légales ...</footer>
        </body>
        </html>
<?php
        echo ob_get_clean();
    }
}