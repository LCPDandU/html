<?php

include("config.php");
include("header.php");

//check that all of the fields are populated correctly

//check that inputs are of valid lengths?

//set variables
//use filter_var to remove special characters from input
$EventID=$_POST['EventID'];

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

   $sql = "UPDATE CalendarEvent SET Title = '".$EventTitle."', Category = '".$EventCategory."', EventDate = '".$EventDate."', EventStartTime = '".$EventStartTime."', EventStartTimeAMPM = '".$EventStartTimeAMPM."', Location = '".$EventLocation."', Description = '".$EventDescription."', Media1 = ".$Media1.", Media2 = ".$Media2.", Media3 = ".$Media3." WHERE ID = '".$EventID."'";
   if (mysqli_query($link, $sql)) 
   {
      $message = 'Event edited.';
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
      <form action="editEvent.php" method="post">
         <input type="hidden" name="EventID" value="<?php echo $EventID;?>"/>
         <input type="submit" value="Return"/>
      </form>
   </p>
   
</html>