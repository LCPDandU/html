<?php
/*
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
*/

$config=parse_ini_file('../db.ini');
define('DB_HOST', $config['DB_HOST']);
define('DB_NAME', $config['DB_NAME']);
define('DB_USER', $config['DB_USER']);
define('DB_PWD', $config['DB_PWD']);

define('FIREBASE_API_KEY', $config['FIREBASE_API_KEY']);


//A function to connect to the database
function connectDB(){
   $link=new mysqli(DB_HOST,DB_USER,DB_PWD,DB_NAME);
   if($link->connect_error){
      die("Connection Failed: " . $link->connect_error);
   }
   return $link;
}

//This function checks user input for undesireable characters and returns true if they were found as well as a list of those that were found.
function containsSpecialChar($string){
   $contains=false;
   $char="";
   $charCount=0;
   
   //The list iterated upon when looking for special characters
   //to add more special characters notwanted in user input, simply add a new character at the end of the array
   $specialChar = array('/','\\',"'",'"',';',':','=','@','!','%','&','+');
   
   foreach($specialChar as $ch)
   {
      if(strpos($string,$ch)!==false)
      {
         $contains = true;
         if($charCount>0)$char .= ", ";
         //$char .= "' ".$ch." '";
         $char .= $ch;
         $charCount = $charCount+1;
      }
   }
   return array("contains" => $contains, "charList" => $char);
}

//define('URL_START', 'http://localhost');
define('URL_START', 'https://tm4sp18.cs.nmsu.edu');

?>
