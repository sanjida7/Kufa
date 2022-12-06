<?php
require_once('../includes/header.php');
session_start();
require_once('../Auth/db_connect.php');

?>
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Services</h1>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card"style="background-color:lightslategray;">
                        <div class="card-header">
                            <h5 class="card-title">Add Service</h5>
                        </div>
                        <?php
                        if (isset($_SESSION['success'])) : ?>
                            <div class="alert alert-success" role="alert">
                                <h4 class="text-center"><?= $_SESSION['success'] ?></h4>
                            </div>
                        <?php
                            unset($_SESSION['success']);
                        endif;
                        ?>
                        <?php
                        if (isset($_SESSION['add_service_error'])) : ?>
                            <div class="alert alert-danger" role="alert">
                                <h4 class="text-center"><?= $_SESSION['add_service_error'] ?></h4>
                            </div>
                        <?php
                            unset($_SESSION['add_service_error']);
                        endif;
                        ?>

                        <div class="card-body">
                            <form action="../service_data.php" method="post">
                                <div class="example-container">
                                    <div class="example-content">
                                        <label for="">Service title</label>
                                        <input type="text" class="form-control form-control-rounded mb" aria-describedby="roundedInputExample" placeholder="service title" name="service_title">
                                    </div>
                                    <div class="example-content">
                                        <label for="">Service icon</label>
                                        <input readonly type="text" class="form-control form-control-rounded mb" aria-describedby="roundedInputExample" placeholder="service icon" name="service_icon" id="icon_value">
                                    </div>
                                    <div class="card text-dark mx-5">
                                        <div class="card-body" style="overflow-y:scroll; height:120px; text-align:center; background-color:slategray;">
                                            <?php
                                            require_once('../icons.php');
                                            foreach ($fonts as $font) : ?>
                                                <span class="card-text m-1 " style="cursor: pointer" ><i  class="<?= $font ?> fa-2x col-xl-1 col-md-1 col-3 icon_click" onmouseout="this.style.color='black'" id="<?= $font ?> " aria-hidden="true"></i></span>
                                            <?php
                                            endforeach;
                                            ?>
                                        </div>
                                    </div>
                                    <div class="example-content">
                                        <label for="">Service description</label>
                                        <textarea cols="30" rows="5" class="form-control form-control-rounded m-b-sm" name="service_description"></textarea>
                                    </div>
                                    <div class="example-content">
                                        <label for="">Service Status</label>
                                        <select name="service_status" class="form-control form-control-rounded mb">
                                            <option value="active">Active</option>
                                            <option value="dactived">Dactived</option>
                                        </select>
                                    </div>
                                    <div class="example-content">
                                        <button class="btn btn-info mx-5" style="width:600px; height:50px;">Add Service</button>
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
        <script>
            $(document).ready(function() {
                $('.icon_click').click(function(){
                    $('#icon_value').val($(this).attr('id'));
                })
                
            })
        </script>