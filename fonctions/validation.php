<?php

function usernameIsValid(string $user_name): array
{
    $length = strlen($user_name);
    $result = [
        'isValid' => true,
        'msg' => ''
    ];

    $userInDB = getUserByUsername($user_name);

    if ($length < 2) {
        $result = [
            'isValid' => false,
            'msg' => 'Le username utilisé est trop court'
        ];
    } elseif ($length > 20) {
        $result = [
            'isValid' => false,
            'msg' => 'Le username utilisé est trop long'
        ];
    } elseif ($length == 0) {
        $result = [
            'isValid' => false,
            'msg' => 'Veuillez saisir un Username'
        ];
    } elseif ($userInDB) {
        $result = [
            'isValid' => false,
            'msg' => 'Le username est déjà utilisé'
        ];
    }
    return $result;
}

function fnameIsValid($fname)
{
    $length = strlen($fname);
    $responses = [
        'isValid' => true,
        'msg' => ''
    ];

    if ($length >= 51) {
        $responses = [
            'isValid' => false,
            'msg' => 'Prenom trop long'
        ];
    } elseif ($length <= 2) {
        $responses = [
            'isValid' => false,
            'msg' => 'Prenom trop court'
        ];
    } elseif ($length == 0) {
        $responses = [
            'isValid' => false,
            'msg' => 'Case Prenom est non rempli'
        ];
    }
    return $responses;
}

function lnameIsValid($lname)
{
    $length = strlen($lname);
    $responses = [
        'isValid' => true,
        'msg' => ''
    ];

    if ($length >= 51) {
        $responses = [
            'isValid' => false,
            'msg' => 'Nom trop long'
        ];
    } elseif ($length <= 2) {
        $responses = [
            'isValid' => false,
            'msg' => 'Nom trop court'
        ];
    } elseif ($length == 0) {
        $responses = [
            'isValid' => false,
            'msg' => 'Case Nom est non rempli'
        ];
    }
    return $responses;
}

function emailIsValid($email)
{
    $email_validation_regex = "/^[a-z0-9!#$%&'*+\\/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&'*+\\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/";
    if (!preg_match($email_validation_regex, $email)) {
        return [
            'isValid' => false,
            'msg' => "Format d'email invalid",
        ];
    }
    return [
        'isValid' => true,
        'msg' => '',
    ];
}

function pwdLenghtValidation($pwd)
{
    //minimum 6 max 16
    $length = strlen($pwd);

    if ($length < 6) {
        return [
            'isValid' => false,
            'msg' => 'Votre mot de passe est trop court. Doit être supérieur a 8 caractères'
        ];
    } elseif ($length > 16) {
        return [
            'isValid' => false,
            'msg' => 'Votre mot de passe est trop long. Doit être inférieur a 16 caractères'
        ];
    }

    return [
        'isValid' => true,
        'msg' => ''
    ];
}

function getUserByUsername(string $username)
{
    global $conn;

    $query = "SELECT * FROM user WHERE user_name = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        return $user;
    }

    return null;
}
