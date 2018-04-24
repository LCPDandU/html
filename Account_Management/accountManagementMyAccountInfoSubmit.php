<?php
include("../config.php");
//include("../header.php");

/****************************************************************
 * Update the database with the edited info from the user.      *
 * The header doesn't change unless the user logs out and logs  *
 * back in.                                                     *
 ****************************************************************/
//if(strlen($_POST['NewPassword']) != 0){
//check length of new password
if(strlen($_POST['NewPassword']) < 7)
{
  $message_error = 'Password length must be greater than 7 characters';
}

//check if new password and confirm new password match
elseif($_POST['NewPassword'] != $_POST['ConfirmNewPassword'])
{
  $message_error = 'New password and confirm new Password do not match';
}

//check if new password matches the current password
/*elseif($_POST['NewPassword'] == $_POST['Password'])
{
  $message_error = 'New password cannot be the same as current password';
}*/

else
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
}
//}
/*else
{
  $message_error = 'Nothing was changed';
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
