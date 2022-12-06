<?php
require_once('./db_connect.php');
session_start();
$id=$_SESSION['auth_id'];
$facebook = htmlspecialchars(trim($_POST['facebook']));
$twitter = htmlspecialchars(trim($_POST['twitter']));
$instagram= htmlspecialchars(trim($_POST['instagram']));
$linkedin = htmlspecialchars(trim($_POST['linkedin']));


$social_link_update_query = "UPDATE admins SET facebook='$facebook', twitter='$twitter', instagram='$instagram', linkedin='$linkedin' WHERE id='$id'";
$social_link_update_db = mysqli_query($db_connect, $social_link_update_query);

header('location:./social_link.php');
$_SESSION['success']='Your social links update successfully....';
