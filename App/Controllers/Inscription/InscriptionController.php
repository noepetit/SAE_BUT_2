<?php
session_start();

$config = require('config.php');


try {
    $bdd = new PDO(
        "mysql:host=" . $config['host'] . ";dbname=" . $config['dbname'] . ";charset=utf8mb4",
        $config['user'],
        $config['password']
    );
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if (isset($_POST['ok'])) {
    if (empty($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'])) {
        die("Requête invalide.");
    }

    $nom       = trim($_POST['nom'] ?? '');
    $prenom    = trim($_POST['prenom'] ?? '');
    $user_name = trim($_POST['user'] ?? '');
    $email     = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $pwd_brut  = $_POST['password'] ?? '';

    if ($nom = '' || $prenom = '' || strlen($user_name) < 3 || $email == false || strlen($pwd_brut) < 8) {
        echo "Veuillez remplir le formulaire.";
        exit();
    }

    $verif = $bdd->prepare("SELECT COUNT(*) FROM users WHERE email = :email OR username = :username");
    $verif->execute([':email' => $email, ':username' => $user_name]);

    if ($verif->fetchColumn() > 0) {
        echo "Cet email ou username est déjà pris.";
        exit();
    }

    $hashed_password = password_hash($pwd_brut, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(email, username, first_name, last_name, password) 
            VALUES(:email, :username, :firstname, :lastname, :password)";

                $requete = $bdd->prepare($sql);

    $succes = $requete->execute([
        ':email'      => $email,
        ':username'   => $user_name,
        ':first_name' => $prenom,
        ':last_name'  => $nom,
        ':pwd'        => $hashed_password
    ]);

    if ($succes) {
        unset($_SESSION['csrf_token']);
        echo "<p style='color: green;'>Compte créé avec succès !</p>";
    } else {
        echo "<p style='color: red;'>Erreur lors de l'enregistrement.</p>";
    }
} else {
    echo "<p style='color: red;'>Veuillez remplir tous les champs correctement (vérifiez notamment l'email).</p>";
}

?>