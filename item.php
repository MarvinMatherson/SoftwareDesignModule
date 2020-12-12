<?php
session_start();
require_once(__DIR__.'/includes/db.php');


 $item_id = $_GET['id']; //get the id of the page from the url
 $stmt = $Conn->prepare("SELECT bike_name, bike_price, bike_description, bike_image FROM Bikes WHERE bike_id=".$item_id); //select the values of the columns, where the bike_id is equal to the item_id in the URL
 $stmt->execute(); //execute the queries
 $bikes = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetch the data and put into an array)
  


//FOR TESTING PURPOSES, THESE ARE THE ITEMS WE HAVE PULLED IN FROM OUR DATABASE! (if these are uncommented they will show up at the top of the page!)  WE HAVE DECLARED THEM BELOW.
//echo $bikes[0]['bike_name'];
//echo $bikes[0]['bike_price'];
//echo $bikes[0]['bike_description']; 
//echo $bikes[0]['bike_image]


if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true) { //(check index.php for the session details) BUT if the session is_logged_in has a value and is set and is true..... then declare the variable $review with some HTML and set the variable $signup to go to the users profile page..
  $review = '
  <form action="" method="post">
  <textarea placeholder="Would you like to leave a review?" name="review" maxlength="500" id="textareaID" ></textarea>
  <input type="button" value="Buy this bike" onclick=mysignup();>';
  $signup = '<a href="./profile.php"><i class="las la-user-circle"></i></div></a>';
} else {  //if the session is_logged_in doesn't have a value or isn't set or isn't true, then declare the variable $result as some other HTML. Declare the variable $signup to go to the login page.
    $review ='<h6>You need to <a href="./login.php">sign in</a> to leave reviews, or buy bikes.</h6>';
    $signup= '<a href="./login.php"><i class="las la-user-circle"></i></div></a>';
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
    <link href='/node_modules/fullcalendar/main.css' rel='stylesheet' />
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
    <?php echo $signup; ?>
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
  <div class="jumbotron" id="mainitem">
  <div class="row">
  <div class="col-lg-6">
  <?php $bike_img_item = $bikes[0]['bike_image'];
   echo'<img src="./images/'.$bike_img_item.'width="100%"></img>'; // LORD HELP US (php is broken, my code is always correct)
   echo "<pre>" . var_dump($bike_img_item) . "</pre>"; 
   ?>
  </div>
<div class="col-lg-6">
  <h1 class="bikeName"><?php echo $bikes[0]['bike_name']; //Echo the bikes_name value from our database(above). As these items are in an array, we need to select the index. They will be the first in each array so [0] will suffice ?></h1>
  <p><?php echo $bikes[0]['bike_description']; //Echo the bikes_description value from our database(above)?> </p>  
  <p>This bike costs: £<?php echo $bikes[0]['bike_price']; // /Echo the bikes_price value from our database(above)?></p>
<form>
<?php
echo $review;
 ?> 
</form>
</div>
</div>
</div>
</div>



<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        you have succesfully bought this product!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Continue</button>
      </div>
    </div>
  </div>
</div>






<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">exceeded DA LIMIT MATE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Congratulations, you've written too much!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




<script src='/node_modules/fullcalendar/main.js'></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="./script.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');   //why is this here?
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    selectable: true
  });
  calendar.render();
});

</script>