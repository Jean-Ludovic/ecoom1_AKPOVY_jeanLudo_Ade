<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./formstyle.css">
    <title>Document</title>
</head>

<body>
    <h2>Sign Up</h2>

    <form method="post" action="">
        <input hidden name="action" value="signup">

        <label for="lname">Last Name</label>
        <input id="lname" name="lname" type="text">


        <label for="fname">First Name</label>
        <input id="fname" name="fname" type="text">

        <label for="user_name">User Name</label>
        <input id="user_name" name="user_name" type="text">

        <label for="email">Email</label>
        <input id="email" name="email" type="email">

        <label for="pwd">Password</label>
        <input id="pwd" name="pwd" type="password">

        <button type="submit">Sign Up</button>
    </form>

</body>

</html>