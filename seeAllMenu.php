<?php include('header.php');?>
<html>

<head>
<title></title>
</head>

<!--<body style = "Color: #000000; background-color:#afbfff;">-->
<body>
  <h2>List Format</h2>
  <form action="seeAllEventsList.php" method="post">
      <input type="submit" value="See All Events"/>
  </form>
  <form action="seeAllNotificationsList.php" method="post">
      <input type="submit" value="See All Notifications"/>
  </form>
  <h2>Calendar Format</h2>
  <form action="seeAllEventsCalendar.php" method="post">
      <input type="submit" value="See All Events"/>
      <i>(not implemented yet)</i>
  </form>
  <form action="seeAllNotificationsCalendar.php" method="post">
      <input type="submit" value="See All Notifications"/>
      <i>(not implemented yet)</i>
  </form>
</body>

</html>