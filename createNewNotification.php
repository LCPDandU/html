<?php

include("config.php");
include("header.php");

// REST url
$url = 'http://localhost/public/api/notifications/add';

// Need to initiate curl
$ch = curl_init($url);

// Create array for json data.
$jsonData = array(
    'NotificationTitle' => $_POST['NotificationTitle'],
    'NotificationDescription' => $_POST['NotificationTitle'],
    'PostDate' => $_POST['PostDate'],
    'PostTimeHour' => $_POST['PostTimeHour'],
    'PostTimeMinute' => $_POST['PostTimeMinute'],
    'PostTimeAMPM' => $_POST['PostTimeAMPM'],
);

// Need to encode this array into json.
$jsonDataEncoded = json_encode($jsonData);

// curl hands the post request
curl_setopt($ch, CURLOPT_POST, 1);

// json string is now attached to the post fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

// Set the content type to application/json.
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// Need to execute the request.
$result = curl_exec($ch);


// Below is the code for the old method of posting
/*
//check that all of the fields are populated correctly

//check that inputs are of valid lengths?

//set variables
//use filter_var to remove special characters from input
$NotificationTitle = filter_var($_POST['NotificationTitle'], FILTER_SANITIZE_STRING);
$NotificationDescription = filter_var($_POST['NotificationDescription'], FILTER_SANITIZE_STRING);
$PostDate = $_POST['PostDate'];

$PostTimeHour = filter_var($_POST['PostTimeHour'], FILTER_SANITIZE_STRING);
$PostTimeMinute = filter_var($_POST['PostTimeMinute'], FILTER_SANITIZE_STRING);
$PostTime = $PostTimeHour.":".$PostTimeMinute;

$PostTimeAMPM = $_POST['PostTimeAMPM'];

try
{
   //Connect to CRUD Database  mysqli(Server,User,Password,Database)
   $link = connectDB();

   $sql = "INSERT INTO Notification VALUES (null,'".$NotificationTitle."','".$NotificationDescription."','".$PostDate."','".$PostTime."','".$PostTimeAMPM."')";
   if (mysqli_query($link, $sql))
   {
      $message = 'New Notification added';
   }
   else
   {
      echo  "<br>Error: " . $sql . "<br>" . mysqli_error($link);
   }
}
catch(Exception $e)
{
   $message = 'Unable to process request';
}
*/
?>

<html>

   <p>
      <form action="createMenu" method="post"><input type="submit" value="Return"/></form>
   </p>

</html>
