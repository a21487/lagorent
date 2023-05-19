
<header>

  <!-- Navigation -->
  <nav id="navigation_bar" class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Alternar de navegação</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="header_wrap">
        <div class="user_login" style= "border: none; ">
          <ul>
            <li class="dropdown" > <a href="#" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true" style="font-size: 20px; color:greenyellow"> </i >
<?php
$email=$_SESSION['login'];
$sql ="SELECT FullName FROM tblusers WHERE EmailId=:email ";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
	{

	 echo htmlentities($result->FullName); }}?></i></a>
              <ul class="dropdown-menu">
           <?php  if($_SESSION['login']){?>
            
            <li><a href="profile.php">Profile Settings</a></li>
              <li><a href="update-password.php">Update Password</a></li>
            <li><a href="my-booking.php">My Booking</a></li>
            <li><a href="post-testimonial.php">Post a Testimonial</a></li>
          <li><a href="my-testimonials.php">My Testimonial</a></li>
            <li><a href="logout.php">Sign Out</a></li>
            
            <?php } else { ?>
            <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Profile Settings</a></li>
              <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Update Password</a></li>
            <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">My Booking</a></li>
            <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Post a Testimonial</a></li>
          <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">My Testimonial</a></li>
          <?php   if(strlen($_SESSION['login'])==0)
	        {
        ?>
 <li><div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal" style=" background-color:rgba(157,173,0,255)">Login</a> </div>
<?php }
else{

echo "Bem-vindo ao nosso portal de compra de carros";
 } ?></li>
            <?php } ?>


          </ul>
            </li>
          </ul>
        </div>
       
        <div class="header_search">     
          <div id="search_toggle"><i class="fa fa-search" aria-hidden="true"></i></div>
          <form action="#" method="get" id="header-search-form">
            <input type="text" placeholder="Pesquisar..." class="form-control">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>
        </div>
      </div>
      <div class="col-sm-2 col-md-2" style="margin-left: 20px;">
      <div class="logo pull-left"> <a href="index.php"><img src="assets/images/logg.png" alt="image" style="width:140px; padding:10px; margin-left: -50px;" /></a> </div>
        </div>
      <div class="collapse navbar-collapse" id="navigation">
     
        <ul class="nav navbar-nav" >
          <li><a href="index.php">Home</a ></li>
          <li><a href="page.php?type=aboutus">Sobre nós</a></li>
          <li><a href="car-listing.php">Lista de carros</a>
          <li><a href="page.php?type=faqs">FAQ</a></li>
          <li><a href="contact-us.php">Contactos</a></li>

        </ul>
      </div>
     
    </div>
    
  </nav>
  <!-- Navigation end -->

</header>
