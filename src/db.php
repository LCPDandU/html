<?php
    class db{

      # Properties
      private $dbhost = 'dbclass.cs.nmsu.edu';
      private $dbuser = 'cs448sp18team4';
      private $dbpass = 'JJ_F3b8gB0zsq87H';
      private $dbname = 'cs448sp18team4';

      # Connect to DB
      # Using PDO
      public function connect(){
        $mysql_connect_str = "mysql:host=$this->dbhost; dbname=$this->dbname";
        $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
      }
    }

