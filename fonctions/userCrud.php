<?php
require_once("../fonctions/validation.php");

function createUser(array $data)
{
    global $conn;

    // Additional data validation
    $usernameValidation = usernameIsValid($data['user_name']);
    $fnameValidation = fnameIsValid($data['fname']);
    $lnameValidation = lnameIsValid($data['lname']);
    $emailValidation = emailIsValid($data['email']);
    $pwdValidation = pwdLenghtValidation($data['pwd']);

    // Check all validations
    if (!$usernameValidation['isValid'] || !$fnameValidation['isValid'] || !$lnameValidation['isValid'] || !$emailValidation['isValid'] || !$pwdValidation['isValid']) {
        // One or more validations failed, return an error message
        $errorMessage = "<br><br>Error in validation. Please correct the errors.";
        return $errorMessage;
    }

    // All validations succeeded, proceed with the insertion into the database
    $query = "INSERT INTO user VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    if ($stmt = mysqli_prepare($conn, $query)) {
        $user_name = $data['user_name'];
        $email = $data['email'];
        $pwd = $data['pwd'];
        $fname = $data['fname'];
        $lname = $data['lname'];
        $billing_address = $data['billing_address'];
        $shipping_address = $data['shipping_address'];
        $token = $data['token'];
        $role_id = $data['role_id'];

        mysqli_stmt_bind_param(
            $stmt,
            "sssssssss",
            $user_name,
            $email,
            $pwd,
            $fname,
            $lname,
            $billing_address,
            $shipping_address,
            $token,
            $role_id
        );

        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Insertion successful
            $successMessage = "<br><br><h1>User successfully registered!</h1>"
                . "<h2><p>You can login now. <a href='../interfacesConn/login.php' style='color: #3498db; text-decoration: none;'>Click here to Login</a>.</p></h2>";


            return $successMessage;
        } else {
            // Insertion failed, return an error message
            $errorMessage = "Error during user registration.";
            return $errorMessage;
        }
    } else {
        // Error preparing the query, return an error message
        $errorMessage = "Error preparing the query.";
        return $errorMessage;
    }
}
