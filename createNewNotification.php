<?php

include("config.php");
include("header.php");

/*********************************************
POST TO DATABASE VIA REST
*********************************************/

// REST url
$url = 'http://localhost/public/api/notifications/add';

// Need to initiate curl
$ch = curl_init($url);

// Create array for json data.
$jsonData = array(
    'NotificationTitle' => $_POST['NotificationTitle'],
    'NotificationDescription' => $_POST['NotificationDescription'],
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


/*********************************************
PUSH NOTIFICATION FOR ANNOUNCEMENT
*********************************************/
// Will only send post notification if admin denoted 'Yes' on createMenu.php.
if ($_POST['PushNotificationOption'] == 1) {

  // Need to define API key. Can generate new key for public release.
    define( 'API_ACCESS_KEY', 'AAAAsNgqZHk:APA91bEFw_2VkH7teZR-vxEF97cjPm80w_rw7sf45Tjlfcx04LPUATBG157NF2LL4_xrX7XtFzpGCVvn25nyTIa-nJFvh6tuNB7pn4cu0CASni83ZverF_9O-lwPV4n33jAqeU0jD9kO' );

    // Message contents will contain notification title and description.
    $fcmMsg = array(
    	'body' => $_POST['NotificationDescription'],
    	'title' => $_POST['NotificationTitle'],
    );

    // Send notification to the 'news' topic, which is the only and default topic for this app.
    $fcmFields = array(
    	'to' => '/topics/news',
            'priority' => 'high',
    	'notification' => $fcmMsg
    );

    // Send headers for json file with key.
    $headers = array(
    	'Authorization: key=' . API_ACCESS_KEY,
    	'Content-Type: application/json'
    );

    // Curl code to send json details to Google's FCM cloud API.
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
    $result = curl_exec($ch );
    curl_close( $ch );
    echo $result . "\n\n";

} // End if statement for checking if notification should be sent.

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
