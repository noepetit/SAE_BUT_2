<?php

namespace App\Views;

class HomeView
{
    public function show(): void
    {
        ob_start();
        ?><section>
        <h1>cybercigales</h1>
        <h2>Découvrez des jeux ludiques sur la cybersécurité</h2>
        <p>Découvrez l'univers de cybercigales à travers nos jeux ludiques.<br>
            L'expérience que nous proposons est une initiation à la cybersécurité à travers des jeux ludiques.<br>
            Le jeu est un escape game sous forme de CTF (Capture The Flag) : le premier à trouver et prendre le drapeau de l'adversaire gagne.<br>
            Pour cela vous devez réaliser une série d'épreuves qui vous mèneront au drapeau de l'adversaire.
        </p>
    </section>
        <?php
        (new Layout('Accueil - CyberCigales', ob_get_clean()))->show();
    }
}