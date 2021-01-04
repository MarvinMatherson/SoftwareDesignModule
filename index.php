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

  if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true) { //(check index.php for the session details) BUT if the session is_logged_in has a value and is set and is true..... then declare the variable $review with some HTML and set the variable $signup to go to the users profile page..
    $signupindex = '<a href="./profile.php"><i class="las la-user-circle"></i></div></a>';
  } else {  //if the session is_logged_in doesn't have a value or isn't set or isn't true, then declare the variable $result as some other HTML. Declare the variable $signup to go to the login page.
    $signupindex = '<a href="./login.php"><i class="las la-user-circle"></i></div></a>';
  }





  ?>


  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="/css/styles.css">
      <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
      <script src="https://kit.fontawesome.com/ce87640ca1.js" crossorigin="anonymous"></script>

      <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
  <script>
      Weglot.initialize({
          api_key: 'wg_6611aad02dd15e52e33aa6552636ad7c4'
      });
  </script>
    </head>
    <body>

      <div class="logo">
        <div class="container">
      <a href="./index.php"><img src="./images/logo4.png" width="30%"></img></a>
  </div>
  </div>
      <nav class="navbar navbar-expand-lg">
        <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
          <i class="fas fa-bars" style="color:#fff; font-size:28px;"></i>
      </span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="./item.php?id=2">Mountain</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./item.php?id=15">BMX </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./item.php?id=1">Road</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <form action="post" class="searchers">
          <input type="search" class="MainSearch" name="search" placeholder="Find a bike...">
          <input type="submit" value="Search" class="mainsearch">
        </form>
        </div>
            <a href="./profile.php"><?php echo $signupindex ?></i></a>
        </form>
      </div>
    </div>
    </nav>








<?php

 $loggediname = $_SESSION['user_data']['user_name'];
 $loggedinmessage = $_SESSION['message'];


if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true){

echo '
<div class="alert alert-success" role="alert">'
    .$loggediname." ".$loggedinmessage.'
</div>
';

} else {
  echo '
  <div class="alert alert-LIGHT" role="alert" mt-3>
   There is no one logged in at the current time.
  </div>
  ';
}
?>


 <div class="jumbotron" id="welcome">
   <div class="container">
  <div class="row">
  <div class="col-lg-6" >
    <img src="./images/roadbike.png" width="100%">
  </div>
  <div class="col-lg-6">
    <h1>Welcome to BikeOn. the home of all things bikes! </h1>
    <p>BikeOn is the top seller of premium bikes and services. </p>
</div>
</div>
</div>
</div>



<div class="container">
  <div class="owl-carousel owl-theme">
<div class="row">




<?php
  $stmt = $Conn->prepare('SELECT * FROM Bikes'); //This is your database connection,  copy these three lines of code and change 'bikes' to your database, here we are preparing the query
  $stmt->execute(); //here we are executing the query
  $bikes = $stmt->fetchAll(PDO::FETCH_ASSOC); //here we are fetching the results of our query nd putting them into an array.

  foreach ($bikes as $key => $bike){   //this will be different for your design, but for each item in our query, display them onto our website using HTML (how u display it will be different)
 ?>
 <div class="col-lg-4">
 <div id="bikeItem">
   <img src="./images/<?php echo $bike['bike_image'];?>" width="100%"></img>
   <div class="biketext">
   <h3><?php echo $bike['bike_name'];   //bike_item is a column in my database?></p>
   <p>Price: <?php echo $bike['bike_price']; //bike_price is a column in my database?></p>
   <?php
      $bike_id = $bike["bike_id"]; //declaring the $bike_id varibale with the bike_id (that is my primary key in the table)
      echo '<a href="./item.php?id='.$bike_id.'"><input type="button" class="infobutton" value="See More" /></a>';  //THIS IS HOW WE MAKE OUR DYNAMIC INDIVIDUAL LINKS!!  Echo a link that goes to our item page and concatanate  our bike_id variable (delcared in the line above) at the end. (just like when we did our tv api and we concatanate the users input) As we have a different id in each column, it will show a different id at the end of the url for each item.




   ?>
  </div>
  </div>
  </div>
<?php
}
 ?>








<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">WARNING NOT LOGGED IN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        YOU CAN'T ACCESS THIS WITHOUT LOGGING IN!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="./login.html"><button type="button" class="btn btn-primary">LOGIN</button></a>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
