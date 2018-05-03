<?php 
//This page is a form that determines which search mode the user will go to.
include('../header.php');
?>
<html>

<head>
<title></title>
</head>

<!--<body style = "Color: #000000; background-color:#afbfff;">-->
<body>
  <form action="seeAllMenu.php" method="get">
      <input type="submit" value="See All Menu"/>
  </form>
  <form action="searchAttributeMenu.php" method="get">
      <input type="submit" value="Search By Attribute"/>
  </form>
  
  <!--<form action="searchTestpage.php" method="get">
      <input type="submit" value="View test input page"/>
      <i>(debug)</i>
  </form>-->
</body>

</html>