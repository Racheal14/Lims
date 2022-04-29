<?php
session_start();
//load and initialize database class
require_once 'core/db.php';
$db = new DB();
$con = $db ->__construct();


?>

<!DOCTYPE html>
<html lang="en">

<head>


<!-- head start -->
<?php include("views/head.php") ?>
<!--Head ends-->
    <style>
        
    </style>
</head>

<body>
    <!-- header start -->
<?php include("views/navbar.php") ?>
<!--Header ends-->
<section>
    <div class="container">
    <div class="glass p-3 justify-content-center align-items-center container col-md-4">
        <div class="row">
            <p class="text-center" style="font-size: 30px;color:white"> Log in</p>
            <hr style="color: white;">

            <form action="class/loginControler.php" method="post">
                <div class="mb-4">
                    <label for="user_name" class="form-label text-light">User Name</label>

                    <input id="text" type="text" name="user_name" class="form-control p-1">
                </div>
                <div class="mb-4">
                    <label for="user_password" class="form-label text-light">Enter your password</label>

                    <input id="text" type="password" name="user_password" class="form-control p-1">
                </div>
                <div class="mb-4">
                    <input id="button" type="submit" value="Login" class="btn btn-primary col-md-12">
                </div>
                <p class="text-light">Don't have Account ? click <a href="signup.php" style="text-decoration: none;color:greenyellow">here</a> to Signup</p>
                <input type="hidden" name="location" value="<?php if (!empty($_SERVER['HTTP_REFERER'])) echo $_SERVER['HTTP_REFERER'];
                                                            else echo ''; ?>" type="text" />

            </form>
        </div>
    </div>
    </div>
</section>
</body>

</html>