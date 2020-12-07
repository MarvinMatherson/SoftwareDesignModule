<?php
  require_once(__DIR__.'./includes/db.php')
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>BikeOn</title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <div class="container">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
</div>

<div class="container">
  <h1 class="mt-5 mb-5">Create new Bike</h1>
<?php

if($_POST['bike_name']) {
  // process the form
  $data = [
    'bike_name' => $_POST['bike_name'],
    'bike_price' => $_POST['bike_price']
  ];

  $query = 'INSERT INTO Bikes (bike_name, bike_price) VALUES(:bike_name, :bike_price)';
  $stmt = $Conn->prepare($query);
  $stmt->execute($data);

 ?>
 <div class="alert alert-success" role="alert">
  Your bike has been created.
</div>

<?php
}
 ?>

  <form action="" method="post">
    <div class="form-group">
      <label for="exampleInputEmail1">Bike Name</label>
      <input type="text" class="form-control" id="bikename"  name="bike_name" placeholder="Enter Bike Name">
    </div>
<div class="form-group">
      <label for="exampleInputEmail1">Bike Price</label>
      <input type="text" class="form-control" id="bikeprice"  name="bike_price" placeholder="Enter Bike Price">
</div>
    <button type="submit" class="btn btn-primary">Create</button>
  </form>


</div>
  <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="js/script.js"></script>
</body>
</html>
