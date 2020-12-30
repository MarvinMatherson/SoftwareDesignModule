<?php

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();

$confirmation = 'You have been logged out. <a href="/index.php">Go back</a>'; //Show message and send user back to the home page. Session no longer exists and user is logged out.
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



   ?>
