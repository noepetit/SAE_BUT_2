<?php
namespace App\Views;

class ProfileView
{
    // On injecte l'objet $user dans le constructeur
    public function __construct(private object $user, private ?string $error = null, private ?string $success = null) {}

    public function show(): void
    {
        ob_start();
        ?>
        <section>
            <h2>Mon Profil</h2>
            <?php if ($this->error != null) : ?>
                <p class="err"><?= htmlspecialchars($this->error)?></p>
            <?php endif; ?>
            <?php if ($this->success != null) : ?>
                <p class="suc"><?= htmlspecialchars($this->success)?></p>
            <?php endif; ?>
            <div class="profil-card">
                <p><strong>Prénom :</strong> <?= htmlspecialchars($this->user->first_name) ?></p>
                <p><strong>Nom :</strong> <?= htmlspecialchars($this->user->last_name) ?></p>
                <p><strong>Email :</strong> <?= htmlspecialchars($this->user->email) ?></p>
                <p><strong>Pseudo :</strong> <?= htmlspecialchars($this->user->username) ?></p>
            </div>
            <form method="post" action="index.php?action=profile">
                <label for="username"><strong>Pseudo</strong></label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($this->user->username) ?>" required>
                <button type="submit" name="update_username">Enregistrer</button>
            </form>

        </section>
        <form method="post" action="index.php?action=profile" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible')">
            <button type="submit" name="delete_user" class="btn-danger">Supprimer mon compte.</button>
        </form>
        <?php
        (new Layout('Mon Profil - CyberCigales', ob_get_clean()))->show();
    }
}