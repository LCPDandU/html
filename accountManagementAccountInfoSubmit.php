<?php
include("config.php");
include("header.php");

/********************************************
 * Update the database with the edited info *
 * from the user.                           *
 ********************************************/
$id = $_POST['ID'];
$accountStatus = filter_var($_POST['AccountStatus'], FILTER_SANITIZE_STRING);

try
{
  $link = connectDB();
  $sql = "UPDATE User SET AccountStatus = '".$accountStatus."' WHERE ID = '".$id."'";

  if($result=mysqli_query($link,$sql))
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
  $message = 'Unable to process request.';
}

?>

<html>
  <p>
    <?php echo $message; ?>
    <form action="accountManagementAccountInfo" method="post">
      <input type="hidden" name="ID" value="<?php echo $id; ?>"/>
      <input type="submit" value="Return"/>
    </form>
  </p>
</html>
