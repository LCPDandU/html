<?php
include("../config.php");
//include("../header.php");

/****************************************************************
 * Update the database with the edited info from the user.      *
 * The header doesn't change unless the user logs out and logs  *
 * back in.                                                     *
 ****************************************************************/
if(strlen($_POST['NewPassword']) < 7)
{
  $message_error = 'Password length must be greater than 7 characters';
}

//check if new password and confirm new password match
elseif($_POST['NewPassword'] != $_POST['ConfirmNewPassword']) 
{
  $message_error = 'New password and confirm new Password do not match';
}  
else
{
  $id = $_POST['ID'];
  $loginid = $_POST['LoginID'];
  $name = filter_var($_POST['Name'], FILTER_SANITIZE_STRING);
  $accountStatus = filter_var($_POST['AccountStatus'], FILTER_SANITIZE_STRING);
  $newPassword = filter_var($_POST['NewPassword'], FILTER_SANITIZE_STRING); 
  $confirmNewPassword = filter_var($_POST['ConfirmNewPassword'], FILTER_SANITIZE_STRING);
  
  //hash password
  $PasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

  $url = URL_START . "/public/api/users/id/".$id;

  //open the file generated by the REST API
  $handle=fopen($url,"r");
  if($handle){
    $userInfoOld=fgets($handle);
   
    //If no password was specified, then password is not updated, and is instead made to be the same passowrd it was before.
    foreach(json_decode($userInfoOld,true) as $row){
      if(empty($newPassword) && empty($confirmNewPassword))$PasswordHash=$_POST['Password'];
    }
   
    fclose($handle);
  }
  else{
    echo "error reading file (".$url.")";
  }

  //Determine REST url
  // REST url
  $url = URL_START . "/public/api/users/edit/id/".$id;

  // Store session token in variable.
  $token = $_SESSION['token'];

  // Need to initiate curl
  $ch = curl_init($url . '?authorization=' . $token);

  // Create array for json data.
  //Bind user input to request object
  $jsonData = array(
    'ID' => $id,
    'Name' => $name,
    'LoginID' => $loginid,
    'AccountStatus' => $accountStatus,
    'Password' => $PasswordHash
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
  $file = '../Log/accountManagementMyAccountInfo.log';

  //REST url
  //Here we pull the newest Event, which is the one that was just created.
  $url = URL_START . "/public/api/users/id/".$id;//URL_START . "/public/api/users/id/".$id;

  //open the file generated by the REST API
  $handle=fopen($url,"r");
  if($handle){
    $userInfoNew=fgets($handle);
    date_default_timezone_set("America/Denver");
    $currDate=date("Y-m-d h:i:sa");
    $ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
    $line='User (ID:'.$_SESSION['userID'].', User Name:'.$_SESSION['LoginID'].') on '.$currDate.' from '.$ip.' Edited From: '.$userInfoOld.' To: '.$userInfoNew.PHP_EOL;
    file_put_contents($file,$line,FILE_APPEND | LOCK_EX);
    fclose($handle);
  }
  else{
    echo "error reading file (".$url.")";
  }
}


//below is the old way
//check if new password matches the current password
/*elseif($_POST['NewPassword'] == $_POST['Password'])
{
  $message_error = 'New password cannot be the same as current password';
}*/

/*else
{
  $id = $_POST['ID'];
  $name = filter_var($_POST['Name'], FILTER_SANITIZE_STRING);
  $newPassword = filter_var($_POST['NewPassword'], FILTER_SANITIZE_STRING);
  
  //hash password
  $PasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

  try
  { 
    $link = connectDB();
    //$sql = "UPDATE User SET Name = '".$name."', Password = '".$newPassword."' WHERE ID = '".$id."'";
    $sql = "UPDATE User SET Name = '".$name."', Password = '".$PasswordHash."' WHERE ID = '".$id."'";
    $result = mysqli_query($link,$sql);
    if($result)
    {
      $message = 'Account updated.';
    }
    else
    {
      echo "<br>Error: " . $sql . "<br>" . mysqli_error($link);
    }
  }
  catch(exception $e)
  {
    $message_error = 'Unable to procces request';
  }
}*/

?>

<html>

   <p>
      <?php
      if(!$result)
      {
        echo $message_error; ?>
      <form action="accountManagementMyAccountInfo" method="post">
         <input type="hidden" name="ID" value="<?php echo $id;?>"/>
         <input type="submit" value="Return"/>
      </form>
      
      <?php } ?>
      
      <?php
      if($result)
      {
          echo $message;
          echo '<br> Please logout and log back in for changes to take effect.';
      ?>

      <form action="index" method="post">
        <input type="hidden" name="ID" value="<?php echo $id;?>"/>
        <input type="submit" value="Logout"/>
      </form>
      
      <?php } ?>

   </p>

</html>
