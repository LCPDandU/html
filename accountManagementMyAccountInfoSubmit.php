<?php
include("config.php");
//include("header.php");

/****************************************************************
 * Update the database with the edited info from the user.      *
 * The header doesn't change unless the user logs out and logs  *
 * back in.                                                     *
 ****************************************************************/
$id = $_POST['ID'];
$name = filter_var($_POST['Name'], FILTER_SANITIZE_STRING);

try
{
  $link = connectDB();
  $sql = "UPDATE User SET Name = '".$name."' WHERE ID = '".$id."'";
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
  $message = 'Unable to procces request';
}
?>

<html>

   <p>
      <?php
        echo $message;
        echo '<br> Please logout and log back in for changes to take effect.';
      ?>
      <!--   <form action="accountManagementMyAccountInfo" method="post">
         <input type="hidden" name="ID" value="<?php //echo $id;?>"/>
         <input type="submit" value="Return"/>
      </form> -->
      <form action="index" method="post">
        <input type="hidden" name="ID" value="<?php echo $id;?>"/>
        <input type="submit" value="Logout"/>
      </form>
   </p>

</html>
