<?php
require_once('../includes/header.php');

?>
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Profile</h1>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="card" style="color:black;">
                        <div class="card-body" style="background-color:lightslategray;">
                            <div class="example-container">
                                <div class="example-content">
                                    <form action="./profile_data.php" method="post" enctype="multipart/form-data">
                                        <label for="" class="form-label">Name</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="name" value="<?= $_SESSION['auth_name'] ?>">
                                        </div>
                                        <?php
                                        if (isset($_SESSION['name_error'])) { ?>
                                            <p class="text-danger"><?= $_SESSION['name_error']; ?></p>
                                        <?php
                                        }
                                        unset($_SESSION['name_error']);
                                        ?>
                                        <label for="" class="form-label">Current Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" name="current_password">
                                        </div>
                                        <?php
                                        if (isset($_SESSION['current_password_error'])) { ?>
                                            <p class="text-danger"><?= $_SESSION['current_password_error']; ?></p>
                                        <?php
                                        }
                                        unset($_SESSION['current_password_error']);
                                        ?>
                                        <label for="" class="form-label">New Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" name="new_password">
                                        </div>
                                        <?php
                                        if (isset($_SESSION['new_password_error'])) { ?>
                                            <p class="text-danger"><?= $_SESSION['new_password_error']; ?></p>
                                        <?php
                                        }
                                        unset($_SESSION['new_password_error']);
                                        ?>
                                        <label for="" class="form-label">Confrim Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" name="confrim_password">
                                        </div>
                                        <?php
                                        if (isset($_SESSION['confrim_password_error'])) { ?>
                                            <p class="text-danger"><?= $_SESSION['confrim_password_error']; ?></p>
                                        <?php
                                        }
                                        unset($_SESSION['confrim_password_error']);
                                        ?>
                                        <label for="" class="form-label">Phone Number</label>
                                        <div class="input-group mb-3">
                                            <input type="tel" class="form-control" name="phone_number">
                                        </div>
                                        <?php
                                        if (isset($_SESSION['phn_numb_error'])) { ?>
                                            <p class="text-danger"><?= $_SESSION['phn_numb_error']; ?></p>
                                        <?php
                                        }
                                        unset($_SESSION['phn_numb_error']);
                                        ?>

                                        <label for="" class="form-label">Address</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="address">
                                        </div>

                                        <?php
                                        if (isset($_SESSION['address_error'])) { ?>
                                            <p class="text-danger"><?= $_SESSION['address_error']; ?></p>
                                        <?php
                                        }
                                        unset($_SESSION['address_error']);
                                        ?>

                                        <label for="" class="form-label">Upload Profile</label>
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control" name="profile_pic">
                                        </div>


                                        <button type="submit" class="btn btn-info" name="update">update</button>
                                        <button type="submit" class="btn btn-info" name="forget password">Forget password</button>
                                        <?php
                                        if (isset($_SESSION['update'])) { ?>
                                            <h5 class="text-dark mt-3"><?= $_SESSION['update']; ?></h5>
                                        <?php
                                        }
                                        unset($_SESSION['update']);
                                        ?>

                                        <?php
                                        if (isset($_SESSION['forget_password'])) { ?>
                                            <h5 class="text-dark mt-3"><?= $_SESSION['forget_password']; ?></h5>
                                        <?php
                                        }
                                        unset($_SESSION['forget_password']);
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            require_once('../includes/footer.php')
            ?>