<?php

include("../config.php");
include("../header.php");

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
$target_media1 = "../media/".basename($_FILES['media1']['name']);
$target_media2 = "../media2/".basename($_FILES['media2']['name']);
$target_media3 = "../media3/".basename($_FILES['media3']['name']);
  
//move media file to the media folder
move_uploaded_file($_FILES['media1']['tmp_name'], $target_media1);
move_uploaded_file($_FILES['media2']['tmp_name'], $target_media2);
move_uploaded_file($_FILES['media3']['tmp_name'], $target_media3);
    
//get selected media info
$Media1 = $_FILES['media1']['name'];
$Media2 = $_FILES['media2']['name'];
$Media3 = $_FILES['media3']['name'];


//User input is scanned for undersierable characters. This is done to prevent SQL injection
$userInput = array(
   $EventTitle,
   $EventCategory,
   $EventDate,
   $EventStartTimeHour,
   $EventStartTimeMinute,
   $EventStartTimeAMPM,
   $EventLocation,
   $EventDescription
);
$inputCount=0;
foreach($userInput as $string)
{
   $evaluate=containsSpecialChar($string);
   if($evaluate['contains']==true)
   {
      if(inputCount==0)echo '<body><p>Your input contains special characters, please go back and remove the characters listed below from your input.</p></body>';
      echo '<body><p>"'.$string.'" contains the following special characters: ['.$evaluate['charList'].']</p></body>';
      $inputCount=$inputCount+1;
   }
}

if($inputCount>0)
{
   die();
}


/*********************************************
POST TO DATABASE VIA REST
*********************************************/

// REST url
$url = URL_START . '/public/api/events/add';

// Store session token in variable.
$token = $_SESSION['token'];

// Need to initiate curl
$ch = curl_init($url . '?authorization=' . $token);

// Create array for json data.
//Bind user input to request object
$jsonData = array(
    'EventTitle' => $EventTitle,
    'EventCategory' => $EventCategory,
    'EventDate' => $EventDate,
    'EventStartTime' => $EventStartTime,
    'EventStartTimeAMPM' => $EventStartTimeAMPM,
    'EventLocation' => $EventLocation,
    'EventDescription' => $EventDescription,
    'EventMedia1' => $Media1,
    'EventMedia2' => $Media2,
    'EventMedia3' => $Media3
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


//Add Event to log
$file = '../Log/createEvent.log';

//REST url
//Here we pull the newest Event, which is the one that was just created.
$url = URL_START . '/public/api/events/newest';



//open the file generated by the REST API
$handle=fopen($url,"r");
if($handle){
   $eventInfo=fgets($handle);
   date_default_timezone_set("America/Denver");
   $currDate=date("Y-m-d h:i:sa");
   $ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
   $line='User (ID:'.$_SESSION['userID'].', User Name:'.$_SESSION['LoginID'].') on '.$currDate.' from '.$ip.' Created: '.$eventInfo.PHP_EOL;
   file_put_contents($file,$line,FILE_APPEND | LOCK_EX);
   fclose($handle);
}
else{
   echo "error reading file (".$url.")";
}




//Below is the original method of posting
/*try
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
}*/   

?>

<html>

   <p>
      <?php echo $message;?>
      <form action="createMenu" method="post"><input type="submit" value="Return"/></form>
   </p>

</html>
