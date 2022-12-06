<?php

require_once('./db_connect.php');

$id=htmlspecialchars(trim($_POST['id']));
$facts_icon = htmlspecialchars(trim($_POST['facts_icon']));
$facts_count = htmlspecialchars(trim($_POST['facts_count']));
$facts_title = htmlspecialchars(trim($_POST['facts_title']));
$facts_status = htmlspecialchars(trim($_POST['facts_status']));


$facts_update_query = "UPDATE facts SET facts_icon='$facts_icon', facts_count='$facts_count',facts_title='$facts_title', facts_status='$facts_status'WHERE id='$id'";
$facts_update_db = mysqli_query($db_connect, $facts_update_query );
header('location:./facts_list.php');