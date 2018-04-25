<?php

// Allow creation of db object.
require 'src/db.php';

//to connect to the database we do this
include('config.php');

//start the session so we can set global variables
//session_start();

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

else
{
    // Store LoginID and Passwords as variables
    $LoginID = filter_var($_POST['LoginID'], FILTER_SANITIZE_STRING);
    $Password = filter_var($_POST['Password'], FILTER_SANITIZE_STRING);

    try
    {
         //Connect to MySQL Database  mysqli(Server,User,Password,Database)
        $link = connectDB();


        // Prep SQL statement which will compare the user credentials with what is stored in the database
        $sql = "SELECT * FROM User WHERE LoginID = '".$LoginID."' AND AccountStatus != 'Pending'";//AND Password = '".$Password."'";
        //echo $sql."<br>";

        //Run the query
        if($result=mysqli_query($link,$sql))
        {
          //give values to session variables
          while($row = mysqli_fetch_assoc($result)) {

            //verify the password with the hash password
            if(password_verify($Password, $row['Password']))
            {
              $userID = $row['ID'];
              $userLoginID = $row['LoginID'];
              $userName = $row['Name'];

              // Set the session userID, LoginID, and Name
              $_SESSION['userID'] = $userID;
              $_SESSION['LoginID'] = $userLoginID;
              $_SESSION['Name'] = $userName;

              $message = 'You are now logged in';

              // Generate key for this Login
              $token = bin2hex(random_bytes(64));
              $_SESSION['token'] = $token;

              // Generate timestamp
              $timestamp = date("Y-m-d H:i:s");

              $sql = "UPDATE User SET Token = :Token, TokenStamp = :TokenStamp WHERE LoginID = :LoginID";

              try{
                // Get DB object
                $configDB = parse_ini_file('./db.ini');
                $db = new db($configDB['DB_HOST'],$configDB['DB_USER'],$configDB['DB_PWD'],$configDB['DB_NAME']);
                // Call connect; connect to database.
                $db = $db->connect();

                # PDO statement
                $stmt = $db->prepare($sql);

                $stmt->bindParam(':LoginID', $userLoginID);
                $stmt->bindParam(':Token', $token);
                $stmt->bindParam(':TokenStamp', $timestamp);

                $stmt->execute();
                echo '{"notice": {"text": "Token Added"}';

              }
              catch(PDOException $e){
                echo '{"error": {"text": '.$e->getMessage().'}';
              }

              echo ("<script>
                       window.location.assign('home');
                     </script>");

              exit();

            }//end password verify
            else
            {
              $message = 'Invalid password';
            }

          }//end while
        }
        if($userID == false) {
            $message = 'Login Failed';
        }
    }
    catch(Exception $e)
    {
        $message = 'Unable to process request';
    }
}

?>

<html>
    <head>
    <title>LoginSubmit</title>
    </head>

    <body>
    <p><?php echo $message; ?>
    </body>
</html>
