<?php
   //start the session so we have access to global variables
   session_start();
   
   //unset all global variables
   session_unset();
   
   //destroy current session
   session_destroy();
   
   //redirect browser to index.php
   echo ("<script>
       window.location.assign('index.php');
       </script>");
?>