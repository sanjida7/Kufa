<?php

require_once('./db_connect.php');
session_start();
$id = $_SESSION['auth_id'];
$work_title = htmlspecialchars(trim($_POST['work_title']));
$work_heading = htmlspecialchars(trim($_POST['work_heading']));
$work_description = htmlspecialchars(trim($_POST['work_description']));
$work_status = $_POST['work_status'];
$work_image = $_FILES['work_image'];


$flag = false;
if (isset($_POST['add_work'])) {
    // $id = $_POST['id'];

    if (!$work_title & !$work_heading & !$work_description) {
        $flag = true;
        $_SESSION['add_work_error'] = "Input field is required....";
    }


    if ($work_image['name']) {
        $flag = true;
        $image_name = $work_image['name'];
        $explode_image_name = explode('.', $work_image['name']);
        $extension = end($explode_image_name);
        if ($extension === 'png' || $extension === 'jpg') {
            if ($image['size'] <= '1000000') {
                $new_image_name = $id . "_" . time() . "." . $extension;
                $tmp_name = $work_image['tmp_name'];
                $filepath = "../uplods/profile/works/" . $new_image_name;
                move_uploaded_file($tmp_name, $filepath);
                $work_query = "INSERT INTO `works` (work_title, work_heading, work_description, work_status,work_image) VALUES ( '$work_title', '$work_heading', '$work_description','$work_status', '$new_image_name')";
                mysqli_query($db_connect, $work_query);
    
                $_SESSION['success'] = "Works Added....";
                header('location:./work_add.php');
            }else {
                header("location:./showcase_edit.php?id={$id}");
                $_SESSION['size_error'] = 'Your image size must be under 1MB';
            }
            
        } else {
            $flag = true;
            $_SESSION['img_error'] = 'Image type error...';
        }
    } else {
        $flag = true;
        $_SESSION['img_error'] = 'Image not found...';
    }
}

if ($flag) {
    header('location:./work_add.php');
}



$flag = false;
if (isset($_POST['update_work'])) {
    if ($work_image['name']) {
        $update_id = $_POST['update_id'];
        $work_query = "SELECT work_image FROM works WHERE id = '$update_id'";
        $work_query_db = mysqli_query($db_connect, $work_query);
        $old_image_name = mysqli_fetch_assoc($work_query_db)['work_image'];
        $filepath = "../uplods/profile/works/" . $old_image_name;
        unlink($filepath);
        $image_name = $work_image['name'];
        $explode_image_name = explode('.', $work_image['name']);
        $extension = end($explode_image_name);
        if ($extension === 'png' || $extension === 'jpg') {
            if ($image['size'] <= '1000000') {
            $new_image_name = $id . "_" . time() . "." . $extension;
            $tmp_name = $work_image['tmp_name'];
            $filepath = "../uplods/profile/works/" . $new_image_name;
            move_uploaded_file($tmp_name, $filepath);
            $work_update_query = "UPDATE works SET work_title='$work_title', work_heading='$work_heading',work_description='$work_description', work_status='$work_status',work_image='$new_image_name' WHERE id='$update_id'";
            $work_update_db = mysqli_query($db_connect, $work_update_query);
           header("location:./work_update.php?id={$update_id}");

            }
        }
    }
    $update_id = $_POST['update_id'];
    $work_update_query = "UPDATE works SET work_title='$work_title', work_heading='$work_heading',work_description='$work_description', work_status='$work_status' WHERE id='$update_id'";
    $work_update_db = mysqli_query($db_connect, $work_update_query);
    header("location:./work_update.php?id={$update_id}");
}

if ($flag) {
    header('location:./work_list.php');
}

