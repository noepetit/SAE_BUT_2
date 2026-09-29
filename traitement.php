<?php
$servername = "mysql-cybercigales.alwaysdata.net";
$dbname = "cybercigales_login";
$username = "cybercigales";
$password = "root";


try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if (isset($_POST['ok'])) {
    $nom       = htmlspecialchars(trim($_POST['nom']));
    $prenom    = htmlspecialchars(trim($_POST['prenom']));
    $user_name = htmlspecialchars(trim($_POST['username']));
    $email     = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $pwd_brut  = $_POST['password'];

    $requete = $bdd->prepare($sql);

    $succes = $requete->execute([
        ':email'      => $email,
        ':username'   => $user_name,
        ':first_name' => $prenom,
        ':last_name'  => $nom,
        ':pwd'        => $hashed_password
    ]);

    if ($succes) {
        echo "<p style='color: green;'>Compte créé avec succès !</p>";
    } else {
        echo "<p style='color: red;'>Erreur lors de l'enregistrement.</p>";
    }
} else {
    echo "<p style='color: red;'>Veuillez remplir tous les champs correctement (vérifiez notamment l'email).</p>";
}

?>