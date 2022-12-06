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
                            <h5 class="card-title">Add Testimonial</h5>
                        </div>
                        <?php
                        if (isset($_SESSION['add_testi_error'])) : ?>
                            <div class="alert alert-danger" role="alert">
                                <h4 class="text-center"><?= $_SESSION['add_testi_error'] ?></h4>
                            </div>
                        <?php
                            unset($_SESSION['add_testi_error']);
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
                        ?>


                        <div class="card-body">
                            <form action="./test_add_data.php" method="post" enctype="multipart/form-data">
                                <div class="example-container">
                                    <div class="example-content">
                                    <div class="example-content">

                                        <label for="">Testimonial Image</label>
                                        <input type="file" class="form-control form-control-rounded mb" aria-describedby="roundedInputExample" placeholder="work image" name="testi_image">
                                    </div>
                                      
                                    <?php
                                    if (isset($_SESSION['size_error'])) { ?>
                                        <div class="alert alert-danger text-center">
                                            <strong><?= $_SESSION['size_error'] ?></strong>
                                        </div>
                                    <?php
                                    }
                                    unset($_SESSION['size_error']);
                                    ?>
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
                                        <textarea cols="30" rows="5" class="form-control form-control-rounded m-b-sm" name="testi_comment"></textarea>
                                    </div>

                                        <label for="">Testimonial name</label>
                                        <input type="text" class="form-control form-control-rounded mb" aria-describedby="roundedInputExample" placeholder="work title" name="testi_name">
                                    </div>
                                    <div class="example-content">
                                        <label for="">Testimonial title</label>
                                        <input type="text" class="form-control form-control-rounded mb" aria-describedby="roundedInputExample" placeholder=" testi title" name="testi_title">
                                    </div>
                                   
                                  

                                    <div class="example-content">
                                        <label for="">Testimonial Status</label>
                                        <select name="testi_status" class="form-control form-control-rounded mb">
                                            <option value="active">Active</option>
                                            <option value="dactived">Dactived</option>
                                        </select>
                                    </div>
                                    <div class="example-content">
                                        <button class="btn btn-info mx-5" type="submit" name="test_work" ; style="width:600px; height:50px;">Add Work</button>
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