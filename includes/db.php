<?php

$db_config = [
  "db_host" => "localhost",
  "db_name" => "BikeOn",
  "db_user" => "BikeOn",
  "db_pass" => "Superpuppy7"
];

$Conn = new PDO("mysql:host=".$db_config['db_host'].";dbname=".$db_config['db_name'],$db_config['db_user'],$db_config['db_pass']);
