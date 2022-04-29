<?php
//load and initialize database class
require_once 'core/db.php';
$db = new DB();
$con = $db ->__construct();
?>
<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <section id="blog" class="blog">
    <div class="container">

    <?php
    $limit = 6; 
    $status = "active"; 

    $s = $con->prepare("SELECT * FROM lawyer WHERE status = '$status'");
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
      <span class="tag tag-blue">Active</span>
      <a class="nav-link" onclick="reload(<?php echo $result->id?>)">
      <h4><?php echo $result->fname?></h4>
      </a>
      <p style="overflow: hidden; height: 50px;"><?php echo $result->qualifications?>...</p>
    </div>
    
  </div>
<?php $no++; } ?>
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
