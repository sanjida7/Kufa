<?php
session_start();
require_once('./db_connect.php');
$name = htmlspecialchars($_POST['user_name']);
$email = htmlspecialchars($_POST['user_email']);
$password = htmlspecialchars($_POST['user_password']);
$confrim_password = htmlspecialchars($_POST['user_confrim_password']);
//SELECT query..,
$email_check_query = "SELECT COUNT(*) AS 'result' FROM admins WHERE email = '$email'";
$email_check_db= mysqli_query($db_connect,$email_check_query);
$email_check_result = mysqli_fetch_assoc($email_check_db);

//name check...
$flag = false;
if ($name) {
    $remove_name_space = str_replace(" ", "", $name);
    if (ctype_alpha($remove_name_space)) {
        $_SESSION["old_name"]= $name;
    } else{
        $flag = true;
        $_SESSION['name_error'] = 'Please remove name num...';
    }
}else {
    $flag = true;
    $_SESSION['name_error'] = 'Please enter your name...';
}
//email check..
if ($email) {
    if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
        if ($email_check_result['result'] == 1) {
            $flag = true;
            (!$_SESSION['email_error'] = 'email ace...');
        }
        $_SESSION["old_email"]= $email;
    }else{
        $flag = true;
        (!$_SESSION['email_error'] = 'Your email not valid...');
    }
} else {
    $flag = true;
    ($_SESSION['email_error'] = 'Please enter your email...');
}
//password check..
if ($password) {
   if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)){
    
    ($_SESSION['password_error'] = 'Your password incorect..');
   }
} else {
    $flag = true;
    ($_SESSION['password_error'] = 'Please enter your password...');
}
//confrim_password check...
if ($confrim_password) {
    if(!($password === $confrim_password)) {
        $flag = true;
        ($_SESSION['confrim_password_error'] = 'Your confrim password incorect...');
    }
 } else {
     $flag = true;
     ($_SESSION['confrim_password_error'] = 'Please enter your confrim password...');
 }
if ($flag) {
    header('location:./signup.php');
}
    //INSERT query..
else {
    //  $salt = rand(100,999);
    $password_encode = sha1($password);
    $admin_query="INSERT INTO `admins` (name, email, password) VALUES ( '$name', '$email', '$password_encode')";
    mysqli_query($db_connect,$admin_query);
    $_SESSION['signin_status'] = "Hello $name";
    header('location:./signin.php');
}
