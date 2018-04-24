<?php include('../header.php');?>
<?php

echo '<form action="searchResultsEventMultipleAttributes.php" method="post">';
echo '<fieldset>';

if($_POST['EventTitleOption']!="None")
{
   //echo "<p>EventTitleOption=".$_POST['EventTitleOption']."</p>";
   if($_POST['EventTitleOption']=="EventTitleExact")
   {
      echo '<p><label>Title </label><input type="text" name="EventTitleExact" value="" maxlength="128" required/><i>(maximum of 128 characters)</i></p>';
   }
   if($_POST['EventTitleOption']=="EventTitleLike")
   {
      echo '<p><label> Title </label><input type="text" name="EventTitleLike" value="" maxlength="128" required/><i>(maximum of 128 characters)</i></p>';
   }
}
if($_POST['EventCategoryOption']!="None")
{
   //echo "<p>EventCategoryOption=".$_POST['EventCategoryOption']."</p>";
   if($_POST['EventCategoryOption']=="EventCategoryExact")
   {
      echo '<p><label>Category </label><select name="EventCategory"><option value="LCPD" selected>LCPD</option><option value="LCFD">LCFD</option><option value="AnimalControl">Animal Control</option><option value="Public">Public</option></select></p>';
   }
}
if($_POST['EventDateOption']!="None")
{
   //echo "<p>EventDateOption=".$_POST['EventDateOption']."</p>";
   if($_POST['EventDateOption']=="EventDateExact")
   {
      echo '<p><label>Event Date </label><input type="date" name="EventDateExact" value="" required/><i>(enter date in YYYY-MM-DD form if typing manually)</i></p>';
   }
   if($_POST['EventDateOption']=="EventDateRange")
   {
      echo '<p><label>From </label><input type="date" name="EventDateA" value="" required/>'.
           '<label>   To </label><input type="date" name="EventDateB" value="" required/><i>(enter date in YYYY-MM-DD form if typing manually)</i></p>';
   }
   if($_POST['EventDateOption']=="EventDateBefAft")
   {
      echo '<p><label>Event Date </label><input type="date" name="EventDateBefAft" value="" required/><i>(enter date in YYYY-MM-DD form if typing manually)</i></p>'.
           '<p><label>Before-After </label><input type="radio" name="BefAftEventDate" value="Before" checked/><label>Before</label><input type="radio" name="BefAftEventDate" value="After"/><label>After</label></p>';
   }
}
if($_POST['EventStartTimeOption']!="None")
{
   //echo "<p>EventStartTimeOption=".$_POST['EventStartTimeOption']."</p>";
   if($_POST['EventStartTimeOption']=="EventStartTimeExact")
   {
      echo '<p><label>Event Start Time </label>'.
           '<input type="number" name="EventStartTimeHourExact" min="1" max="12" required/> : <input type="number" name="EventStartTimeMinuteExact" min="0" max="59" required/>'.
           '<select name="EventStartTimeAMPMExact"><option value="AM" selected>AM</option><option value="PM">PM</option></select>'.
           '<i>(First field is hour, Second is minute)</i></p>';
   }
   if($_POST['EventStartTimeOption']=="EventStartTimeBefAft")
   {
      echo '<p><label>Event Start Time </label>'.
           '<input type="number" name="EventStartTimeHourBefAft" min="1" max="12" required/> : <input type="number" name="EventStartTimeMinuteBefAft" min="0" max="59" required/>'.
           '<select name="EventStartTimeAMPMBefAft"><option value="AM" selected>AM</option><option value="PM">PM</option></select>'.
           '<i>(First field is hour, Second is minute)</i></p>'.
           '<p><label>Before-After </label><input type="radio" name="BefAftEventStartTime" value="Before" checked/><label>Before</label><input type="radio" name="BefAftEventStartTime" value="After"/><label>After</label></p>';
   }
}
if($_POST['EventLocationOption']!="None")
{
   //echo "<p>EventLocationOption=".$_POST['EventLocationOption']."</p>";
   if($_POST['EventLocationOption']=="EventLocationExact")
   {
      echo '<p><label>Location </label><input type="text" name="EventLocationExact" maxlength="128" required/><i>(maximum of 128 characters)</i></p>';
   }
   if($_POST['EventLocationOption']=="EventLocationLike")
   {
      echo '<p><label>Location </label><input type="text" name="EventLocationLike" maxlength="128" required/><i>(maximum of 128 characters)</i></p>';
   }
}
if($_POST['EventDescriptionOption']!="None")
{
   //echo "<p>EventDescriptionOption=".$_POST['EventDescriptionOption']."</p>";
   if($_POST['EventDescriptionOption']=="EventDescriptionLike")
   {
      echo '<p><label>Description </label><textarea name="EventDescriptionLike" maxlength="2048" rows="10" cols="45" required> </textarea><i>(maximum of 2048 characters)</i></p>';
   }
}

echo '<p><label>Order By </label><select name="Sorting"><option value="ID" selected>ID</option><option value="Title">Title</option><option value="Category">Category</option><option value="EventDate">EventDate</option><option value="EventStartTime">EventStartTime</option><option value="EventStartTimeAMPM">EventStartTimeAMPM</option><option value="Location">Location</option><option value="Description">Description</option></select></p>';
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
      <input type="submit" value="Return"/>
  </form>
</body>

</html>