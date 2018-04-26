<?php 
//include('../header.php');
?>

<?php
   if(!isset( $_POST['val'] ))
   {
       $message = 'val is not set';
       echo ("<body><p>".$message."</p></body>");
   }
   if(isset($_POST['val']))
   {
      $message = 'val ="'.$_POST['val'].'"';
      echo ("<body><p>".$message."</p></body>");
   }
   
   $jsonA='[{"ID":"5","LoginID":"cscirone","Password":"U8theb8m80","Name":"CJ Scirone II","AccountStatus":"Admin","Token":"dddbe20879364c20975eca849ee3891e9b0855a4b23caa57dd1ba9c845b4e3217dc8e72f0f52cf0d004c27e9dd81eb3da120512a6fb3c4864d37386f4b686d0c"}]';  
   $jsonB='[]';
    
   echo "<body><p>jsonA=".$jsonA."</p></body>";
   
   $jsonAArr=json_decode($jsonA,true);
   echo '<body><p>';
   var_dump($jsonAArr);
   echo '</p></body>';
   
   //$jsonA_isset=isset($jsonAArr);
   //echo "<body><p>jsonA_isset=".$jsonA_isset."</p></body>";
   if(isset($jsonAArr)){echo "<body><p>jsonA is set</p></body>";}
   else{echo "<body><p>jsonA is not set</p></body>";}
   if(empty($jsonAArr)){echo "<body><p>jsonA is empty</p></body>";}
   else{echo "<body><p>jsonA is not empty</p></body>";}
   
   echo "<body><p>jsonB=".$jsonB."</p></body>";
   
   $jsonBArr=json_decode($jsonB,true);
   echo '<body><p>';
   var_dump($jsonBArr);
   echo '</p></body>';
   
    //$jsonABisset=isset($jsonBArr);
   //echo "<body><p>jsonB_isset=".$jsonB_isset."</p></body>";
   if(isset($jsonBArr)){echo "<body><p>jsonB is set</p></body>";}
   else{echo "<body><p>jsonB is not set</p></body>";}
   if(empty($jsonBArr)){echo "<body><p>jsonB is empty</p></body>";}
   else{echo "<body><p>jsonB is not empty</p></body>";}
   
   $url = "test local";
   $urlEncoded = urlencode($url);
   
   echo "<body><p>url=".$url."</p></body>";
   echo "<body><p>urlEncoded=".$urlEncoded."</p></body>";
   
   $text="first";
   $text.="/second";
   
   $cars=array("Volvo","BMW","Toyota");
   echo "I like " . $cars[0] . ", " . $cars[1] . " and " . $cars[2] . ".";
   
   echo "<body><p>text=".$text."</p></body>";
   
   if(password_verify('U8theb8m80', '$2y$10$Y.bmXynDH7uU4fD.Sn3kF.pYAPVzX4.qGroP3JU5u6x1.lyqbXn7q'))
   {
      echo 'password verified';
   }
   else{
      echo 'password not verified';
   }
   
   echo "<body><p>phpeol = ".ord(PHP_EOL)."</p></body>";
   
   $json='[{"ID":"5"}]';
   if(empty(json_decode($json,$true)))
      echo "<body><p>json is empty</p></body>";
   else
      echo "<body><p>json is not empty</p></body>";
   
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