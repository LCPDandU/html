<?php

// Allow creation of db object.
require 'src/db.php';

//to connect to the database we do this
include('config.php');

//start the session so we can set global variables
session_start();

// Check if the user is already logged in
if(isset( $_SESSION['userID'] ))
{
    $message = 'User is already logged in';
}

// Check that LoginID and password are populated
if(!isset( $_POST['LoginID'], $_POST['Password']))
{
    $message = 'Please enter a valid LoginID and password';
}

// Check LoginID length
elseif (strlen( $_POST['LoginID']) > 32 || strlen($_POST['LoginID']) < 4)
{
    $message = 'Incorrect Length for LoginID';
}

// Check password length
elseif (strlen( $_POST['Password']) > 32 || strlen($_POST['Password']) < 7)
{
    $message = 'Incorrect Length for Password';
}

else{
   $LoginID = filter_var($_POST['LoginID'], FILTER_SANITIZE_STRING);
   $Password = filter_var($_POST['Password'], FILTER_SANITIZE_STRING);

   // REST command url. http://localhost works for both a localhost
   //  and when hosted on the server.
   $url="http://localhost/public/api/users/login/LoginID/$LoginID/Password/$Password";

   // Need to read the file created by the REST command.
   $handle=fopen($url,"r");
   // Only enter if handle variable was successfully created.
   if($handle){
      // Only enter if current line contains data.
      if(($line=fgets($handle))!==false){
         // Decode json response. If it is empty then login has failed.
         $arr=json_decode($line,true);
         // Output error if empty.
         if(empty($arr)){
            $message="Login Failed";
         }
         //If login hasn't failed, then global variables are set, a token is generated and assigned to the User
         else foreach($arr as $row){
               $userID = $row['ID'];
               $userLoginID = $row['LoginID'];
               $userName = $row['Name'];

               // Set the session userID, LoginID, and Name.
               $_SESSION['userID'] = $userID;
               $_SESSION['LoginID'] = $userLoginID;
               $_SESSION['Name'] = $userName;

               // Success message.
               $message = 'You are now logged in';

               // Generate key for this login session.
               $token = bin2hex(random_bytes(64));
               $_SESSION['token'] = $token;

               // Need to generate timestamp to allow token to expire.

               // Update the database by assigning the generated token to the current user.
               $sql = "UPDATE User SET Token = :Token WHERE LoginID = :LoginID";

               // Use prepare, bindParam, and PDO statements to more securely
               //  add the new token to the database.
               try{
                 // Get DB object
                 $configDB = parse_ini_file('./db.ini');
                 $db = new db($configDB['DB_HOST'],$configDB['DB_USER'],$configDB['DB_PWD'],$configDB['DB_NAME']);
                 // Call connect; connect to database.
                 $db = $db->connect();

                 // PHP Data Objects (PDO) statements.
                 $stmt = $db->prepare($sql);

                 // Bind variables and parameters.
                 $stmt->bindParam(':LoginID', $userLoginID);
                 $stmt->bindParam(':Token', $token);

                 // Execute the SQL statement.
                 $stmt->execute();
                 echo '{"notice": {"text": "Token Added"}';

               }//end try
               catch(PDOException $e){
                 echo '{"error": {"text": '.$e->getMessage().'}';
               }//end catch

               echo ("<script>
                  window.location.assign('home');
                  </script>");

               exit();
         }//end foreach
      }//end if
   }//end if
}//end else

?>

<html>
    <head>
    <title>LoginSubmit</title>
    </head>

    <body>
    <p><?php echo $message; ?>
    </body>

    <form action="index.php" method="Post">
      <input type="submit" value="Submit"/>
    </form>
</html>
