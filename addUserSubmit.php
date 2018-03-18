<?php

//to connect to the database we do this
include('config.php');

//start the session so we can set global variables
//session_start();

$valid_form = true;
//check that Name, LoginID, and password are populated
if(empty( $_POST['Name']))
{
    $message = 'All fields are required';
    $valid_form = false;
}

if(empty($_POST['LoginID']))
{
    $message = 'All fields are required';
    $valid_form = false;
}

if(empty($_POST['Password']))
{
    $message = 'All fields are required';
    $valid_form = false;
} 

//Check LoginId length
else if (strlen($_POST['LoginID']) > 32 || strlen($_POST['LoginID']) < 4)
{
    $message = 'LoginID length must be greater than 4 characters';
}

//check password length
else if (strlen($_POST['Password']) > 32 || strlen($_POST['Password']) < 7)
{
    $message = 'Password length must be greater than 7 characters';
}

//Store Name, LoginID, and Passwords as variables
$Name = filter_var($_POST['Name'], FILTER_SANITIZE_STRING);
$LoginID = filter_var($_POST['LoginID'], FILTER_SANITIZE_STRING);
$Password = filter_var($_POST['Password'], FILTER_SANITIZE_STRING);
    
if($valid_form){
    //Connect to MYSQL Database mysqli(Server,User, Password,Database)
    $link = connectDB();
        
    $sql = "SELECT LoginID FROM User WHERE LoginID =  '".$LoginID."';";
        
    $result=mysqli_query($link,$sql);
        
    if(mysqli_num_rows($result) > 0) //if login id is already taken
    { 
      $message = 'login id already taken';
    }
          
    else //insert if its a new login id
    {
      $sql = "INSERT INTO User VALUES (null, '".$LoginID."', '".$Password."', '".$Name."', 'Pending')";
          
      $result=mysqli_query($link,$sql);
          
      if(!$result)
      {
        $message = 'Query Failed';
      }
            
      if(mysqli_affected_rows($link) == 1) //if the insertion was successfull
      {
        $message = 'Thank you, your account is waiting for approval.';
      }
    }
}

?>


<html>
    <head>
    <title>AddUserSubmit</title>
    </head>
    
    <body>
    <p></p><?php echo $message; ?>
    <form action="index.php" method="post">
      <input type="submit" value="Return"/>
    </form>
    </body>
</html>