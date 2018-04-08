<?php include('header.php');?>

<?php
   if(!isset( $_POST['val'] ))
   {
       $message = 'val is not set';
       echo ("<body><p>".$message."</p></body>");
   }
   if(isset($_POST['val']))
   {
      $message = 'val ='.$_POST['val'];
      echo ("<body><p>".$message."</p></body>");
   }
?>
<html>

<head>
<title></title>
</head>

<!--<body style = "Color: #000000; background-color:#afbfff;">-->
<body>
  <form action="searchTestpage.php" method="post">
      <input type="submit" value="Return"/>
  </form>
</body>

</html>