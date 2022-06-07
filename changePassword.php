<?php
session_start();
//load and initialize database class
require_once 'core/db.php';
$db = new DB();
$con = $db ->__construct();

if (isset($_SESSION["user_id"])) {
  $user_id = $_SESSION["user_id"];
}
else
{
  $user_id = "";
  header("Location:home.php");
}


$sql = "SELECT * FROM users WHERE id ='".$user_id."'";
$q = $con->query($sql);
$q->setFetchMode(PDO::FETCH_ASSOC);

while($row = $q->fetch())
{
    $password = $row["password"];
}

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
            <p class="text-center" style="font-size: 30px;color:white"> Change your password</p>
            <hr style="color: white;">

            <form action="class/loginControler.php" method="post">
                <div class="mb-4">
                    <label for="old_pass" class="form-label text-light">Enter old password</label>

                    <input id="old_pass" type="password" name="old_pass" class="form-control p-1">
                </div>
                <div class="mb-4">
                    <label for="new_pass" class="form-label text-light">Enter new password</label>

                    <input id="new_pass" type="password" name="new_pass" class="form-control p-1">
                </div>
                <div class="mb-4">
                    <label for="ren_pass" class="form-label text-light">Re-enter new password</label>
                    <input type="hidden" value="<?php echo $password?>" id="old_password">
                    <input type="hidden" value="<?php echo $user_id?>" id="user_id">

                    <input id="ren_pass" type="password" name="ren_pass" class="form-control p-1">
                </div>
                <div class="mb-4">
                    <input id="button" type="button" onclick="changePass()" value="Change Password" class="btn btn-primary col-md-12">
                </div>
                <input type="hidden" name="location" value="<?php if (!empty($_SERVER['HTTP_REFERER'])) echo $_SERVER['HTTP_REFERER'];
                                                            else echo ''; ?>" type="text" />

            </form>
        </div>
    </div>
    </div>
</section>
</body>

<script type="text/javascript">
    function changePass()
    {
        var old_pass = document.getElementById("old_pass").value;
        var old_password = document.getElementById("old_password").value;
        var new_pass = document.getElementById("new_pass").value;
        var ren_pass = document.getElementById("ren_pass").value;
        var action = "change_password";
        var user_id = document.getElementById("user_id").value;


        if (old_pass != old_password) 
        {
            alert("Your old password is wrong, Please try again!");
        }
        else
        { 
            if (new_pass != ren_pass) 
            {
                alert("Your two new passwords don't match, Please try again!");
            }
            else
            {
                /*to initialize the http request*/
                    var xhttp = new XMLHttpRequest();
                    /* to check the status  and the sate of the request  after executing the request for displaying a execution msg*/
                    xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {

                      var msg = this.responseText;
                      var ms = msg.trim();
                      if (ms=="success") 
                      {
                          window.top.location="home.php";
                      }
                      else
                      {
                          alert("Something went wrong! Please try again later!");
                          window.location.reload();
                      }       
                    }
                };
                
                /*open the http request with the Method and the sever page*/
                xhttp.open("POST", "admin/class/userControler.php", true);
                /*to define the Request header*/
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //
                /*to define the parameters to be held in the request*/
                xhttp.send("action=" + action + "&new_pass=" + new_pass + "&user_id=" + user_id);
            }
        }
    }
</script>

</html>