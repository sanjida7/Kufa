<?php

require_once('./db_connect.php');

$id=htmlspecialchars(trim($_POST['id']));
$service_title = htmlspecialchars(trim($_POST['service_title']));
$service_icon = htmlspecialchars(trim($_POST['service_icon']));
$service_description = htmlspecialchars(trim($_POST['service_description']));
$service_status = htmlspecialchars(trim($_POST['service_status']));


$service_update_query = "UPDATE services SET service_title='$service_title', service_icon='$service_icon',service_description='$service_description', service_status='$service_status'WHERE id='$id'";
$service_update_db = mysqli_query($db_connect, $service_update_query );
header('location:./service_list.php');