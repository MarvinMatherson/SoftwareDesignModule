<?php
session_start();

require_once(__DIR__.'/includes/db.php');

if($_GET['search']) {
  $query = 'SELECT * FROM Bikes WHERE bike_name LIKE :search ORDER BY bike_name LIMIT 10';
  $stmt = $Conn->prepare($query);
  $stmt->execute([
  "search" => "%".$_GET['search']."%"
]);

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if(!$results) {
    echo "No results";
  }else{
    foreach($results as $result) {
      echo '<a href="./item.php?id='.$result[bike_id].'"><input type="button" value="'.$result["bike_name"].'"/></a>';
    }
  }
  exit();
}




if($_POST['deleted']){
  $theuser = $_SESSION['user_data']['muser_id'];
  echo $theuser;
  $stmt = $Conn->prepare("DELETE FROM users WHERE muser_id=".$theuser);
  $stmt->execute();
 header('Location: delete.php');
}


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
  <body>
  <div class="warning"><p>All our stores remain open throughout the pandemic!</p></div>
<div class="first-header">
   <div class="container">
     <div class="row">
    <div class="col-md-8 d-flex p-2 d-flex align-items-center" id="header">
    <a href="./index.php"><h1> BikeOn</h1></a>
    <input type="text" placeholder= "Search" class="MainSearch"></input>
  </div>
  <div class="col-md-4" id="icon">
    <h3>Wishlist</h3>
    <h3>Language</h3>
    <a href="./login.php"><i class="las la-user-circle"></i></div></a>
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
    <form method='post'>
    <input type="submit" name='deleted' value="Delete account" />
</form>






  <script src="./script.js"></script>
  <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
  </script>
