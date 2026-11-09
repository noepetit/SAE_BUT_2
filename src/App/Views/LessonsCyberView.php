<?php

namespace App\Views;

class LessonsCyberView
{
    public function __construct() {}
    public function show(): void
    {
    ob_start();
    ?>
        <section>
            <h1>Cours de Cybersécurité</h1>
            <div class="LessonsCyber-container">
                <div class="LessonsCyber-lessons">
                    <h2>1. </h2>
                    <a>skjflkjqlkjh fljbqsjfbdjkb</a>
                </div>
                <div class="LessonsCyber-summary">
                    <h3>1. Un réseau, c'est quoi ?</h3>
                    <h3>2. De quoi est-il composé ?</h3>
                    <h3>3.Adresse IP ?</h3>
                    <h3>4. Quelques commandes.</h3>
                </div>
            </div>
        </section>

    <?php
        (new Layout('Cours - Cybersécurité', ob_get_clean()))->show();
    }
}