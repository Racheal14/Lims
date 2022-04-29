<?php
session_start(); 
$user_id = $_SESSION["user_id"];
//load and initialize database class
require_once 'core/db.php';
$db = new DB();
$con = $db ->__construct();
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
 <section id="blog" class="blog">
    <div class="container">

    <?php
    $limit = 6; 
    $status = "active"; 

    $s = $con->prepare("SELECT * FROM lawyer");
    $s->execute();
    $allResp = $s->fetchAll(PDO::FETCH_ASSOC);
    $total_results = $s->rowCount();
    $total_pages = ceil($total_results/$limit);
    
    if (!isset($_GET['page'])) {
        $page = 1;
    } else{
        $page = $_GET['page'];
    }


    $start = ($page-1)*$limit;

    $stmt_get_pagination = $con->prepare("SELECT * FROM lawyer ORDER BY id DESC LIMIT $start, $limit");
    $stmt_get_pagination->execute();
    // set the resulting array to associative
    $stmt_get_pagination->setFetchMode(PDO::FETCH_OBJ);
    $results = $stmt_get_pagination->fetchAll();
    $no = $page > 1 ? $start+1 : 1;

    foreach($results as $result){

  ?>
  <div class="card car">
    <div class="card__header">
      <img class="imag" src="assets/img/lawyers/<?php echo $result->image?>" alt="card__image" class="card__image" width="600">
    </div>
    <div class="card__body my_car" style="overflow: hidden;">
        <?php
            if ($result->status == "active") {
            ?>
            <span class="tag tag-blue"><?php echo $result->status?></span>
            <?php
            }
            elseif ($result->status == "inactive") {
            ?>
            <span class="tag tag-brown"><?php echo $result->status?></span>
            <?php
            }
        ?>
      
      <a class="nav-link" onclick="reload(<?php echo $result->id?>)">
      <h4><?php echo $result->fname." ".$result->lname?></h4>
      </a>
      <p><?php echo $result->qualifications?></p>
      <div class="card__footer">
      <div class="user">
         <div class="user__info">
          <div class="social-links">
                    <a href="https://twitter.com/umutesiannet" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
                  <a href="https://www.instagram.com/umutesiannet" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
                  <a href="https://rw.linkedin.com/in/annet-umutesi-b6316475" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
          <div class="contact_button"><a href="lawyer_info.php?lawyer_id=<?php echo $result->id?>" class="btn btn-primary">Contact</a></div>
        </div>
      </div>
    </div>
    </div>
    
  </div>
<?php $no++; } ?>
<br>
<br>
<br>
<nav aria-label="page navigation">
 <ul class="pagination">
        <li class="page-item"><a class="page-link" href="?page=1">First</a></li>
        
        <?php for($p=1; $p<=$total_pages; $p++){?>
            
            <li class="page-item<?= $page == $p ? 'active' : ''; ?>"><a class="page-link" href="<?= '?page='.$p; ?>"><?= $p; ?></a></li>
        <?php }?>
        <li><a class="page-link" href="?page=<?= $total_pages; ?>">Last</a></li>
    </ul> 
</nav>

</div>
</section><!-- End blog Section -->

    <!-------------------------------------Footer--------------------------------------------->
    <?php include("views/footer.php") ?>

<!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

</body>

</html>
