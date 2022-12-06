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
                        <h1>Works</h1>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card"style="background-color:lightslategray;">
                        <div class="card-header">
                            <h5 class="card-title">Update Work</h5>
                        </div>
                        <?php
                        if (isset($_SESSION['add_work_error'])) : ?>
                            <div class="alert alert-danger" role="alert">
                                <h4 class="text-center"><?= $_SESSION['add_work_error'] ?></h4>
                            </div>
                        <?php
                            unset($_SESSION['add_work_error']);
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
                        $work_query = "SELECT * FROM works WHERE id='$id'";
                        $work_query_db = mysqli_query($db_connect, $work_query);
                        $work = mysqli_fetch_assoc($work_query_db);
                        ?>


                        <div class="card-body">
                            <form action="./works_data.php" method="post" enctype="multipart/form-data">
                                <div class="example-container">
                                    <div class="example-content">
                                    <input type="number" hidden value = "<?=$id?>" name = "update_id"> 
                                        <label for="">Work title</label>
                                        <input type="text" class="form-control form-control-rounded mb" aria-describedby="roundedInputExample" placeholder="work title" name="work_title" value="<?= $work['work_title'] ?>">
                                    </div>
                                    <div class="example-content">
                                        <label for="">Work Heading</label>
                                        <input type="text" class="form-control form-control-rounded mb" aria-describedby="roundedInputExample" placeholder="work heading" name="work_heading" value="<?= $work['work_heading'] ?>">
                                    </div>
                                    <div class="example-content">
                                        <label for="">Work description</label>
                                        <textarea cols="30" rows="5" class="form-control form-control-rounded m-b-sm" name="work_description"><?= $work['work_description'] ?></textarea>
                                    </div>
                                    <div class="example-content">
                                        <label for="">Work Image</label>
                                        <input type="file" class="form-control form-control-rounded mb" aria-describedby="roundedInputExample" placeholder="work image" name="work_image">
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
                                        <label for="">Work Status</label>
                                        <select name="work_status" class="form-control form-control-rounded mb">
                                            <option value="active" <?= ($work['work_status'] === 'active') ? 'selected' : '' ?>>Active</option>
                                            <option value="dactived" <?= ($work['work_status'] === 'dactived') ? 'selected' : '' ?>>Dactived</option>
                                        </select>
                                    </div>
                                    <div class="example-content">
                                        <button class="btn btn-info mx-5" type="submit" name="update_work" ; style="width:600px; height:50px;">Update Work</button>
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