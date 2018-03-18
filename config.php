<?php

//defenitions go here
     private $DB_HOST = 'dbclass.cs.nmsu.edu';
     private $DB_USER = 'cs448sp18team4';
     private $DB_PSW = 'JJ_F3b8gB0zsq87H';
     private $DB_NAME = 'cs448sp18team4';

function connectDB() {
    $link = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
    if($link->connect_error) {
       die("Connection Failed" . $link->connect_error);
    }
    //echo "<br>Connected successfully to the database<br><br>";
    return $link;
}
?>
