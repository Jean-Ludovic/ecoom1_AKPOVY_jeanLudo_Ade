<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./formstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>login</title>
</head>

<body>
    <a href="../index.php">Retour</a>

    <div class="wrapper">
        <form method="post" action="../config/login_process.php">
            <fieldset>
                <legend>
                    <h2>Login</h2>
                </legend>
                <p>Please enter your login details</p>

                <div class="input-box">
                    <input id="username" name="username" type="text" placeholder="Username">
                    <i class='bx bxs-user-circle'></i>
                </div>
                <div class="input-box">
                    <input id="pwd" name="pwd" type="password" placeholder="Password">
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" class="btn">Login</button>

                <div class="register-link">
                    <h3>
                        <p>Don't have an account?
                            <a href="./signup.php">Register</a>
                        </p>
                    </h3>
                </div>

</body>

</html>

</html>