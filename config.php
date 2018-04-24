<?php

 define('FIREBASE_API_KEY', 'AIzaSyCKZqpdli2qcVtTRA6TdIP3wW5CNjI7M4E'); /*Firebase API key for push notifications.*/

function connectDB() {
  $config = parse_ini_file('./db.ini');
  $con = mysqli_connect($config['DB_HOST'],$config['DB_USER'],$config['DB_PWD'],$config['DB_NAME']);
  if(!$con){
      die("Failed to connect to Database");
  }
  return $con;
}
?>
