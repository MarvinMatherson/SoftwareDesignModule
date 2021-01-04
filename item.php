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

 $item_id = $_GET['id']; //get the id of the page from the url. Literally this variable will get the unique number in our url we mad eon our index.php code
 $stmt = $Conn->prepare("SELECT bike_name, bike_price, bike_description, bike_image, bike_dimensions, bike_review FROM Bikes WHERE bike_id=".$item_id); //select the values of the columns, where the bike_id is equal to the item_id in the URL from the variable we declared in the line bove
 $stmt->execute(); //execute the queries
 $bikes = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetch the data and put into an array)


   if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true) { //(check index.php for the session details) BUT if the session is_logged_in has a value and is set and is true..... then declare the variable $review with some HTML and set the variable $signup to go to the users profile page..
     $signupindex = '<a href="./profile.php"><i class="las la-user-circle"></i></div></a>';
   } else {  //if the session is_logged_in doesn't have a value or isn't set or isn't true, then declare the variable $result as some other HTML. Declare the variable $signup to go to the login page.
     $signupindex = '<a href="./login.php"><i class="las la-user-circle"></i></div></a>';
   }



//we now have all e need to add our data into our html!

//FOR TESTING PURPOSES, THESE ARE THE ITEMS WE HAVE PULLED IN FROM OUR DATABASE! (if these are uncommented they will show up at the top of the page!)  WE HAVE DECLARED THEM BELOW.
//echo $bikes[0]['bike_name'];
//echo $bikes[0]['bike_price'];
//echo $bikes[0]['bike_description'];
//echo $bikes[0]['bike_image]


if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true) { //(check index.php for the session details) BUT if the session is_logged_in has a value and is set and is true..... then declare the variable $review with some HTML and set the variable $signup to go to the users profile page..
  $review = '
  <form action="" method="post">
  <textarea placeholder="Would you like to leave a review?" name="bike_review" maxlength="500" id="textareaID" ></textarea>
  <button type="submit" class="btn btn-primary">Create</button>
  </form>
  <button type="buttton" value="" data-toggle="modal" data-target="#buying" id="buyme">Buy this bike</button>';
  $signup = '<a href="./profile.php"><i class="las la-user-circle"></i></div></a>';
} else {  //if the session is_logged_in doesn't have a value or isn't set or isn't true, then declare the variable $result as some other HTML. Declare the variable $signup to go to the login page.
    $review ='<h6>You need to <a href="./login.php">sign in</a> to leave reviews, or buy bikes.</h6>';
    $signup= '<a href="./login.php"><i class="las la-user-circle"></i></div></a>';
}




if($_POST['bike_review']) {
  // process the form
  $data = [
    'bike_review' => $_POST['bike_review'],
    'bike_id' => $_GET['id'],
    'user_id' => $_SESSION['user_data']['user_name']
  ];
  $query = 'INSERT INTO reviews (bike_review, user_id, bike_id) VALUES (:bike_review, :user_id, :bike_id)';
  $stmt = $Conn->prepare($query);
  $stmt->execute($data);

 ?>

<?php
$backtopage = $_GET['id'];
header("Location: ./item.php?id=".$backtopage);

 ?>

 <div class="alert alert-success" role="alert">
  Your review has been posted.
</div>

 <?php

}
  ?>

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
            <input type="search" class="bikesearch" name="search" placeholder="Find a bike...">
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


  if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true){

  echo '
  <div class="alert alert-success" role="alert">'
      .$loggediname." ".$loggedinmessage.'
  </div>
  '

  ;

  } else {
    echo '
    <div class="alert alert-LIGHT" role="alert" mt-3>
     There is no one logged in at the current time.
    </div>
    ';
  }


  ?>
<div class="container">
    <div class="row">
  <div class="col-lg-8" id="itemimg">
  <img src="./images/<?php echo $bikes[0]['bike_image'];?>" width="100%"></img>
  </div>
<div class="col-lg-4" id="info">
  <h1 class="bikeName"><?php echo $bikes[0]['bike_name']; //Echo the bikes_name value from our database(above). As these items are in an array, we need to select the index. They will be the first in each array so [0] will suffice ?></h1>
  <p class="price"> £<?php echo $bikes[0]['bike_price']; // /Echo the bikes_price value from our database(above)?></p>
  <p><?php echo $bikes[0]['bike_description']; //Echo the bikes_description value from our database(above)?> </p>
  <p>Dimensions: <?php echo $bikes[0]['bike_dimensions']; ?></p>
<?php
echo $review;
echo $postit;
  ?>
  <?php
    $item_id = $_GET['id'];
    $stmt = $Conn->prepare('SELECT * FROM reviews WHERE bike_id ='.$item_id); //This is your database connection,  copy these three lines of code and change 'bikes' to your database, here we are preparing the query
    $stmt->execute(); //here we are executing the query
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC); //here we are fetching the results of our query nd putting them into an array.
    foreach ($reviews as $key => $review){   //this will be different for your design, but for each item in our query, display them onto our website using HTML (how u display it will be different)
   ?>
   <div id="bikeItemReview">
     <p><?php echo$review['user_id'];?> says: </p>
     <p> <?php echo $review['bike_review']; //bike_price is a column in my database?></p>
   </div>
  <?php
  }
   ?>


</div>
</div>
</div>









<div class="modal fade" id="buying" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buy the <?php echo $bikes[0]['bike_name']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" id="vood" role="alert">
This payment portal is not real.
</div>
        <div class="row">
         <div class="col-lg-6">
           <img src="./images/<?php echo $bikes[0]['bike_image'];?>" width="100%"></img>
         </div>
         <div class="col-lg-6" id="paymenttext">
           <h6>You are purchasing the <?php echo $bikes[0]['bike_name']; ?> for £<span class="pricy"><?php echo $bikes[0]['bike_price'];?></span></h6>
           <h6 class="daprice">Please enter your bank details below.</h6>
              <div class="deets">
             <input type="text" id="sorty" placeholder="Sortcode">
             <input type="text" id="accnum" placeholder="Account number">
           </div>
         </div>
      </div>
      <div class="modal-footer">
      <a href="./bought.php"><button class="btn btn-primary">Buy</button></a>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="script.js"></script>
