<?php

require_once(__DIR__.'/../includes/db.php');

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

$data = array();

$query = "SELECT * FROM events ORDER BY id";

$statement = $Conn->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["title"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"]
 );
}

echo json_encode($data);

?>