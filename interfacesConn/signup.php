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
                </div>

                <label for="fname">First Name</label>
                <div class="input-box">
                    <input id="fname" name="fname" type="text">
                    <i class='bx bxs-user'></i>
                </div>

                <label for="user_name">User Name</label>
                <div class="input-box">
                    <input id="user_name" name="user_name" type="text">
                    <i class='bx bxs-user'></i>
                </div>

                <label for="email">Email</label>
                <div class="input-box">
                    <input id="email" name="email" type="email">
                    <i class='bx bxs-envelope'></i>
                </div>

                <label for="pwd">Password</label>
                <div class="input-box">
                    <input id="pwd" name="pwd" type="password">
                    <i class='bx bxs-lock'></i>
                </div>

                <label for="billing_address">Billing Address</label>
                <div class="input-box">
                    <input id="billing_address" name="billing_address" type="text">
                </div>
                <label for="shipping_address">Shipping Address</label>
                <div class="input-box">
                    <input id="shipping_address" name="shipping_address" type="text">
                </div>





                <button type="submit">Sign Up</button>

            </fieldset>
        </form>
    </div>
</body>

</html>