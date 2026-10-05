<?php
namespace App\Views;

class ProfilView
{
    // On injecte l'objet $user dans le constructeur
    public function __construct(private object $user) {}

    public function show(): void
    {
        ob_start();
        ?>
        <section>
            <h2>Mon Profil</h2>
            <div class="profil-card" style="background: #f4f4f4; padding: 2rem; border-radius: 8px; margin-top: 1rem;">
                <p><strong>Prénom :</strong> <?= htmlspecialchars($this->user->first_name) ?></p>
                <p><strong>Nom :</strong> <?= htmlspecialchars($this->user->last_name) ?></p>
                <p><strong>Email :</strong> <?= htmlspecialchars($this->user->email) ?></p>
                <p><strong>Pseudo :</strong> <?= htmlspecialchars($this->user->username) ?></p>
            </div>
        </section>
        <?php
        (new Layout('Mon Profil - CyberCigales', ob_get_clean()))->show();
    }
}