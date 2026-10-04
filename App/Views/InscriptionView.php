<?php
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>

<form method="POST" action="../Controllers/Inscription/InscriptionController.php">
    <label for="nom">Votre nom</label>
    <input type="text" id="nom" name="nom" placeholder="Entrez votre nom ..." required>
    <br />
    <label for="prenom">Votre prénom</label>
    <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom ..." required>
    <br />
    <label for="username">Votre username</label>
    <input type="text" id="username" name="username" placeholder="Entrez votre username ..." minlength="3" required>
    <br />
    <label for="email">Votre email</label>
    <input type="email" id="email" name="email" placeholder="Entrez votre email ..." required>
    <br />
    <label for="password">Votre password</label>
    <input type="password" id="password" name="password" placeholder="Entrez votre password ..." minlength="8" required>
    <br />
    <input type="submit" value="M'inscrire" name="ok">
</form>

</body>
</html>