<?php
namespace App\Views;
class InscriptionView
{
    public function __construct(private array $errors, private array $old, private string $csrfToken){}
    public  function show(): void
    {
        ob_start();?>

<form method="POST" action="index.php?action=register">
    <input type="hidden" name="csrf_token" value="<?=htmlspecialchars($this->csrfToken); ?>">
    <?php if (isset($this->errors['global'])) :?>
        <p><?= htmlspecialchars($this->errors['global']) ?></p>
    <?php endif;?>


    <label for="last_name">Votre nom</label>
    <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($this->old['last_name'] ?? '');?>" placeholder="Entrez votre nom ..." required>
    <?php if (isset($this->errors['last_name'])) :?>
    <p><?= htmlspecialchars($this->errors['last_name']) ?></p>
    <?php endif;?>

    <br />

    <label for="first_name">Votre prénom</label>
    <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($this->old['first_name'] ?? '');?>" placeholder="Entrez votre prénom ..." required>
    <?php if (isset($this->errors['first_name'])) :?>
        <p><?= htmlspecialchars($this->errors['first_name']) ?></p>
    <?php endif;?>

    <br />

    <label for="username">Votre username</label>
    <input type="text" id="username" name="username" value="<?= htmlspecialchars($this->old['username'] ?? '');?>" placeholder="Entrez votre username ..." minlength="3" required>
    <?php if (isset($this->errors['username'])) :?>
        <p><?= htmlspecialchars($this->errors['username']) ?></p>
    <?php endif;?>

    <br />

    <label for="email">Votre email</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($this->old['email'] ?? '');?>" placeholder="Entrez votre email ..." required>
    <?php if (isset($this->errors['email'])) :?>
        <p><?= htmlspecialchars($this->errors['email']) ?></p>
    <?php endif;?>

    <br />

    <label for="password">Votre password</label>
    <input type="password" id="password" name="password" placeholder="Entrez votre password ..." minlength="8" required>
    <?php if (isset($this->errors['password'])) :?>
        <p><?= htmlspecialchars($this->errors['password']) ?></p>
    <?php endif;?>
    <br />
    <input type="submit" value="M'inscrire">
</form>

<?php
        (new Layout('Inscription', ob_get_clean()))->show();
    }
}
