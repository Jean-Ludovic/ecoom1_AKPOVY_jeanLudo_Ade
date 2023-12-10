<?php
require_once("../config/connexion.php");
require_once("../fonctions/userCrud.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = $_POST["username"];
    $mot_de_passe = $_POST["pwd"];

    // Rechercher l'utilisateur dans la base de données
    $query = "SELECT * FROM user WHERE user_name ='$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Vérifier l'existence de l'utilisateur
        if ($row) {
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["user_nom"] = $row["user_name"];

            // Vérifier le rôle de l'utilisateur et rediriger en conséquence
            if ($row["role_id"] == 2) {
                header("Location: ../results/acceuil.admin.php");
            } elseif ($row["role_id"] == 1) {
                header("Location: ../results/acceuil_user.php");
            } else {
                echo "Rôle non reconnu. Veuillez contacter l'administrateur.";
            }

            // Assurez-vous de terminer le script après la redirection
            exit();
        } else {
            echo "Identifiants incorrects. Veuillez réessayer.";
        }
    } else {
        echo "Erreur lors de la connexion : " . mysqli_error($conn);
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
                    <input id="username" name="username" type="text" placeholder="user name">
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