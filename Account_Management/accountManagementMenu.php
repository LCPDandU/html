<?php
include ('../header.php');
include('../config.php');

/**************************************************************************
 * Shows the account management menu.                                     *
 * AccountStatus == Standard: Manage my account appears                   *
 * AccountStatus == Admin: Manage my account and Manage Accounts appears  *
 **************************************************************************/
try
{
  $link = connectDB();
  $sql = "SELECT * FROM User WHERE LoginID = '".$_SESSION['LoginID']."';";

  if($result=mysqli_query($link,$sql))
  {
    while($row=mysqli_fetch_assoc($result))
    {
      $id = $_POST['ID'];
      $accountStatus = $row['AccountStatus'];
    }//end while
  }//end if
}
catch(exception $e)
{
  $message = 'Unable to process request';
}
?>

<html>

  <h1><strong>Management Menu</strong></h1>

  <form action="accountManagementMyAccountInfo" method="post">
  <fieldset>
    <p>
      <input type="submit" value="Manage my account" />
    </p>
  </fieldset>
  </form>

  <!--For admin access only (AccountStatus == admin)-->
  <form action="accountManagementListAccounts" method="post">

  <input type="hidden" name="ID" value="<?php echo $id; ?>"/>
  <input type="hidden" name="AccountStatus" value="<?php echo $accountStatus; ?>"/>

  <?php if($accountStatus == "Admin") { ?>
    <fieldset>
      <p>
        <input type="submit" value="Manage Accounts" />
      </p>
    </fieldset>
  <?php } ?>
  </form>

</html>
