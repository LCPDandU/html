<?php
include ('../header.php');
include('../config.php');

/***************************************************************
 * Outputs the selected account that the admin chose to edit.  *
 * The only variable that can be edited is the account status. * 
 * The id, name, and login id are read only.                   *
 ***************************************************************/
try
{
  $link = connectDB();
  $sql = "SELECT * FROM User WHERE ID=".$_POST['ID'].";";
  
  if($result=mysqli_query($link,$sql))
  {
    while($row = mysqli_fetch_assoc($result))
    {
      $id = $_POST['ID'];
      $name = $row['Name'];
      $loginid = $row['LoginID'];
      $accountStatus = $row['AccountStatus'];
    }//end while
  }//end if
}//end try
catch(Exception $e)
{
  $message = 'Unable to process request';
}
?>

<html>

<form action="accountManagementAccountInfoSubmit" method="post">
  <fieldset>
  
    <h1><strong>Manage Account Info</strong></h1>
    
    <p>
    <label>ID</label>
    <input readonly="readonly" name="ID" value="<?php echo $id; ?>"/>
    </p>
    
    <p>
      <label>Name</label>
      <input readonly="readonly" name="name" value="<?php echo $name; ?>"/>
    </p>
    
    <p>
      <label>LoginID</label>
      <input readonly="readonly" name="loginid" value="<?php echo $loginid; ?>"/>
    </p>
    
    <p>
      <label>Account Status</label>
      
      <?php if($accountStatus == "Pending") { ?>
        <select name="AccountStatus">
          <option value="Pending"selected>Pending</option>
          <option value="Standard">Standard</option>
          <option value="Admin">Admin</option>
        </select>
      <?php } ?>
      
      <?php if($accountStatus == "Standard") { ?>
        <select name="AccountStatus">
          <option value="Pending">Pending</option>
          <option value="Standard" selected>Standard</option>
          <option value="Admin">Admin</option>
        </select>
      <?php } ?>
      
      <?php if($accountStatus == "Admin") { ?>
        <select name="AccountStatus">
          <option value="Pending">Pending</option>
          <option value="Standard">Standard</option>
          <option value="Admin" selected>Admin</option>
        </select> 
      <?php } ?>
      
    </p>
    
    <p>
      <input type="submit" value="Edit Account"/>
    </p>
  </fieldset>
</form>

<form action="accountManagementListAccounts" method="post">
  <input type="submit" value="Back"/>
</form>
  <body>
    <p><?php echo $message; ?></p>
  </body>
  
</html>
