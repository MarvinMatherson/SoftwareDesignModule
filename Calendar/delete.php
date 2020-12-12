<?php

require_once(__DIR__.'/../includes/db.php');

if(isset($_POST["id"]))
{




 $query = "
 DELETE from events WHERE id=:id
 ";
 $statement = $Conn->prepare($query);
 $statement->execute(
  array(
   ':id' => $_POST['id']
  )
 );
}

?>