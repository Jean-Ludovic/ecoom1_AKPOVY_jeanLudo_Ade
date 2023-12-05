<?php
require_once("../fonctions/userCrud.php");
require_once("../config/connexion.php");
require_once("../interfacesConn/login.php");
//demasquer les erreurs
error_reporting(E_ALL);
ini_set('display_errors', '1');



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $user_name = $_POST["username"];
    $pwd = $_POST["pwd"];

    // Appeler la fonction de connexion avec les données du formulaire
    $result = loginUser($user_name, $pwd);

    // Vérifier si la connexion a réussi
    if ($result['success']) {
        // Mappings role_id => page de redirection
        $redirectPages = [
            1 => "../results/acceuil_user.php",
            2 => "../results/accueil_admin.php",
            // Ajoutez d'autres mappings au besoin(super admin)
        ];

        // Rediriger en fonction du role_id, ou utiliser une redirection par défaut
        $role_id = $result['role_id'];
        $redirectPage = isset($redirectPages[$role_id]) ? $redirectPages[$role_id] : "index.php";

        header("Location: $redirectPage");
        exit();
    } else {
        // La connexion a échoué, vous pouvez gérer les erreurs ici
        $errorMessage = "Login failed. Please check your credentials.";
        echo $errorMessage;
    }
}
