<?php
require_once('./db_connect.php');
session_start();
$name = htmlspecialchars($_POST['name']);
$id = htmlspecialchars($_SESSION['auth_id']);
$phn_number = htmlspecialchars($_POST['phone_number']);
$address = htmlspecialchars($_POST['address']);

$flag = false;
if (isset($_POST['update'])) {
    if ($name) {
        $remove_name_space = str_replace(" ", "", $name);
        if (ctype_alpha($remove_name_space)) {
            $name_update_query = "UPDATE admins SET name='$name'WHERE id='$id'";
            $name_update_db = mysqli_query($db_connect, $name_update_query);
            $_SESSION['auth_name'] = $name;
            header('location:./profile.php');
            $_SESSION['update'] = "Your profile Succesfully Updated";
        } else {
            $flag = true;
            $_SESSION['name_error'] = 'Please remove name num...';
        }
    } else {
        $flag = true;
        $_SESSION['name_error'] = 'Please enter your name...';
    }
    //Image upload query...
    if ($_FILES['profile_pic']['name'] != '') {
        $image_name = $_FILES['profile_pic']['name'];
        $explode_image_name = explode('.', $image_name);
        $extension = end($explode_image_name);
        $new_image_name = $id . '.' . $extension;
        $tmp_path = $_FILES['profile_pic']['tmp_name'];
        $filepath = '../uplods/profile/' . $new_image_name;
        move_uploaded_file($tmp_path, $filepath);
        $profile_pic_update_query = "UPDATE admins SET profile_pic='$new_image_name'WHERE id='$id'";
        $profile_pic_update_db = mysqli_query($db_connect, $profile_pic_update_query);
        header('location:./profile.php');
    } else {
        echo 'nai';
    }
}
//phone number update query...
if (isset($_POST['update'])) {
    if ($phn_number) {
        $phn_num_update_query = "UPDATE admins SET phone_number='$phn_number'WHERE id='$id'";
        $phn_num_update_db = mysqli_query($db_connect, $phn_num_update_query);
        header('location:./profile.php');

        $_SESSION['update'] = "Your profile Succesfully Updated";
    }
} else {
    $flag = true;
    $_SESSION['phn_num_error'] = 'Please enter your phone number...';
}

// Address update query.....
if (isset($_POST['update'])) {
    if ($address) {
        $address_update_query = "UPDATE admins SET address='$address'WHERE id='$id'";
        $address_update_db = mysqli_query($db_connect, $address_update_query);
        header('location:./profile.php');

        $_SESSION['update'] = "Your profile Succesfully Updated";
    }
} else {
    $flag = true;
    $_SESSION['address_error'] = 'Please enter your Address...';
}

//password update query...
if (isset($_POST['forget_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confrim_password = $_POST['confrim_password'];
    if ($current_password) {
        $current_password_check = "SELECT password FROM admins WHERE id='$id'";
        $current_password_check_query_db = mysqli_query($db_connect, $current_password_check);
        $current_password_from_db = mysqli_fetch_assoc($current_password_check_query_db);
        if (sha1($current_password) === $current_password_from_db['password']) {
            if ($new_password) {
                if (preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $new_password)) {
                    if ($current_password === $new_password) {
                        $flag = true;
                        $_SESSION['new_password_error'] = "Current password and New password same";
                    } else {
                        if ($confrim_password) {
                            if ($new_password === $confrim_password) {
                                $encode_password = sha1($new_password);
                                $password_update_query = "UPDATE admins SET password='$encode_password'WHERE id='$id'";
                                $password_update_db = mysqli_query($db_connect, $password_update_query);
                                $flag = true;
                                // header('location:./profile.php');
                                $_SESSION['forget_password'] = "Password Succesfully Updated";
                            } else {
                                $flag = true;
                                $_SESSION['confrim_password_error'] = "New password and confrim password dosen't match";
                            }
                        } else {
                            $flag = true;
                            $_SESSION['confrim_password_error'] = "Please enter your confrim password";
                        }
                    }
                } else {
                    $flag = true;
                    $_SESSION['new_pass_error'] = "Your new password is not strong use any letter,number and symbol";
                }
            } else {

                $flag = true;
                $_SESSION['new_password_error'] = "Please enter your new password";
            }
        } else {
            $flag = true;
            $_SESSION['current_password_error'] = "Current password dosen't match";
        }
    } else {
        $flag = true;
        $_SESSION['current_password_error'] = "Please enter your current password";
    }
}


if ($flag) {
    header('location:./profile.php');
}
