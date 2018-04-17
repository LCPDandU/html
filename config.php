<?php

//definitions go here
/*
define('DB_HOST', 'dbclass.cs.nmsu.edu');
define('DB_NAME', 'cs448sp18team4');
define('DB_USER', 'cs448sp18team4');
define('DB_PWD', 'JJ_F3b8gB0zsq87H');
*/


define('DB_HOST', 'localhost');
define('DB_NAME', 'cs448sp18team4');
define('DB_USER', 'root');
define('DB_PWD', '');


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
