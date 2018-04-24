<?php
    class db{
      # Connect to DB
      # Using PDO
      function connect(){

        $config = parse_ini_file('../db.ini');

        $dbhost = $config['DB_HOST'];
        $dbuser = $config['DB_USER'];
        $dbpass = $config['DB_PWD'];
        $dbname = $config['DB_NAME'];

        $mysql_connect_str = "mysql:host=$dbhost; dbname=$dbname";
        $dbConnection = new PDO($mysql_connect_str, $dbuser, $dbpass);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
      }
    }
