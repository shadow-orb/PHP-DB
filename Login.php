<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div>
    <h2>Login</h2>
    </div>

    <form method="post" action="Login.php">
    <?php include('errors.php'); ?>
        <div>
            <label>Username</label>
            <br>
            <input type="text" name="username" value="<?php echo $username; ?>">
        </div>
        <div>
            <label>Password</label>
            <br>
            <input type="text" name="password">
        </div>
        <br>
        <div>
            <input type="submit" value="Login" name="login">
        </div>
        <p>
            Are you new? <a href="Register.php">Sign up</a>
        </p>
    </form>
</body>
</html>