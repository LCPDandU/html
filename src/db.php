<?php

    // Class that creates the database.
    class db{

    // Constructor that defines the database's host, user, password and name.
    function __construct($dbhost, $dbuser, $dbpass, $dbname) {
      $this->dbhost = $dbhost;
      $this->dbuser = $dbuser;
      $this->dbpass = $dbpass;
      $this->dbname = $dbname;
    }

    // Connect to database dia PDO.
    function connect(){
      $mysql_connect_str = "mysql:host=$this->dbhost; dbname=$this->dbname";
      // PDO helps ensure inability for malicious agents to use SQL injection.
      $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
      $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $dbConnection;
    }
  }
