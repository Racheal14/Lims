<?php
session_start();
$_SESSION;

?>
<?php
session_start();
include("connection.php");
include("functions.php");
require 'items.php';


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    //something was posted

    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $confirm_password = $_POST['confirm_password'];
    $user_email = $_POST['user_email'];
    $phone_number = $_POST['phone_number'];

    if (!empty($user_name) && !empty($user_password) && !is_numeric($user_name)  && !empty($user_email)  && !empty($phone_number)  && !empty($user_address)  && !empty($user_street)) {

        //save to database
        if ($_POST['user_password'] !== $_POST['confirm_password']) {

            echo "<div class=\"alert alert-danger text-center container mt-3 col-md-5\">Your password did not much</div>";
        } else {

            $query = "INSERT INTO users(user_name,user_password,user_email, phone_number,user_address,user_street,userRole) values('$user_name','$user_password','$user_email','$phone_number','$user_address', '$user_street','user')";
            mysqli_query($con, $query);

            header("Location:login.php");
        }
    } else {
        echo "<div class=\"alert alert-danger text-center container mt-3 col-md-5\">Enter valid information</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <head>
    <nav>
            <li><a href="home.php">HOME</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="Register.php">SINGUP</a></li>

        </nav>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <title>LIMS</title>



        <style>
            .glass {
                margin-top: 5%;
                background: rgba(14, 14, 14, 0.25);
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
                backdrop-filter: blur(7px);
                -webkit-backdrop-filter: blur(7px);
                border-radius: 10px;
                border: 1px solid rgba(255, 255, 255, 0.18);
            }

            body {
                background-image: url("asset/images/this.jpg");
                background-color: #cccccc;
                /* Used if the image is unavailable */
                height: 100%;
                /* You must set a specified height */
                background-position: center;
                /* Center the image */
                background-repeat: no-repeat;
                /* Do not repeat the image */
                background-size: cover;
                max-height: 20%;
            }
        </style>
    </head>

<body>



    <div class="glass justify-content-center align-items-center container col-md-4">
        <div class="row">
            <p class="text-center" style="font-size: 30px;color:white">Please Sign up</p>
            <hr style="color: white;">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="user_name" class="form-label text-light">User Name</label>

                    <input id="" type="text" name="user_name" class="form-control" autocomplete="false">
                </div>
                <div class="mb-3">
                    <label for="user_email" class="form-label text-light">Email</label>

                    <input id="" type="email" name="user_email" class="form-control" autocomplete="false">
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label text-light">Phone Number</label>

                    <input id="" type="text" name="phone_number" class="form-control" autocomplete="false">
        </div>
                <div class="mb-3">
                    <label for="user_password" class="form-label text-light">Password</label>

                    <input class="form-control" type="password" name="user_password">
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label text-light">Confirm Password</label>

                    <input class="form-control" type="password" name="confirm_password">
                </div>
                <div class="mb-3">
                    <input class="btn btn-primary col-md-12" type="submit" value="Sign Up">
                </div>
                <p class="text-light">CLick here to <a class="" style="text-decoration: none;color:greenyellow" href="login.php">Login.</a></p>
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>