<?php
require_once("../Configuration/connexion.php");

function createUser(array $data)
{
    global $conn;

    // Validation des données supplémentaires 
    $usernameValidation = usernameIsValid($data['user_name']);
    $fnameValidation = fnameIsValid($data['fname']);
    $lnameValidation = lnameIsValid($data['lname']);
    $emailValidation = emailIsValid($data['email']);
    $pwdValidation = pwdLenghtValidation($data['pwd']);

    // Vérification de toutes les validations
    if (!$usernameValidation['isValid'] || !$fnameValidation['isValid'] || !$lnameValidation['isValid'] || !$emailValidation['isValid'] || !$pwdValidation['isValid']) {
        // Une ou plusieurs validations ont échoué, renvoyer un message d'erreur 
        $errorMessage = "Erreur de validation. Veuillez corriger les erreurs.";
        return $errorMessage;
    }

    // Toutes les validations sont réussies, procéder à l'insertion dans la base de données
    $query = "INSERT INTO user VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param(
            $stmt,
            "ssssssssi",
            $data['user_name'],
            $data['email'],
            $data['pwd'],
            $data['fname'],
            $data['lname'],
            $data['billing_address_id'],
            $data['shipping_address_id'],
            $data['token'],
            $data['role_id']
        );

        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // L'insertion a réussi
            $successMessage = "Utilisateur enregistré avec succès !";
            return $successMessage;
        } else {
            // L'insertion a échoué, renvoyer un message d'erreur
            $errorMessage = "Erreur lors de l'enregistrement de l'utilisateur.";
            return $errorMessage;
        }
    } else {
        // Erreur de préparation de la requête, renvoyer un message d'erreur
        $errorMessage = "Erreur de préparation de la requête.";
        return $errorMessage;
    }
}
