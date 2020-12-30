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
$deleteconfirm =  'You have deleted your account. You will need to create another one to access certain features . <a href="/index.php">Back to homepage</a>';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
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

    <p> <?php echo $deleteconfirm; ?></p>
