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
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="index.php?action=register" class="btn">S'inscrire</a>
        <?php endif; ?>
    </section>

    <section class="services-section">
        <h2>Nos Services</h2>
        <div class="services-grid">
            <div class="service-card">
                <img src="/Assets/img/image1.webp" alt="Illustration Service 1" class="service-img" loading="lazy">
                <h3>Initiation à la Cybersécurité</h3>
                <p>Apprenez les bases de la cybersécurité à travers nos jeux ludiques.</p>
            </div>
            <div class="service-card">
                <img src="/Assets/img/image2.webp" alt="Illustration Service 2" class="service-img" loading="lazy">
                <h3>Jeux de Cybersécurité</h3>
                <p>Participez à nos jeux de cybersécurité pour mettre vos compétences à l'épreuve.</p>
            </div>
            <div class="service-card">
                <img src="/Assets/img/image3.webp" alt="Illustration Service 3" class="service-img" loading="lazy">
                <h3>Cohésion d'Équipe</h3>
                <p>Renforcez la collaboration et la communication au sein de votre équipe à travers nos activités de cybersécurité.</p>
            </div>
        </div>
    </section>


    <section class="about-section">
        <div class="about-content">
            <h2>À Propos de CyberCigales</h2>
            <p>CyberCigales est une plateforme dédiée à l'apprentissage de la cybersécurité à travers des jeux ludiques. Notre objectif est de rendre l'apprentissage de la cybersécurité accessible pour tous. Site conçu dans le cadre du projet développement web et de la SAE 2ème année.</p>
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