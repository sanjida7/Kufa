<?php
require_once('./db_connect.php');
session_start();

$facts_icon =htmlspecialchars(trim( $_POST['facts_icon']));
$facts_count = htmlspecialchars(trim($_POST['facts_count']));
$facts_title = htmlspecialchars(trim($_POST['facts_title']));
$facts_status = htmlspecialchars(trim($_POST['facts_status']));

$flag = false;
if (!$facts_icon|| !$facts_count || !$facts_title|| !$facts_status ) {
    $flag = true;
    $_SESSION['add_facts_error'] = "Input field is required....";
}else{
 $flag = true;
    $facts_query="INSERT INTO `facts` (facts_icon, facts_count, facts_title, facts_status) VALUES ('$facts_icon', '$facts_count', '$facts_title', '$facts_status')";
    $facts_query_db= mysqli_query($db_connect,$facts_query);

    $_SESSION['success'] = "Facts Added....";
    header('location:./facts_add.php');

}

if ($flag) {
    header('location:./facts_add.php');
}





?>