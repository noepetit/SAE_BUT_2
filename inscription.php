<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>

<form method="POST" action="traitement.php">
    <label for="nom">Votre nom</label>
    <input type="text" id="nom" name="nom" placeholder="Entrez votre nom ..." required>
    <br />
    <label for="prenom">Votre prénom</label>
    <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom ...">
    <br />
    <label for="username">Votre username</label>
    <input type="text" id="username" name="username" placeholder="Entrez votre username ...">
    <br />
    <label for="email">Votre email</label>
    <input type="text" id="email" name="email" placeholder="Entrez votre email ...">
    <br />
    <label for="password">Votre password</label>
    <input type="text" id="password" name="password" placeholder="Entrez votre password ...">
    <br />
    <input type="submit" value="M'inscrire" name="ok">
</form>

</body>
</html>