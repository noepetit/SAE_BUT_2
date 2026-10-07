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
        <a href="index.php?action=register" class="btn">S'inscrire</a>
    </section>

    <!-- Section Nos Services -->
    <section class="services-section">
        <h2>Nos Services</h2>
        <div class="services-grid">
            <div class="service-card">
                <img src="/Assets/img/image1.webp" alt="Illustration Service 1" class="service-img" loading="lazy">
                <h3>Service Placeholder 1</h3>
                <p>Description complète du service et de son intégration dans l'architecture CyberCigales. Conçu pour démontrer la structure multi-colonnes.</p>
            </div>
            <div class="service-card">
                <img src="/Assets/img/image2.webp" alt="Illustration Service 2" class="service-img" loading="lazy">
                <h3>Service Placeholder 2</h3>
                <p>Description complète du service et de son intégration dans l'architecture CyberCigales. Conçu pour démontrer la structure multi-colonnes.</p>
            </div>
            <div class="service-card">
                <img src="/Assets/img/image3.webp" alt="Illustration Service 3" class="service-img" loading="lazy">
                <h3>Service Placeholder 3</h3>
                <p>Description complète du service et de son intégration dans l'architecture CyberCigales. Conçu pour démontrer la structure multi-colonnes.</p>
            </div>
        </div>
    </section>

    <!-- Section À Propos -->
    <section class="about-section">
        <div class="about-content">
            <h2>À Propos de CyberCigales</h2>
            <p>CyberCigales représente une vision pragmatique de l'affichage web. Cette section démontre l'équilibre entre contenus descriptifs textuels et visuels sur de grands écrans, en conservant un alignement strict sur une grille invisible de 1280px.</p>
        </div>
        <div class="about-media">
            <img src="/Assets/img/favicon.png" alt="Logo CyberCigales" class="about-img" loading="lazy">
        </div>
    </section>

    <a href="#top" class="scrollTop" aria-label="Remonter en haut de la page">
        <span class="arrow"></span>
    </a>
        <?php
        (new Layout('Accueil - CyberCigales', ob_get_clean()))->show();
    }
}