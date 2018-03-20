<?php include('header.php');?>
<html>

<head>
<title></title>
</head>

<!--<body style = "Color: #000000; background-color:#afbfff;">-->
<body>
  <h2>List Format</h2>
  <form action="seeAllEventsList" method="post">
      <input type="submit" value="See All Events"/>
  </form>
  <form action="seeAllNotificationsList" method="post">
      <input type="submit" value="See All Notifications"/>
  </form>
  <h2>Calendar Format</h2>
  <form action="seeAllEventsCalendar" method="post">
      <input type="submit" value="See All Events"/>
      <i>(not implemented yet)</i>
  </form>
  <form action="seeAllNotificationsCalendar" method="post">
      <input type="submit" value="See All Notifications"/>
      <i>(not implemented yet)</i>
  </form>
</body>

</html>
