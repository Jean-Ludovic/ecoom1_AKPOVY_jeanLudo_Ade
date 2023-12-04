<?php
require_once("../fonctions/userCrud.php");
require_once("../config/connexion.php");
require_once("../interfacesConn/signup.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $fname = isset($_POST["fname"]) ? $_POST["fname"] : '';
    $lname = isset($_POST["lname"]) ? $_POST["lname"] : '';
    $user_name = isset($_POST["user_name"]) ? $_POST["user_name"] : '';
    $billing_address = isset($_POST["billing_address"]) ? $_POST["billing_address"] : '';
    $shipping_address = isset($_POST["shipping_address"]) ? $_POST["shipping_address"] : '';
    $token = bin2hex(random_bytes(32));

    //  rôle par défaut
    $role_id = "utilisateur";

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
}
