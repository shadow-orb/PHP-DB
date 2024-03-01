<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div>
    <h2>Register</h2>
    </div>

    <form method="post" action="Register.php">
        <?php include('errors.php'); ?>
        <div>
            <label>Username</label>
            <br>
            <input type="text" name="username" value="<?php echo $username; ?>">
        </div>
        <div>
            <label>Email</label>
            <br>
            <input type="text" name="email" value="<?php echo $email; ?>">
        </div>
        <div>
            <label>Password</label>
            <br>
            <input type="text" name="password">
        </div>
        <div>
            <label>Confirm Paswword</label>
            <br>
            <input type="text" name="cpassword">
        </div>
        <br>
        <div>
            <input type="submit" value="Register" name="register">
        </div>
        <p>
            Have an Account? <a href="Login.php">Sign in</a>
        </p>
    </form>
</body>
</html>