<?php
session_start();

$note;
$username = "";
$email = "";
$password = "";
$cpassword = "";
$errors = array();

$user_dp = mysqli_connect('localhost', 'root', 'thisIsAPassword', 'registration');

if(isset($_POST['register']))
{
    $username = filter_var(mysqli_real_escape_string($user_dp, $_POST['username']), FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var(mysqli_real_escape_string($user_dp, $_POST['email']), FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = filter_var(mysqli_real_escape_string($user_dp, $_POST['password']), FILTER_SANITIZE_SPECIAL_CHARS);
    $cpassword = filter_var(mysqli_real_escape_string($user_dp, $_POST['cpassword']), FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($username))
    {
        array_push($errors, "Username is required");
    }
    if (empty($email))
    {
        array_push($errors, "Email is required");
    }
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        array_push($errors, "Email is invalid");
    }
    if (empty($password))
    {
        array_push($errors, "Password is required");
    }
    if (empty($cpassword))
    {
        array_push($errors, "Password Confirmation is required");
    }
    if (!empty($password) && !empty($cpassword) && $password != $cpassword)
    {
        array_push($errors, "Password Confirmation doesn't match");
    }

    if(count($errors) == 0)
    {
        $password_enc = md5($password);
        $sql = "INSERT INTO users (username, email, password_enc) VALUES ('$username', '$email', '$password_enc')";
        mysqli_query($user_dp, $sql);
        $_SESSION['username'] = $username;

        $query = "SELECT * FROM users WHERE username='$username' AND password_enc='$password_enc'";
        $result = mysqli_query($user_dp, $query);
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        header('location: index.php');
    }
}

//login with dp data
if(isset($_POST['login']))
{
    $username = filter_var(mysqli_real_escape_string($user_dp, $_POST['username']), FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_var(mysqli_real_escape_string($user_dp, $_POST['password']), FILTER_SANITIZE_SPECIAL_CHARS);
    $password_enc = md5($password);

    if (empty($username))
    {
        array_push($errors, "Username is required");
    }
    if (empty($password))
    {
        array_push($errors, "Password is required");
    }

    if(count($errors) == 0)
    {
        $password_enc = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password_enc='$password_enc'";
        $result = mysqli_query($user_dp, $query);
        if(mysqli_num_rows($result) == 1)
        {
            $_SESSION['username'] = $username;
            
            $row = $result->fetch_assoc();
            $_SESSION['user_id'] = $row['id'];
            header('location: index.php');
        }
        else
        {
            array_push($errors, "wrong username or password");
            
        }

    }
}

//logout
if(isset($_GET['logout']))
{
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['user_id']);
    header('location: login.php');
}
?>