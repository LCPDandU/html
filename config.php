<?php

// define firebase api key
$FBconfig = parse_ini_file('../db.ini');
define('FIREBASE_API_KEY', $FBconfig['FIREBASE_API_KEY']);

function connectDB() {
  $config = parse_ini_file('../db.ini');
  $con = mysqli_connect($config['DB_HOST'],$config['DB_USER'],$config['DB_PWD'],$config['DB_NAME']);
  if(!$con){
      die("Failed to connect to Database");
  }
  return $con;
}
?>
