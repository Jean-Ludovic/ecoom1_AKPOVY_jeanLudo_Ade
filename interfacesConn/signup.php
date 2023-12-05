<?php
require_once("../config/connexion.php");
require_once("../config/signUp_process.php");
require_once("../fonctions/userCrud.php");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./formstyle.css">
    <title>Sign Up</title>
</head>

<body>
    <div class="wrapper">
        <form method="post" action="">
            <fieldset>
                <legend>
                    <h2>Sign Up</h2>
                </legend>

                <label for="lname">Last Name</label>
                <div class="input-box">
                    <input id="lname" name="lname" type="text">
                    <i class='bx bxs-user'></i>
                    <?php if (isset($errors['lname'])) echo "<span class='error'>{$errors['lname']}</span>"; ?>
                </div>

                <label for="fname">First Name</label>
                <div class="input-box">
                    <input id="fname" name="fname" type="text">
                    <i class='bx bxs-user'></i>
                    <?php if (isset($errors['fname'])) echo "<span class='error'>{$errors['fname']}</span>"; ?>
                </div>

                <label for="user_name">User Name</label>
                <div class="input-box">
                    <input id="user_name" name="user_name" type="text">
                    <i class='bx bxs-user'></i>
                    <?php if (isset($errors['user_name'])) echo "<span class='error'>{$errors['user_name']}</span>"; ?>
                </div>

                <label for="email">Email</label>
                <div class="input-box">
                    <input id="email" name="email" type="email">
                    <i class='bx bxs-envelope'></i>
                    <?php if (isset($errors['email'])) echo "<span class='error'>{$errors['email']}</span>"; ?>
                </div>

                <label for="pwd">Password</label>
                <div class="input-box">
                    <input id="pwd" name="pwd" type="password">
                    <i class='bx bxs-lock'></i>
                    <?php if (isset($errors['pwd'])) echo "<span class='error'>{$errors['pwd']}</span>"; ?>
                </div>

                <label for="billing_address">Billing Address</label>
                <div class="input-box">
                    <input id="billing_address" name="billing_address" type="text">
                    <?php if (isset($errors['billing_address'])) echo "<span class='error'>{$errors['billing_address']}</span>"; ?>
                </div>
                <label for="shipping_address">Shipping Address</label>
                <div class="input-box">
                    <input id="shipping_address" name="shipping_address" type="text">
                    <?php if (isset($errors['shipping_address'])) echo "<span class='error'>{$errors['shipping_address']}</span>"; ?>
                </div>





                <button type="submit">Sign Up</button>

            </fieldset>
        </form>
    </div>
</body>

</html>