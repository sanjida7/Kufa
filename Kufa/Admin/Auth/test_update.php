<?php
require_once('../includes/header.php');
session_start();
require_once('./db_connect.php');

?>
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Testimonial</h1>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card"style="background-color:lightslategray;">
                        <div class="card-header">
                            <h5 class="card-title">Update Testimonial</h5>
                        </div>
                        <?php
                        if (isset($_SESSION['add_test_error'])) : ?>
                            <div class="alert alert-danger" role="alert">
                                <h4 class="text-center"><?= $_SESSION['add_test_error'] ?></h4>
                            </div>
                        <?php
                            unset($_SESSION['add_test_error']);
                        endif;
                        ?>
                        <?php
                        if (isset($_SESSION['success'])) : ?>
                            <div class="alert alert-success" role="alert">
                                <h4 class="text-center"><?= $_SESSION['success'] ?></h4>
                            </div>
                        <?php
                            unset($_SESSION['success']);
                        endif;
                        $id = $_GET['id'];
                        $testi_query = "SELECT * FROM testimonials WHERE id='$id'";
                        $testi_query_db = mysqli_query($db_connect, $testi_query);
                        $testi = mysqli_fetch_assoc($testi_query_db);
                        ?>


                        <div class="card-body">
                            <form action="./test_add_data.php" method="post" enctype="multipart/form-data">

                                <div class="example-content">
                                    <input type="number" hidden value="<?= $id ?>" name="update_id">
                                    <label for="">Testimonial Image</label>
                                    <input type="file" class="form-control form-control-rounded mb" aria-describedby="roundedInputExample" placeholder="work image" name="testi_image">
                                </div>
                                <?php

                                if (isset($_SESSION['img_error'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <h4 class="text-center"><?= $_SESSION['img_error'] ?></h4>
                                    </div>
                                <?php
                                    unset($_SESSION['img_error']);
                                endif;
                                ?>
                                <div class="example-content">
                                        <label for="">Testimonial comment</label>
                                        <textarea cols="30" rows="5" class="form-control form-control-rounded m-b-sm" name="testi_comment"><?= $testi['comment'] ?></textarea>
                                    </div>
                                <div class="example-container">
                                    <div class="example-content">

                                        <label for="">Testimonial name </label>
                                        <input type="text" class="form-control form-control-rounded mb" aria-describedby="roundedInputExample" placeholder="work title" name="testi_name" value="<?= $testi['name'] ?>">
                                    </div>
                                    <div class="example-content">
                                        <label for="">Testimonial title</label>
                                        <input type="text" class="form-control form-control-rounded mb" aria-describedby="roundedInputExample" placeholder="work heading" name="testi_title" value="<?= $testi['title'] ?>">
                                    </div>
                                    


                                    <div class="example-content">
                                        <label for="">Testimonial Status</label>
                                        <select name="testi_status" class="form-control form-control-rounded mb">
                                            <option value="active" <?= ($testi['status'] === 'active') ? 'selected' : '' ?>>Active</option>
                                            <option value="dactived" <?= ($testi['status'] === 'dactived') ? 'selected' : '' ?>>Dactived</option>
                                        </select>
                                    </div>
                                    <div class="example-content">
                                        <button class="btn btn-info mx-5" type="submit" name="update_work" ; style="width:600px; height:50px;">Update Testimonial</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require_once('../includes/footer.php')
        ?>