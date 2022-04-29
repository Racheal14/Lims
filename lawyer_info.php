<?php
session_start(); 
$user_id = $_SESSION["user_id"];

if ($user_id == "") {
    header("Location:login.php");
}

else
{
?>
<!DOCTYPE html>
<html lang="en">
<!-- head start -->
<?php include("views/head.php") ?>
<!--Head ends-->
<body>
<!-- header start -->
<?php include("views/navbar.php") ?>
<!--Header ends-->
<?php
$lawyer_id = $_GET["lawyer_id"];
?>
<section>
    <div class="container-fluid" style="padding:  10px 20px;">
        <div class="row p-0">
            <div class="col-md-2 p-0 m-0">
                <div class=" bg-light p-2 m-0" style="border-radius:5px 5px 0px 0px">
                    <h6 class="text-center">JUSTICE</h6>
                    <hr>
                    <a href="" style="text-decoration: none;color:white">
                        
                            <a href="moreProduct.php?name=<?php echo $categoryname; ?>" class="lawyer_detail" id="more_products" style="color:black ;text-transform: capitalize;">
                                <p class="text-center rounded hover p-2">
                                    Chat<i class="bi bi-chevron-right" style="float: right;"></i>
                                </p>
                            </a>

                    </a>
                </div>

            </div>

            <?php

            ?>

        <div class="col-md-10">
            <div class="col-md-12 shadow">
                <div class="row">
                    <div class="col-md-5  p-0 m-0">

                            <img class="card-img-top img-fluid p-0 m-0" src="assets/img/" alt="Card image" style="width:90%;height: 30em;border-radius: 5px 5px 0px 0px;">

                        </div>
                        <div class="col-md-6">
                            <form action="lawyerDetail.php" method="POST">
                                <a href="lawyerDetail.php?id=" class="lawyer_detail">


                                    <h1 class="text-dark">
                                        Diane INGABIRE
                                         
                                    </h1>

                                    <div class="p-1">
                                    <span class="p-0 m-0" style="font-weight: 700;color:blue"><Address></Address>:</span>
                                        <span style="padding-left: 15px;color:red;font-weight: 700;"> KG 405 st 5</span>
                                        <p class="pb-1 mt-1 m-0" style="color:#999999;font-weight:400;font-size:12px">
                                            <span style="font-weight: 800;color:blue;font-size:13px">Qualifications: </span>
                                            <span class="text-dark" style="background-color: aquamarine; padding:3px 10px"><ol><ul>Bachelor's degrees in law</ul><ul>MBA</ul><ul>Master's degree in Public relations</ul></ol>/span>
                                        </p>
                                        <p class="p-0 m-0" style="color: #ff6a00;">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill "></i>
                                            <i class="bi bi-star-fill "></i>
                                            <i class="bi bi-star-half "></i>
                                        </p>

                                        <div class="p-2" style="background-color: #f8f8ff">

                                            

                        
                                            </div>
                                            <hr>

                                            <div>
                                                <p class="p-0 m-0 mb-2" style="font-weight: 700;">About:</p>
                                                <p style="padding-left: 15px;"></p>
                                            </div>


                                            <div class="mt-5 flex">
                                                <a class="btn btn-warning" href="myCart.php?id=">GET IN TOUCH</i></a></td>

                                            </div>
                                        </div>


                                    </div>
                                </a>
                            </form>
                        </div>



                        <div class="container other_lawyer">
                            <div class="row  p-2 m-2" style="background-color: #f0f0f0;">
                                <div class="col-md-12 p-1 m-0">
                                    <p class="p-0 m-0" style="border-bottom: 1px solid #c0c0c0;font-size:17px;font-weight:700">More </p>

                                </div>
                               
                                    <div class="col-md-2 p-0 m-0">
                                        <form action="index.php" method="POST">

                                            <a href="lawyerDetail.php?id=<?php echo $products->id; ?>" class="lawyer_detail">
                                                <div class="card h-100 shadow-sm" style="border-radius: 5px 5px 0px 0px; ">
                                                    <div class="col-md-12 mb-1 p-0 text-center">
                                                        <img class="card-img-top img-fluid" src="Upload/" alt="Card image" style="width:70%;height: 8rem;border-radius: 5px 5px 0px 0px;">
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="text-center">

                                                            <h5 class="card-title product_name p-0 mb-1" style="text-transform:capitalize">
                                                            </h5>
                                                            

                                                            </p>
                                                            <p class="p-0 m-0" style="color:#999999;font-weight:400;font-size:12px"><Address></Address>
                                                            </p>

                                                            <p class="p-0 m-0" style="font-size: 13px;color:#666666;font-weight:400">Address<p style="color:#999999;font-size:12px">KG 628 ST 9</p>
                                                            </p>
                                                            <p class="py-1 m-0 text-center" style="color: #ff6a00;font-size:12px">
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill "></i>
                                                                <i class="bi bi-star-fill "></i>
                                                                <i class="bi bi-star-half "></i>
                                                            </p>
                                                            <div class="mt-2">
                                                                <a class="btn btn-warning" href="getintouch.php?id=">GET IN TOUCH</i></a></td>

                                                            </div>
                                                            <input type="hidden" name="lawyer_id" value="">
                                                        </div>
                                                    </div>

                                                </div>
                                            </a>

                                        </form>


                                    </div>
                            </div>
                        </div>
                </div>
            </div>


        </div>
    </div>
    </div>
    </section>

    <?php include("views/footer.php") ?>

</body>

</html>
<?php
}
?>