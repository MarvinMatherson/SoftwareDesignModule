
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="/node_modules/owl.carousel/dist/assets/owl.carousel.min.css" />
  </head>
  <body>
  <div class="warning"><p>All our stores remain open throughout the pandemic!</p></div>
<div class="first-header">
   <div class="container">
     <div class="row">
    <div class="col-md-8 d-flex p-2 d-flex align-items-center" id="header">
    <a href="./loggedinindex.html"><h1> BikeOn</h1></a>
    <input type="text" placeholder= "Search" class="MainSearch"></input>
  </div>
  <div class="col-md-4" id="icon">
    <h3>Wishlist</h3>
    <h3>Language</h3>
    <a href="./login.html"><i class="las la-user-circle"></i></div></a>
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

<div class="container">
  <div class="jumbotron">
    <h2>Welcome to your profile. Do you want to log out or delete account?</h2>
    <a href="./logout.php"><input type="button" value="Logout"></a>
    <input type="button" value="Delete account" />


  </div>

  <script src="./script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
  function test(){
    $.ajax({
      url:"profile.php", success:function(result)
      {

      }
    })
  }
  </script>