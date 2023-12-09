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

                <?php echo displayError('lname'); ?>
                <label for="lname">Last Name</label>
                <div class="input-box">
                    <input id="lname" name="lname" type="text" value="<?php echo isset($_POST['lname']) ? htmlspecialchars($_POST['lname']) : ''; ?>">
                    <i class='bx bxs-user'></i>


                </div>

                <?php echo displayError('fname'); ?>
                <label for="fname">First Name</label>
                <div class="input-box">
                    <input id="fname" name="fname" type="text" value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : ''; ?>">

                </div>

                <?php echo displayError('use_name'); ?>
                <label for="user_name">User Name</label>
                <div class="input-box">
                    <input id="user_name" name="user_name" type="text" value="<?php echo isset($_POST['user_name']) ? $_POST['user_name'] : ''; ?>">

                </div>

                <?php echo displayError('email'); ?>
                <label for="email">Email</label>
                <div class="input-box">
                    <input id="email" name="email" type="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                    <i class='bx bxs-envelope'></i>
                </div>

                <?php echo displayError('pwd'); ?>
                <label for="pwd">Password</label>
                <div class="input-box">
                    <input id="pwd" name="pwd" type="password" value="<?php echo isset($_POST['pwd']) ? $_POST['pwd'] : ''; ?>">

                </div>

                <label for="billing_address">Billing Address</label>
                <div class="input-box">
                    <input id="billing_address" name="billing_address" type="text" value="<?php echo isset($_POST['billing_address']) ? $_POST['billing_address'] : ''; ?>">
                </div>
                <label for="shipping_address">Shipping Address</label>
                <div class="input-box">
                    <input id="shipping_address" name="shipping_address" type="text" value="<?php echo isset($_POST['shipping_address']) ? $_POST['shipping_address'] : ''; ?>">
                </div>





                <button type=" submit">Sign Up</button>

            </fieldset>
        </form>
    </div>
</body>

</html>