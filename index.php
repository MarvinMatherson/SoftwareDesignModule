<?php
  require_once(__DIR__.'/includes/db.php');

 
  ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="/node_modules/owl.carousel/dist/assets/owl.carousel.min.css" />
  </head>
  <div class="warning"><p>All our stores remain open throughout the pandemic!</p></div>
<div class="first-header">
   <div class="container">
     <div class="row">
    <div class="col-md-8 d-flex p-2 d-flex align-items-center" id="header">
    <h1> BikeOn</h1>
    <form action="" method="get">
    <input type="text" placeholder="Search" class="MainSearch" name="search"/>
    </form>
  </div>
  <div class="col-md-4" id="icon">
    <h3>Wishlist</h3>
    <h3>Language</h3>
    <i class="las la-user-circle"></i>
  </div>
</div>
</div>
</div>
<div class="second-header">
<div class="container">
<div class="row">
<h3>Brands</h3>
<h3>Services</h3>
<h3>Infomation</h3>
<h3>Road Bikes</h3>
<h3>Mountain Bikes</h3>
<h3>BMX bikes</h3>
</div>
</div>
</div>
<div class="guarantee">
<p>BikeOn is the leader in professional bike sales and services, trusted by thousands online!</p>
</div>

 <div class="jumbotron">
  <div class="container">
  <div class="row">
  <div class="col-lg-6">
    <img src="./images/bike1.jpg" width="100%">
  </div>
  <div class="col-lg-6">
    <h1>Welcome to BikeOn, the home of all things bikes! </h1>
    <p->Here you can fins all the infomation you may need to concerning any bikes</p->
</div>
</div>
</div>
  
  
</div>
<div class="container">
  <div class="owl-carousel owl-theme">
<div class="row">  




<?php
  $stmt = $Conn->prepare('SELECT * FROM Bikes');
  $stmt->execute();
  $bikes = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($bikes as $key => $bike){
 ?>
 <div class="col-lg-4">
 <div id="bikeItem">
   <img src="./images/biker.jpg" width="100%"></img>
   <p class="bikename"><?php echo $bike['bike_name'];?></p>
   <p class="bikeprice"><?php echo $bike['bike_price'];?></p>
  </div>
  </div>
<?php
}
 ?>



     






</div>
</div>
</div>
<footer>
  <div class="mainfooter">
</footer>




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="/node_modules/jquery/dist/jquery.js"></script>
<script src="/node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
<script>
  $('.owl-carousel').owlCarousel({
    margin:10,
    loop:true,
    autoWidth:false,
    items:1
})
  </script>

</body>
</html>



