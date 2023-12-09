<?php
require_once("../fonctions/userCrud.php");
require_once("../config/connexion.php");
require_once("../interfacesConn/signup.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $fname = isset($_POST["fname"]) ? $_POST["fname"] : '';
    $lname = isset($_POST["lname"]) ? $_POST["lname"] : '';
    $email = isset($_POST["email"]) ? $_POST["email"] : '';

    $user_name = isset($_POST["user_name"]) ? $_POST["user_name"] : '';
    $password = isset($_POST["pwd"]) ? $_POST["pwd"] : '';
    $billing_address = isset($_POST["billing_address"]) ? $_POST["billing_address"] : '';
    $shipping_address = isset($_POST["shipping_address"]) ? $_POST["shipping_address"] : '';
    $token = bin2hex(random_bytes(32));

    //  rôle par défaut
    $role_id = "utilisateur";
    $errors = [];

    $lnameValidation = lnameIsValid($lname);
    if (!$lnameValidation['isValid']) {
        $errors['lname'] = $lnameValidation['msg'];
    }

    $fnameValidation = fnameIsValid($fname);
    if (!$fnameValidation['isValid']) {
        $errors['fname'] = $fnameValidation['msg'];
    }

    $emailValidation = emailIsValid($email);
    if (!$emailValidation['isValid']) {
        $errors['email'] = $emailValidation['msg'];
    }
    $pwdValidation = pwdLenghtValidation($pwd);
    if (!$pwdValidation['isValid']) {
        $errors['pwd'] = $pwdValidation['msg'];
    }




    // Appeler la fonction createUser avec les données du formulaire
    $result = createUser([
        'user_name' => $user_name,
        'email' => isset($_POST["email"]) ? $_POST["email"] : '',
        'pwd' => isset($_POST["pwd"]) ? $_POST["pwd"] : '',
        'fname' => $fname,
        'lname' => $lname,
        'billing_address' => $billing_address,
        'shipping_address' => $shipping_address,
        'token' => $token,
        'role_id' => '1',
    ]);


    echo $result;
    // Si la création de l'utilisateur a échoué, collectez les erreurs
    if (is_string($result)) {
        $errors = extractErrors($result);
    }
}
function extractErrors($errorString)
{
    $errors = [];
    $errorLines = explode("<br>", $errorString);
    foreach ($errorLines as $line) {
        $matches = [];
        preg_match('/<br>(.*?)<\/p>/', $line, $matches);
        if (isset($matches[1])) {
            $errors[] = $matches[1];
        }
    }
    return $errors;
}
function displayError($fieldName)
{
    global $errors;
    return isset($errors[$fieldName]) ? "<p class='error-message'>{$errors[$fieldName]}</p>" : '';
}
