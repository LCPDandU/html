<?php

include("../config.php");
include("../header.php");

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

//target directory
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
    
  //$sql = "UPDATE CalendarEvent SET Title = '".$EventTitle."', Category = '".$EventCategory."', EventDate = '".$EventDate."', EventStartTime = '".$EventStartTime."', EventStartTimeAMPM = '".$EventStartTimeAMPM."', Location = '".$EventLocation."', Description = '".$EventDescription."', Media1 = '".$Media1."', Media2 = '".$Media2."', Media3 = '".$Media3."' WHERE ID = '".$EventID."'";
  
  if(!empty($Media1))//media1 is not empty run query to upload media into media1 slot
  {
    $sql = "UPDATE CalendarEvent SET Title = '".$EventTitle."', Category = '".$EventCategory."', EventDate = '".$EventDate."', EventStartTime = '".$EventStartTime."', EventStartTimeAMPM = '".$EventStartTimeAMPM."', Location = '".$EventLocation."', Description = '".$EventDescription."', Media1 = '".$Media1."' WHERE ID = '".$EventID."'";
  }
  else if(!empty($Media2))//media2 is not empty run query to upload media into media2 slot
  {
    $sql = "UPDATE CalendarEvent SET Title = '".$EventTitle."', Category = '".$EventCategory."', EventDate = '".$EventDate."', EventStartTime = '".$EventStartTime."', EventStartTimeAMPM = '".$EventStartTimeAMPM."', Location = '".$EventLocation."', Description = '".$EventDescription."', Media2 = '".$Media2."' WHERE ID = '".$EventID."'";
  }
  else if(!empty($Media3))//media3 is not empty run query to upload media into media3 slot
  {
    $sql = "UPDATE CalendarEvent SET Title = '".$EventTitle."', Category = '".$EventCategory."', EventDate = '".$EventDate."', EventStartTime = '".$EventStartTime."', EventStartTimeAMPM = '".$EventStartTimeAMPM."', Location = '".$EventLocation."', Description = '".$EventDescription."', Media3 = '".$Media3."' WHERE ID = '".$EventID."'";
  }
  else//updates all feilds except media1, media2, and media3
  {
    $sql = "UPDATE CalendarEvent SET Title = '".$EventTitle."', Category = '".$EventCategory."', EventDate = '".$EventDate."', EventStartTime = '".$EventStartTime."', EventStartTimeAMPM = '".$EventStartTimeAMPM."', Location = '".$EventLocation."', Description = '".$EventDescription."' WHERE ID = '".$EventID."'";
  }
  
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
      <form action="editEvent" method="post">
         <input type="hidden" name="EventID" value="<?php echo $EventID;?>"/>
         <input type="submit" value="Return"/>
      </form>
   </p>

</html>
