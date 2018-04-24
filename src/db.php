<?php

    class db{

   function __construct($dbhost, $dbuser, $dbpass, $dbname) {
    $this->dbhost = $dbhost;
    $this->dbuser = $dbuser;
    $this->dbpass = $dbpass;
    $this->dbname = $dbname;
  }

      function connect(){

        $mysql_connect_str = "mysql:host=$this->dbhost; dbname=$this->dbname";
        $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
      }
    }
