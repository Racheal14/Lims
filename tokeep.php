<?php
//load and initialize database class
require_once './core/db.php';
$db = new DB();
$con = $db ->__construct();


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $location = $_POST['location'];



    $user_name = $_POST['user_name'];
    $password = $_POST['user_password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        //read from database
        $query = "select * from users where user_name = '$user_name' limit 1";
        $result = mysqli_query($connect, $query);


        while ($DataRows = mysqli_fetch_array($result)) {

            $userRole = $DataRows['userRole'];


            if ($userRole === 'user' && $location !== 'http://localhost/LIMS/admin/index.php') {


                if (empty($location)) {


                    $result = mysqli_query($connect, $query);

                    $user_data = mysqli_fetch_assoc($result);
                    if ($user_data['user_password'] === $password) {
                        $id = $_SESSION['id'] = $user_data['id'];


                        header("Location: index.php");
                    }
                } elseif ($location == "http://localhost/LIMS/signup.php") {
                    $result = mysqli_query($connect, $query);

                    $user_data = mysqli_fetch_assoc($result);
                    if ($user_data['user_password'] === $password) {
                        $id = $_SESSION['id'] = $user_data['id'];


                        header("Location: index.php");
                    }
                } elseif ($location == "http://localhost/LIMS/login.php") {
                    $result = mysqli_query($connect, $query);

                    $user_data = mysqli_fetch_assoc($result);
                    if ($user_data['user_password'] === $password) {
                        $id = $_SESSION['id'] = $user_data['id'];


                        header("Location: index.php");
                    }
                } else {
                    $result = mysqli_query($connect, $query);

                    $user_data = mysqli_fetch_assoc($result);
                    if ($user_data['user_password'] === $password) {
                        $id = $_SESSION['id'] = $user_data['id'];


                        header("Location:" . $location);
                    }
                }
            } else {
                if ($userRole == 'admin') {
                    $result = mysqli_query($connect, $query);

                    $user_data = mysqli_fetch_assoc($result);
                    if ($user_data['user_password'] === $password) {
                        $id = $_SESSION['id'] = $user_data['id'];

                        header("Location: admin/index.php");
                    }
                } else {
                    $result = mysqli_query($connect, $query);

                    $user_data = mysqli_fetch_assoc($result);
                    if ($user_data['user_password'] === $password) {
                        $id = $_SESSION['id'] = $user_data['id'];

                        header("Location: index.php");
                    }
                }
            }
        }
    } else {
        echo "<div class=\"alert alert-danger text-center container mt-3 col-md-5\">Enter valid information</div>";
    }
}

?>