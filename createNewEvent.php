<?php

include("config.php");
include("header.php");

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

//target folder
$target_media1 = "media/".basename($_FILES['media1']['name']);
$target_media2 = "media2/".basename($_FILES['media2']['name']);
$target_media3 = "media3/".basename($_FILES['media3']['name']);
  
//move media file to the media folder
move_uploaded_file($_FILES['media1']['tmp_name'], $target_media1);
move_uploaded_file($_FILES['media2']['tmp_name'], $target_media2);
move_uploaded_file($_FILES['media3']['tmp_name'], $target_media3);
    
//get selected media info
$Media1 = $_FILES['media1']['name'];
$Media2 = $_FILES['media2']['name'];
$Media3 = $_FILES['media3']['name'];

try
{
  //Connect to CRUD Database  mysqli(Server,User,Password,Database)
  $link = connectDB();

  $sql = "INSERT INTO CalendarEvent VALUES (null,'".$EventTitle."','".$EventCategory."','".$EventDate."','".$EventStartTime."','".$EventStartTimeAMPM."','".$EventLocation."','".$EventDescription."','".$Media1."','".$Media2."','".$Media3."')";
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
      <form action="createMenu" method="post"><input type="submit" value="Return"/></form>
   </p>

</html>
