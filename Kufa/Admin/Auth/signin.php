<?php include('./includes/header.php'); session_start()?>

<div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
    <div class="app-auth-background">

    </div>
    <div class="app-auth-container">
        <div class="logo">
            <a href="index.html">Neptune</a>
        </div>
        <p class="auth-description">Please sign-in to your account and continue to the dashboard.<br>Don't have an account? <a href="./signup.php">Sign Up</a></p>
        <?php
        if (isset($_SESSION['signin_status'])) :?>
            <div class="alert alert-primary" role= "alert">
                <p class= "text-center"><?=$_SESSION['signin_status']?></p>
            </div>
        <?php
        unset($_SESSION['signin_status']);
        endif
        ?>
        
        <div class="auth-credentials m-b-xxl">
        <form action="./signin_data.php" method="post">
            <label for="signInEmail" class="form-label">Email address</label>
            <input type="text" class="form-control <?=(isset($_SESSION['email_error'])) ? 'is-invalid' : ''?> m-b-md" id="signInEmail" aria-describedby="signInEmail" placeholder="example@neptune.com" name= "user_email" value="<?=isset($_SESSION['registration_email'])? $_SESSION['registration_email'] : ''; unset($_SESSION['registration_email']);?>">
            <?php
                if (isset($_SESSION['email_error'])) { ?>
                    <p class="text-danger"><?= $_SESSION['email_error']; ?></p>
                <?php
                }
                unset($_SESSION['email_error']);
                ?>
            <label for="signInPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="signInPassword" aria-describedby="signInPassword" name= "user_password">
                <?php
                if (isset($_SESSION['password_error'])) { ?>
                    <p class="text-danger"><?= $_SESSION['password_error']; ?></p>
                <?php
                }
                unset($_SESSION['password_error']);
                ?>
        </div>

        <div class="auth-submit">
            <button class="btn btn-primary">Sign In</button>
        </div>
        </form>
        
        <div class="divider"></div>
    </div>
</div>

<?php include('./includes/footer.php'); ?>