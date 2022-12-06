<?php
require_once('./db_connect.php');
$id = $_GET['id'];

$testi_delete_query = "DELETE FROM testimonial WHERE id= '$id'";
$testi_delete_query_db = mysqli_query($db_connect, $testi_delete_query);
header('location:./test_list.php');