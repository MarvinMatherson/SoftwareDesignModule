<?php
  session_start();
  require_once(__DIR__.'/includes/db.php');
?>

<?php
  if($_POST['register']){   //this is gonna be painful to explain ok... if the 'password' form is 'method post' sumbitted, hash the pasword with the latest most secure password hashing algorithm, then insert the username and the now hashed password into the database.
    $sec = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $query = 'INSERT INTO users (user_name, user_pass) VALUES (:user_name, :user_pass)';
    $stmt = $Conn->prepare($query);
    $stmt->execute([
      'user_name'=>$_POST['username'],
      'user_pass'=>$sec
    ]);

?>
 <div class="alert alert-success" role="alert" id="myalert"> <!-- use bootstrap alert to let the user know they NEED to log in-->
  Your account has been created. Please, log in!
  <button type="button" class="close" data-dismiss= "alert" aria-label="Close">
</div>
<?php
  }else if($_POST['login']){ //oh god not again ok here we go....  PT. 1: if the 'login' form is 'method post' submitted, then select the username in the database that is equal to the one entered in the form.
    $query = 'SELECT * FROM users WHERE user_name = :user_name';
    $stmt = $Conn->prepare($query);
    $stmt->execute([
      'user_name'=>$_POST['username']
    ]);
    $user = $stmt->fetch();
    if($user){  //P2: Now it gets complicated. If we have a succesful username (see PT. 1) then declare the variable $check, with our verified password (using the most secure password veryfiying algoritm ) and our username.
      $check = password_verify($_POST['password'], $user['user_pass']);
      if($check){ //if $check has a verified password AND a verified username, then name our session as _is_logged_in and then set it to true. Also declare the variable $loggedin (which we can use later on in our document).
        $_SESSION['is_logged_in'] = true;
        $_SESSION['user_data'] = $user;
        $loggedin = 'logged in';
        $_SESSION['message']= "is currently logged in.";
        header("Location: ./index.php");
      }else{ //If we didn't have a verified password and matching username declared into $check, then declare the variable $myerror1 (which we are gonna use later)
          $myerror1 = 'username or password incorrect';
      }
    }else{
      $myerror2 = 'username or password incorrect'; //if we didn't have a valid username in PT. 1, then declare the variable $myerror2.
    }

  }


  //if the user recieved the $loggedin string, then they are logged into a new session called '_is_logged_in'. If they recieved the $myerror1 or $myerror2 strings, then the username or password does not match. Or just don't exist on the database.


//AND THAT IS A PHP AND MYSQL SIGN UP AND LOGIN SYSTEM


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

    echo '<div class="alert alert-light" role="alert" mt-3>'.$myerror2.'
    </div>';

     ?>


  <div class="container">

    <div class="jumbotron" id="join">
<div class="row">
<div class="col-lg-6">
<form method="post" action=""> <!-- This post form is where the magic happens-->
    <h2>Login here</h2>
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="username"  name="username" class="form-control" id="exampleInputEmail1"> <!-- rememeber php looks for 'name' not 'class' or 'id' -->
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password"  name="password"   class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" name="login"  value="1" id="submitme" class="btn btn-primary">
Sumbit
  </button>
</form>
</div>



<div class="col-lg-6">
<h2>Sign up here</h2>
<form method="post" action=""> <!-- This post method form is also where the magic happens -->
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="username" name="username" class="form-control" id="exampleInputEmail2">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" name="register" value="1" id="submitme" class="btn btn-primary" >Submit</button>
</form>
  </div>
</div>
  </div>

  <div id="message">
    <h3>Password must contain the following:</h3>
    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
    <p id="number" class="invalid">A <b>number</b></p>
    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
  </div>



<h2 class="promise">By joining us, we won't share your data.</h2>
<div class="jumbotron" id="nowords">
<h3>Action Failed.</h3>
<p>You need to enter a value.</p>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Hello <span id="inputname1"></span>. You have succesfully logged in!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="./loggedinindex.html"><button type="button" class="btn btn-primary">Continue</button></a>
      </div>
    </div>
  </div>
</div>





<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="./script.js"></script>
<script>
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>
