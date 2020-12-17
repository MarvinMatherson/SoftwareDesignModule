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
    <a href="./index.php"><h1> BikeOn</h1></a>
    <input type="text" placeholder= "Search" class="MainSearch"></input>
  </div>
  <div class="col-md-4" id="icon">
    <h3>Wishlist</h3>
    <h3>Language</h3>
   <a href="./profile.php"><i class="las la-user-circle"></i></a>
  </div>
</div>
</div>
</div>
<div class="second-header">
<div class="container">
<div class="row">
<h3>Brands</h3>
<a href="./Calendar/index.php"><h3>Services</h3></a>
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
<div  class="verify">
 <?php
  echo $myerror1; //echo out the value of $myerror1 or $myerror2. This value was added earlier up.
  echo $myerror2;

?>
<p id="loggedin"><?php echo $loggedin //echo out the value of $loggedin. This value was added ealier up. ?></p>
</div>


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
    <input type="password"  name="password" class="form-control" id="exampleInputPassword1">
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
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" name="register" value="1" id="submitme" class="btn btn-primary" >Submit</button>

</form>
  </div>

</div>

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
