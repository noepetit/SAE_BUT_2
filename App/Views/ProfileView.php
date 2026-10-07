<?php
namespace App\Views;

class ProfileView
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
        <form method="post" action="index.php?action=profile" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible')">
            <button type="submit" name="delete_user" class="btn-danger">Supprimer mon compte.</button>
        </form>
        <?php
        (new Layout('Mon Profil - CyberCigales', ob_get_clean()))->show();
    }
}