<?php

require_once('./db_connect.php');
session_start();
$id = $_SESSION['auth_id'];
$image = $_FILES['testi_image'];
$comment = htmlspecialchars(trim($_POST['testi_comment']));
$name = htmlspecialchars(trim($_POST['testi_name']));
$title = htmlspecialchars(trim($_POST['testi_title']));
$status = $_POST['testi_status'];



$flag = false;
if (isset($_POST['test_work'])) {
    // $id = $_POST['id'];

    if (!$comment & !$name & !$title) {
        $flag = true;
        $_SESSION['add_testi_error'] = "Input field is required....";
    }


    if ($image['name']) {
        $flag = true;
        $image_name = $image['name'];
        $explode_image_name = explode('.', $image['name']);
        $extension = end($explode_image_name);
        if ($extension === 'png' || $extension === 'jpg') {
            if ($image['size'] <= '1000000') {
                $new_image_name = $id . "_" . time() . "." . $extension;
                $tmp_name = $image['tmp_name'];
                $filepath = "../uplods/profile/works/" . $new_image_name;
                move_uploaded_file($tmp_name, $filepath);
                $testi_query = "INSERT INTO `testimonials` (image, comment, name, title,status) VALUES ( '$new_image_name', '$comment', '$name','$title', '$status')";
                mysqli_query($db_connect, $testi_query);
    
                $_SESSION['success'] = "Works Added....";
                header('location:./test_add.php');
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
    header('location:./test_add.php');
}



$flag = false;
if (isset($_POST['update_work'])) {
    if ($image['name']) {
        $update_id = $_POST['update_id'];
        $work_query = "SELECT work_image FROM works WHERE id = '$update_id'";
        $work_query_db = mysqli_query($db_connect, $work_query);
        $old_image_name = mysqli_fetch_assoc($work_query_db)['work_image'];
        $filepath = "../uplods/profile/works/" . $old_image_name;
        unlink($filepath);
        $image_name = $image['name'];
        $explode_image_name = explode('.', $image['name']);
        $extension = end($explode_image_name);
        if ($extension === 'png' || $extension === 'jpg') {
            if ($image['size'] <= '1000000') {
            $new_image_name = $id . "_" . time() . "." . $extension;
            $tmp_name = $image['tmp_name'];
            $filepath = "../uplods/profile/works/" . $new_image_name;
            move_uploaded_file($tmp_name, $filepath);
            $testi_update_query = "UPDATE testimonials SET image='$new_image_name', comment='$comment',name='$name', title='$title',status='$status' WHERE id='$update_id'";
            $testi_update_db = mysqli_query($db_connect, $testi_update_query);
           header("location:./test_update.php?id={$update_id}");

            }
        }
    }
    $update_id = $_POST['update_id'];
    $testi_update_query = "UPDATE testimonials SET image='$new_image_name', comment='$comment',name='$name', title='$title',status='$status' WHERE id='$update_id'";
            $testi_update_db = mysqli_query($db_connect, $testi_update_query);
           header("location:./test_update.php?id={$update_id}");
}

if ($flag) {
    header('location:./test_list.php');
}

