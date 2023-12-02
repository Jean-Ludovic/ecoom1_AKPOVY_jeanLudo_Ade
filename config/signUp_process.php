<?php
require_once("../Configuration/connexion.php");
require_once("usercrud.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $user_name = $_POST["user_name"];
    $billing_address = $_POST["billing_address"];
    $shipping_address = $_POST["shipping_address"];

    //  rôle par défaut
    $role_id = "utilisateur";

    // Appeler la fonction createUser avec les données du formulaire
    $result = createUser([
        'user_name' => $user_name,
        'fname' => $fname,
        'lname' => $lname,
        'billing_address' => $billing_address,
        'shipping_address' => $shipping_address,
        'role_id' => $role_id,

    ]);


    echo $result;
}
