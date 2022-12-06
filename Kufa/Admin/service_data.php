<?php
require_once('./Auth/db_connect.php');
session_start();

$service_title =htmlspecialchars(trim( $_POST['service_title']));
$service_icon = htmlspecialchars(trim($_POST['service_icon']));
$service_description = htmlspecialchars(trim($_POST['service_description']));
$service_status = htmlspecialchars(trim($_POST['service_status']));

$flag = false;
if (!$service_title|| !$service_icon || !$service_description|| !$service_status ) {
    $flag = true;
    $_SESSION['add_service_error'] = "Input field is required....";
}else{
 $flag = true;
    $service_query="INSERT INTO `services` (service_title, service_icon, service_description, service_status) VALUES ( '$service_title', '$service_icon', '$service_description','$service_status')";
    mysqli_query($db_connect,$service_query);

    $_SESSION['success'] = "Services Added....";
    header('location:./Auth/service_add.php');

}

if ($flag) {
    header('location:./Auth/service_add.php');
}





?>