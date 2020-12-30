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
<div class="container">
  <div class="jumbotron">
    <h2>Welcome to your profile. Do you want to log out or delete account?</h2>
    <a href="./logout.php"><input type="button" value="Logout"></a>
    <form method='post'>
    <input type="button"  data-toggle="modal" data-target="#deleteme" value="Delete account" />
</form>

<!-- Modal -->
<div class="modal fade" id="deleteme" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">You are deleting your account!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        By continuing,you will fully delete and remove your account. All data associated with you will consenquently be removed. Are you sure you want to do this?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Go back</button>
          <form method="post">
        <input type="submit" name="deleted" value="Delete account" class="btn btn-primary"></button>
      </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

  <script src="./script.js"></script>
