<?php

$db_config = [
  "db_host" => "localhost",
  "db_name" => "BikeOn",
  "db_user" => "BikeOn",
  "db_pass" => "12345"
];

try {
  $Conn = new PDO("mysql:host=".$db_config['db_host'].";dbname=".$db_config['db_name'],$db_config['db_user'],$db_config['db_pass']);
  $Conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $Conn->setAttribute(PDO::ATTR_PERSISTENT, true);
  $Conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e) {
  echo $e->getMessage();
  exit();
}





if(isset($_POST["id"]))
{
 $query = "
 UPDATE events 
 SET title=:title, start_event=:start_event, end_event=:end_event 
 WHERE id=:id
 ";
 $statement = $Conn->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':id'   => $_POST['id']
  )
 );
}

?>


