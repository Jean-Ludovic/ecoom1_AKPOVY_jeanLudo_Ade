<?php
require_once("../Configuration/connexion.php");

function createUser(array $data) {
    global $conn;
    
    $query = "INSERT INTO user VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt =mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param(
            $stmt,
            "sss",
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
    }
}

function getUserByUsername(string $user_name) {
    global $conn;

    $query = "SELECT * FROM user WHERE user.user_name = '" . $user_name . "';";
    $result= mysqli_query($conn, $query);

    $data= mysqli_fetch_assoc(($result));
    return $data;
    
}
?>