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
                            <h5 class="card-title">Update Service</h5>
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
                        endif;
                        unset($_SESSION['add_service_error']);

                        $id=$_GET['id'];
                        $service_query = "SELECT * FROM services WHERE id='$id'";
                        $service_query_db = mysqli_query($db_connect, $service_query);
                        $service= mysqli_fetch_assoc($service_query_db);
                        ?>

                        <div class="card-body">
                            <form action="./service_edit.php" method="post">
                                <div class="example-container">
                                    <div class="example-content">
                                        <label for="">Service title</label>
                                        <input hidden type="number" name="id" value="<?=$service['id']?>">
                                        <input type="text" class="form-control form-control-rounded mb" aria-describedby="roundedInputExample" placeholder="service title" name="service_title" value ="<?=$service['service_title']?>">
                                    </div>
                                    <div class="example-content">
                                        <label for="">Service icon</label>
                                        <i class="<?=$service['service_icon']?> fs-5"></i>
                                        <input readonly type="text" class="form-control form-control-rounded mb" aria-describedby="roundedInputExample" placeholder="service icon" name="service_icon" id="icon_value" value ="<?=$service['service_icon']?>">
                                    </div>
                                    <div class="card text-dark mx-5">
                                        <div class="card-body" style="overflow-y:scroll; height:120px; width:820px; text-align:center; background-color:slategray;">
                                            <?php
                                            require_once('../icons.php');
                                            foreach ($fonts as $font) : ?>
                                                <span class="card-text m-1 " style="cursor: pointer"><i class="<?= $font ?> fa-2x col-xl-1 col-md-1 col-3 icon_click" onmouseout="this.style.color='black'" id="<?= $font ?> " aria-hidden="true"></i></span>
                                            <?php
                                            endforeach;
                                            ?>
                                        </div>
                                    </div>
                                    <div class="example-content">
                                        <label for="">Service description</label>
                                        <textarea cols="30" rows="5" class="form-control form-control-rounded m-b-sm" name="service_description"><?=$service['service_description']?></textarea>
                                    </div>
                                    <div class="example-content">
                                        <label for="">Service Status</label>
                                        <select name="service_status" class="form-control form-control-rounded mb">
                                            <option value="active" <?=($service['service_status']=== 'active') ? 'selected': ''?>>Active</option>
                                            <option value="dactived"<?=($service['service_status']=== 'dactived') ? 'selected': ''?>>Dactived</option>
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
                $('.icon_click').click(function() {
                    $('#icon_value').val($(this).attr('id'));
                })

            })
        </script>