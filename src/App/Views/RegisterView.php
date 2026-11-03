<?php
namespace App\Views;

class RegisterView
{
    public function __construct(private array $errors, private array $old, private string $csrfToken){}
    public  function show(): void
    {
        ob_start();?>
<section class="register-section">
    <div class="register-container">
        <div class="item1">
            <h1>Inscription</h1>
            <h2>L'aventure commence ici !</h2>
            <p>Inscrit toi pour pouvoir participer au jeu et pouvoir sauvegarder ta progression.</p>
        </div>
        <div class="item2">
            <form class="register-form" method="POST" action="index.php?action=register">
                <input type="hidden" name="csrf_token" value="<?=htmlspecialchars($this->csrfToken); ?>">
                <?php if (isset($this->errors['global'])) :?>
                    <p class="err"><?= htmlspecialchars($this->errors['global']) ?></p>
                <?php endif;?>
                <div class="form-row">
                    <div class="form-field">
                        <label for="last_name">Nom :</label>
                        <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($this->old['last_name'] ?? '');?>" placeholder="Entrez votre nom" required>
                        <?php if (isset($this->errors['last_name'])) :?>
                            <p><?= htmlspecialchars($this->errors['last_name']) ?></p>
                        <?php endif;?>
                    </div>
                    <div class="form-field">
                        <label for="first_name">Prénom :</label>
                        <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($this->old['first_name'] ?? '');?>" placeholder="Entrez votre prénom" required>
                        <?php if (isset($this->errors['first_name'])) :?>
                            <p><?= htmlspecialchars($this->errors['first_name']) ?></p>
                        <?php endif;?>
                    </div>
                </div>
                <label for="username">Pseudo :</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($this->old['username'] ?? '');?>" placeholder="Entrez votre pseudo" minlength="3" required>
                <?php if (isset($this->errors['username'])) :?>
                    <p><?= htmlspecialchars($this->errors['username']) ?></p>
                <?php endif;?>
                <label for="email">E-mail :</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($this->old['email'] ?? '');?>" placeholder="Entrez votre email" required>
                <?php if (isset($this->errors['email'])) :?>
                    <p><?= htmlspecialchars($this->errors['email']) ?></p>
                <?php endif;?>
                <label for="password">Mot de passe :</label>
                <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Entrez votre password"
                        minlength="8"
                        maxlength="72"
                        autocomplete="new-password"
                        aria-describedby="password-rules password-status"
                        required>
                <div class="password-meter" aria-hidden="true">
                    <div id="password-bar"></div>
                </div>
                <div>
                    <p id="password-status" aria-live="polite">
                        Saisissez un mot de passe.
                    </p>
                    <ul id="password-rules">
                        <li id="rule-length">Au moins <strong>8</strong> caractères</li>
                        <li id="rule-uppercase">Une majuscule de <strong>'A à Z'</strong></li>
                        <li id="rule-special">Un caractère parmi {<strong> ! @ # $ % &amp; * ? </strong>} </li>
                    </ul>
                    <?php if (isset($this->errors['password'])) : ?>
                        <p><?= htmlspecialchars($this->errors['password']) ?></p>
                    <?php endif; ?>
                </div>
                <input type="submit" value="M'inscrire" class="btn">
            </form>
        </div>
    </div>
</section>
<script src="/Assets/Scripts/password-strengh.js" defer></script>
<?php
        (new Layout('Inscription', ob_get_clean()))->show();
    }
}
