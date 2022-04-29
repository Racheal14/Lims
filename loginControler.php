<?php
//start the session
session_start(); 
//load and initialize database class
require_once '../core/db.php';
$db = new DB();
$con = $db ->__construct();


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $user_name = $_POST['user_name'];
    $password = $_POST['user_password'];
    $table_users= "users";

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        //read from database
        $condition="email='".$user_name."'AND password='".$password."'";
    
        $login = $db->login($table_users, $condition);

        if ($login != 0) 
        {
            $_SESSION["user_id"] = $login;
            header("Location:../home.php");
        }
        else
        {
            echo "not_found";
        }

    } else {
        echo "<div class=\"alert alert-danger text-center container mt-3 col-md-5\">Enter valid information</div>";
    }
}

?>