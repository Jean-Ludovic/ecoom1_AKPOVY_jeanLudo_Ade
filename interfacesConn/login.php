<?php
require_once("../config/connexion.php");
require_once("../fonctions/userCrud.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $user_name = isset($_POST["user_name"]) ? $_POST["user_name"] : '';
    $pwd = isset($_POST["pwd"]) ? $_POST["pwd"] : '';

    // Appeler la fonction loginUser avec les données du formulaire
    $loginResult = loginUser($user_name, $pwd);

    // Vérifier le résultat de la connexion
    if ($loginResult['success']) {
        // Démarrer la session si ce n'est pas déjà fait
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Stocker les informations de l'utilisateur dans la session si nécessaire
        $_SESSION['user_id'] = $loginResult['user_id'];
        $_SESSION['role_id'] = $loginResult['role_id'];

        // Rediriger l'utilisateur vers la page appropriée
        header("Location: acceuil_user.php");
        exit();
    } else {
        // Afficher un message d'erreur
        echo "Login failed: " . $loginResult['error'];
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./formstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>login</title>
</head>

<body>
    <a href="../index.php">Retour</a>

    <div class="wrapper">
        <form method="post" action="">
            <fieldset>
                <legend>
                    <h2>Login</h2>
                </legend>
                <p>Please enter your login details</p>

                <div class="input-box">
                    <input id="username" name="username" type="text" placeholder="usernme">
                    <i class='bx bxs-user-circle'></i>
                </div>
                <div class="input-box">
                    <input id="pwd" name="pwd" type="password" placeholder="Password">
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" class="btn">Login</button>

                <div class="register-link">
                    <h3>
                        <p>Don't have an account?
                            <a href="./signup.php">Register</a>
                        </p>
                    </h3>
                </div>

</body>

</html>

</html>