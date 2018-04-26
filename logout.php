<?php
   //start the session so we have access to global variables
   session_start();
   
   //Log
   //Add Event to log
   $file = 'Log/userAccess.log';
   
   date_default_timezone_set("America/Denver");
   $currDate=date("Y-m-d h:i:sa");
   $ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
   $line='User (ID:'.$_SESSION['userID'].', User Name:'.$_SESSION['LoginID'].') Logged Out on '.$currDate.' from '.$ip.PHP_EOL;
   file_put_contents($file,$line,FILE_APPEND | LOCK_EX);


   //unset all global variables
   session_unset();

   //destroy current session
   session_destroy();

   //redirect browser to index.php
   echo ("<script>
       window.location.assign('index');
       </script>");
?>
