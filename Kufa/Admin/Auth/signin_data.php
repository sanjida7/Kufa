<?php
session_start();
require_once('./db_connect.php');
$email = htmlspecialchars($_POST['user_email']);
$password = sha1(htmlspecialchars($_POST['user_password']));
//email check..
$email_password_check_query = "SELECT COUNT(*) AS 'result' FROM admins WHERE email = '$email' AND password = '$password'";
$email_password_check_db = mysqli_query($db_connect,$email_password_check_query);
$email_password_check_result = mysqli_fetch_assoc($email_password_check_db);

$name_query = "SELECT id,name FROM admins WHERE email = '$email'";
$name_query_db = mysqli_query($db_connect,$name_query );
$name_query_result = mysqli_fetch_assoc($name_query_db);
$name = $name_query_result['name'] ;
$id = $name_query_result['id'] ; 

$flag = false;
if ($email) {
    if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
       
        $_SESSION["resitration_email"]= $email;
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
    // if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)){
     
     (!$_SESSION['password_error'] = 'Your password incorect..');
    } else {
     $flag = true;
     ($_SESSION['password_error'] = 'Please enter your password...');
 }
if ($email_password_check_result['result']) {
    $_SESSION['auth_email'] = $email;
    $_SESSION['auth_name'] = $name;
    $_SESSION['auth_id'] = $id;
    header('location:./index.php');
}else {
    $flag = true;
    $_SESSION['login_error'] = 'email || password mile nai..';
}

if ($flag) {
    header('location:./signin.php');
}


?>