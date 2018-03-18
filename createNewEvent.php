<?php

include("config.php");
include("header.php");

//check that all of the fields are populated correctly

//check that inputs are of valid lengths?

//set variables
//use filter_var to remove special characters from input
$EventTitle = filter_var($_POST['EventTitle'], FILTER_SANITIZE_STRING);
$EventCategory = filter_var($_POST['EventCategory'], FILTER_SANITIZE_STRING);
$EventDate = $_POST['EventDate'];

$EventStartTimeHour = filter_var($_POST['EventStartTimeHour'], FILTER_SANITIZE_STRING);
$EventStartTimeMinute = filter_var($_POST['EventStartTimeMinute'], FILTER_SANITIZE_STRING);
$EventStartTime = $EventStartTimeHour.":".$EventStartTimeMinute;

$EventStartTimeAMPM = $_POST['EventStartTimeAMPM'];
$EventLocation = filter_var($_POST['EventLocation'], FILTER_SANITIZE_STRING);
$EventDescription = filter_var($_POST['EventDescription'], FILTER_SANITIZE_STRING);
$Media1 = "null";
$Media2 = "null";
$Media3 = "null";

try
{
   //Connect to CRUD Database  mysqli(Server,User,Password,Database) 
   $link = connectDB();

   $sql = "INSERT INTO CalendarEvent VALUES (null,'".$EventTitle."','".$EventCategory."','".$EventDate."','".$EventStartTime."','".$EventStartTimeAMPM."','".$EventLocation."','".$EventDescription."',".$Media1.",".$Media2.",".$Media3.")";
   if (mysqli_query($link, $sql)) 
   {
      $message = 'New Event added';
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

?>

<html>
   
   <p>
      <?php echo $message;?>
      <form action="createMenu.php" method="post"><input type="submit" value="Return"/></form>
   </p>
   
</html>