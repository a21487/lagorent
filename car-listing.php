<?php

session_start();
include('includes/config.php');
error_reporting(0);
?>

<!DOCTYPE HTML>
<html lang="pt">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <title>Lagorent portal</title>
  <!--Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
  <!--Custome Style -->
  <link rel="stylesheet" href="assets/css/style.css" type="text/css">
  <!--OWL Carousel slider-->
  <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
  <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
  <!--slick-slider -->
  <link href="assets/css/slick.css" rel="stylesheet">
  <!--bootstrap-slider -->
  <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
  <!--FontAwesome Font Style -->
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">

  
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" data-default-color="true" />



</head>

<body>
  <!-- Start Switcher -->
  
  <!-- /Switcher -->

  <!--Header-->
  <?php include('includes/header.php'); ?>
  <!-- /Header -->

  <!--Page Header-->
  <section class="page-header listing_page">
    <div class="container">
      <div class="page-header_wrap">
        <div class="page-heading">
          <h1>Car Listing</h1>
        </div>
        <ul class="coustom-breadcrumb">
          <li><a href="#">Home</a></li>
          <li>Car Listing</li>
        </ul>
      </div>
    </div>
    <!-- Dark Overlay-->
    <div class="dark-overlay"></div>
  </section>
  <!-- /Page Header-->

  <!--Listing-->
  <section class="listing-page">
    <div class="container">
      <div class="row">
        <div class="col-md-9 col-md-push-3">
          <div class="result-sorting-wrapper">
            <div class="sorting-count">


              <?php
              //Query for Listing count
              $sql = "SELECT id from tblvehicles";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $cnt = $query->rowCount();
              ?>

              <p><span><?php echo htmlentities($cnt); ?> Resultados</span></p>
            </div>
          </div>






          <?php

$sql = "SELECT tblvehicles.*, tblbrands.BrandName, tblbrands.id AS bid FROM tblvehicles JOIN tblbrands ON tblbrands.id = tblvehicles.VehiclesBrand";
$whereClause = "";
$parameters = array();

if ($brand == "Seleciona a Marca" && $fueltype == "Seleciona o combustivel") {
  $sql .= " WHERE VehiclesBrand = :brand AND FuelType = :fueltype";
  $whereClause = " WHERE";
  $parameters = array(':brand' => $brand, ':fueltype' => $fueltype);
} elseif ($brand != "Seleciona a Marca"  && $fueltype == "Seleciona o combustivel") {
  $sql .= " WHERE VehiclesBrand = :brand";
  $whereClause = " WHERE";
  $parameters = array(':brand' => $brand);
} elseif ($fueltype != "Seleciona o Combustível"  && $brand == "Seleciona a Marca") {
  $sql .= " WHERE FuelType = :fueltype";
  $whereClause = " WHERE";
  $parameters = array(':fueltype' => $fueltype);
}

$query = $dbh->prepare($sql);
$query->execute($parameters);
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = $query->rowCount();

if ($cnt > 0) {
  foreach ($results as $result) {
    ?>
    <div class="product-listing-m gray-bg">
      <div class="product-listing-img">
        <img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>" class="img-responsive" alt="Image" />
      </div>
      <div class="product-listing-content">
        <h5>
          <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>">
            <?php echo htmlentities($result->BrandName); ?> , <?php echo htmlentities($result->VehiclesTitle); ?>
          </a>
        </h5>
        <p class="list-price">Preço: <?php echo htmlentities($result->PricePerDay); ?>€</p>
        <ul>
          <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity); ?> Lugares</li>
          <li><i class="fa fa-calendar" aria-hidden="true"></i>modelo <?php echo htmlentities($result->ModelYear); ?></li>
          <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType); ?></li>
        </ul>
        <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>" class="btn">
          Detalhes <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
        </a>
      </div>
    </div>
  <?php
  }
} else {
  echo "<p>Nenhum resultado encontrado.</p>";
}


if ($brand == "Seleciona a Marca" && $fueltype == "Seleciona o combustivel") {
 
  echo "<p>Por favor, selecione a marca e/ou o tipo de combustível para pesquisar.</p>";
  
}
?>





        </div>

        <!--Side-Bar-->
        <aside class="col-md-3 col-md-pull-9">
          <div class="sidebar_widget">
            <div class="widget_heading">
              <h5><i class="fa fa-filter" aria-hidden="true"></i>Encontra o teu carro</h5>
            </div>
            <div class="sidebar_filter">
              <form action="search-carresult.php" method="post">
                <div class="form-group select">
                  <select class="form-control" name="brand">
                    <option id="sm">Seleciona a Marca</option>

                    <?php $sql = "SELECT * from  tblbrands ";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                      foreach ($results as $result) {       ?>
                        <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->BrandName); ?></option>
                    <?php }
                    } ?>

                  </select>
                </div>
                <div class="form-group select">
                  <select class="form-control" name="fueltype">
                    <option id="sc">Seleciona o combustivel</option>
                    <option value="Petrol">Gasolina</option>
                    <option value="Diesel">Gasóleo</option>
                    <option value="CNG">GLP</option>
                  </select>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Pesquisa</button>
                </div>
              </form>
            </div>
          </div>

          <div class="sidebar_widget">
            <div class="widget_heading">
              <h5><i class="fa fa-car" aria-hidden="true"></i> Recently Listed Cars</h5>
            </div>
            <div class="recent_addedcars">
              <ul>
                <?php $sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand order by id desc limit 4";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                  foreach ($results as $result) {  ?>

                    <li class="gray-bg">
                      <div class="recent_post_img"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>" alt="image"></a> </div>
                      <div class="recent_post_title"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->BrandName); ?> , <?php echo htmlentities($result->VehiclesTitle); ?></a>
                        <p class="widget_price">$<?php echo htmlentities($result->PricePerDay); ?> Por dia</p>
                      </div>
                    </li>
                <?php }
                } ?>

              </ul>
            </div>
          </div>
        </aside>
        <!--/Side-Bar-->
      </div>
    </div>
  </section>
  <!-- /Listing-->


  <!--Footer -->
  <?php include('includes/footer.php'); ?>
  <!-- /Footer-->

  <!--Back to top-->
  <div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
  <!--/Back to top-->

  <!--Login-Form -->
  <?php include('includes/login.php'); ?>
  <!--/Login-Form -->

  <!--Register-Form -->
  <?php include('includes/registration.php'); ?>

  <!--/Register-Form -->

  <!--Forgot-password-Form -->
  <?php include('includes/forgotpassword.php'); ?>

  <!-- Scripts -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/interface.js"></script>
  <!--Switcher-->
  <script src="assets/switcher/js/switcher.js"></script>
  <!--bootstrap-slider-JS-->
  <script src="assets/js/bootstrap-slider.min.js"></script>
  <!--Slider-JS-->
  <script src="assets/js/slick.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
</body>

</html>