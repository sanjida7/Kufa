<?php
require_once('./Auth/db_connect.php');
$id = $_GET['id'];

$service_delete_query = "DELETE FROM services WHERE id= '$id'";
$service_delete_query_db = mysqli_query($db_connect, $service_delete_query);
header('location:./Auth/service_list.php');