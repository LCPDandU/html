<?php include('../header.php');?>
<?php

echo '<form action="searchResultsNotificationMultipleAttributes.php" method="post">';
echo '<fieldset>';

if($_POST['NotificationTitleOption']!="None")
{
   //echo "<p>NotificationTitleOption=".$_POST['NotificationTitleOption']."</p>";
   if($_POST['NotificationTitleOption']=="NotificationTitleExact")
   {
      echo '<p><label>Title </label><input type="text" name="NotificationTitleExact" value="" maxlength="128" required/><i>(maximum of 128 characters)</i></p>';
   }
   if($_POST['NotificationTitleOption']=="NotificationTitleLike")
   {
      echo '<p><label>Title </label><input type="text" name="NotificationTitleLike" value="" maxlength="128" required/><i>(maximum of 128 characters)</i></p>';
   }
}
if($_POST['NotificationDescriptionOption']!="None")
{
   //echo "<p>NotificationDescriptionOption=".$_POST['NotificationDescriptionOption']."</p>";
   if($_POST['NotificationDescriptionOption']=="NotificationDescriptionLike")
   {
      echo '<p><label>Description </label><textarea name="NotificationDescriptionLike" maxlength="4096" rows="10" cols="45" required> </textarea><i>(maximum of 4096 characters)</i></p>';
   }
}
if($_POST['NotificationDateOption']!="None")
{
   //echo "<p>NotificationDateOption=".$_POST['NotificationDateOption']."</p>";
   if($_POST['NotificationDateOption']=="NotificationDateExact")
   {
      echo '<p><label>Post Date </label><input type="date" name="NotificationDateExact" value="" required/><i>(enter date in YYYY-MM-DD form if typing manually)</i></p>';
   }
   if($_POST['NotificationDateOption']=="NotificationDateRange")
   {
      echo '<p><label>Post Dates From </label><input type="date" name="NotificationDateA" value="" required/>'.
           '<label>   To </label><input type="date" name="NotificationDateB" value="" required/><i>(enter date in YYYY-MM-DD form if typing manually)</i></p>';
   }
   if($_POST['NotificationDateOption']=="NotificationDateBefAft")
   {
      echo '<p><label>Post Date </label><input type="date" name="NotificationDateBefAft" value="" required/><i>(enter date in YYYY-MM-DD form if typing manually)</i></p>'.
           '<p><label>Before-After </label><input type="radio" name="BefAftNotificationDate" value="Before" checked/><label>Before</label><input type="radio" name="BefAftNotificationDate" value="After"/><label>After</label></p>';
   }
}
if($_POST['NotificationPostTimeOption']!="None")
{
   //echo "<p>NotificationPostTimeOption=".$_POST['NotificationPostTimeOption']."</p>";
   if($_POST['NotificationPostTimeOption']=="NotificationPostTimeExact")
   {
      echo '<p><label>Post Time </label>'.
           '<input type="number" name="NotificationPostTimeHourExact" min="1" max="12" required/> : <input type="number" name="NotificationPostTimeMinuteExact" min="0" max="59" required/>'.
           '<select name="NotificationPostTimeAMPMExact"><option value="AM" selected>AM</option><option value="PM">PM</option></select>'.
           '<i>(First field is hour, Second is minute)</i></p>';
   }
   if($_POST['NotificationPostTimeOption']=="NotificationPostTimeBefAft")
   {
      echo '<p><label>Post Time </label>'.
           '<input type="number" name="NotificationPostTimeHourBefAft" min="1" max="12" required/> : <input type="number" name="NotificationPostTimeMinuteBefAft" min="0" max="59" required/>'.
           '<select name="NotificationPostTimeAMPMBefAft"><option value="AM" selected>AM</option><option value="PM">PM</option></select>'.
           '<i>(First field is hour, Second is minute)</i></p>'.
           '<p><label>Before-After </label><input type="radio" name="BefAftNotificationPostTime" value="Before" checked/><label>Before</label><input type="radio" name="BefAftNotificationPostTime" value="After"/><label>After</label></p>';
   }
}

echo '<p><label>Order By </label><select name="Sorting"><option value="ID" selected>ID</option><option value="Title">Title</option><option value="Description">Description</option><option value="PostDate">PostDate</option><option value="PostTime">PostTime</option><option value="PostTimeAMPM">PostTimeAMPM</option></select></p>';
echo '<p><label>Sorting </label><input type="radio" name="Ordering" value="ASC"/><label>Ascending</label><input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label></p>';

echo '<p><input type="submit" value="Search"/></p>';

echo '</fieldset>';
echo '</form>';

?>



<html>

<head>
<title></title>
</head>

<!--<body style = "Color: #000000; background-color:#afbfff;">-->
<body>
  <form action="searchAttributeMenu.php" method="post">
      <input type="submit" value="Back"/>
  </form>
</body>

</html>