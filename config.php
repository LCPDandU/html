<?php

//definitions go here
define('DB_HOST', 'dbclass.cs.nmsu.edu'); /*Database Server*/
define('DB_NAME', 'cs448sp18team4'); /*Database Name*/
define('DB_USER', 'cs448sp18team4'); /*Database Username*/
define('DB_PWD', 'JJ_F3b8gB0zsq87H'); /*Database Password*/

 define('FIREBASE_API_KEY', 'AIzaSyCKZqpdli2qcVtTRA6TdIP3wW5CNjI7M4E'); /*Firebase API key for push notifications.*/

function connectDB() {
    $link = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
    if($link->connect_error) {
       die("Connection Failed" . $link->connect_error);
    }
    //echo "<br>Connected successfully to the database<br><br>";
    return $link;
}
?>
