<?php include('header.php');?>
<?php
   
   switch($_POST['Attribute'])
   {
      case "EventTitle":
         $form='<form action="searchResultsEventSingleAttribute.php" method="post"><fieldset>'.
               '<h1><strong>Search Events by Exact Title</strong></h1>'.
               '<p><label>Title </label><input type="text" name="EventTitleExact" value="" maxlength="128" required/><i>(maximum of 128 characters)</i></p>'.
               '<p><label>Ordering </label><input type="radio" name="Ordering" value="ASC"/><label>Ascending</label><input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label></p>'.
               '<p><input type="submit" value="Search"/></p>'.
               '</fieldset></form>'.
               '<form action="searchResultsEventSingleAttribute.php" method="post"><fieldset>'.
               '<h1><strong>Search Events by Like-Title</strong></h1>'.
               '<p><label> Title </label><input type="text" name="EventTitleLike" value="" maxlength="128" required/><i>(maximum of 128 characters)</i></p>'.
               '<p><label>Ordering </label><input type="radio" name="Ordering" value="ASC"/><label>Ascending</label><input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label></p>'.
               '<p><input type="submit" value="Search"/></p>'.
               '</fieldset></form>';
         break;
      case "EventCategory":
         $form='<form action="searchResultsEventSingleAttribute.php" method="post"><fieldset>'.
               '<h1><strong>Search Events by Category</strong></h1>'.
               '<p><label>Category </label><select name="EventCategory"><option value="LCPD" selected>LCPD</option><option value="LCFD">LCFD</option><option value="AnimalControl">Animal Control</option><option value="Public">Public</option></select></p>'.
               '<p><label>Ordering </label><input type="radio" name="Ordering" value="ASC"/><label>Ascending</label><input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label></p>'.
               '<p><input type="submit" value="Search"/></p>'.
               '</fieldset></form>';
         break;
      case "EventDate":
         $form='<form action="searchResultsEventSingleAttribute.php" method="post"><fieldset>'.
               '<h1><strong>Search Events by Exact Date</strong></h1>'.
               '<p><label>Event Date </label><input type="date" name="EventDateExact" value="" required/><i>(enter date in YYYY-MM-DD form if typing manually)</i></p>'.
               '<p><label>Ordering </label><input type="radio" name="Ordering" value="ASC"/><label>Ascending</label><input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label></p>'.
               '<p><input type="submit" value="Search"/></p>'.
               '</fieldset></form>'.
               '<form action="searchResultsEventSingleAttribute.php" method="post"><fieldset>'.
               '<h1><strong>Search Events by Date Range</strong></h1>'.
               '<p><label>From </label><input type="date" name="EventDateA" value="" required/>'.
               '<label>   To </label><input type="date" name="EventDateB" value="" required/><i>(enter date in YYYY-MM-DD form if typing manually)</i></p>'.
               '<p><label>Ordering </label><input type="radio" name="Ordering" value="ASC"/><label>Ascending</label><input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label></p>'.
               '<p><input type="submit" value="Search"/></p>'.
               '</fieldset></form>'.
               '<form action="searchResultsEventSingleAttribute.php" method="post"><fieldset>'.
               '<h1><strong>Search Events Before/After Date</strong></h1>'.
               '<p><label>Event Date </label><input type="date" name="EventDateBefAft" value="" required/><i>(enter date in YYYY-MM-DD form if typing manually)</i></p>'.
               '<p><label>Before-After </label><input type="radio" name="BefAftEventDate" value="Before" checked/><label>Before</label><input type="radio" name="BefAftEventDate" value="After"/><label>After</label></p>'.
               '<p><label>Ordering </label><input type="radio" name="Ordering" value="ASC"/><label>Ascending</label><input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label></p>'.
               '<p><input type="submit" value="Search"/></p>'.
               '</fieldset></form>';
         break;
      case "EventStartTime":
         $form='<form action="searchResultsEventSingleAttribute.php" method="post"><fieldset>'.
               '<h1><strong>Search Events by Exact Start Time</strong></h1>'.
                  '<p><label>Event Start Time </label>'.
                  '<input type="number" name="EventStartTimeHourExact" min="1" max="12" required/> : <input type="number" name="EventStartTimeMinuteExact" min="0" max="59" required/>'.
                  '<select name="EventStartTimeAMPMExact"><option value="AM" selected>AM</option><option value="PM">PM</option></select>'.
                  '<i>(First field is hour, Second is minute)</i></p>'.
               '<p><label>Ordering </label><input type="radio" name="Ordering" value="ASC"/><label>Ascending</label><input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label></p>'.
               '<p><input type="submit" value="Search"/></p>'.
               '</fieldset></form>'.
               '<form action="searchResultsEventSingleAttribute.php" method="post"><fieldset>'.
               '<h1><strong>Search Events Before/After Time</strong></h1>'.
                  '<p><label>Event Start Time </label>'.
                  '<input type="number" name="EventStartTimeHourBefAft" min="1" max="12" required/> : <input type="number" name="EventStartTimeMinuteBefAft" min="0" max="59" required/>'.
                  '<select name="EventStartTimeAMPMBefAft"><option value="AM" selected>AM</option><option value="PM">PM</option></select>'.
                  '<i>(First field is hour, Second is minute)</i></p>'.
               '<p><label>Before-After </label><input type="radio" name="BefAftEventStartTime" value="Before" checked/><label>Before</label><input type="radio" name="BefAftEventStartTime" value="After"/><label>After</label></p>'.
               '<p><label>Ordering </label><input type="radio" name="Ordering" value="ASC"/><label>Ascending</label><input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label></p>'.
               '<p><input type="submit" value="Search"/></p>'.
               '</fieldset></form>';
         break;
      case "EventLocation":
         $form='<form action="searchResultsEventSingleAttribute.php" method="post"><fieldset>'.
               '<h1><strong>Search Events by Exact Location</strong></h1>'.
               '<p><label>Location</label><input type="text" name="EventLocationExact" maxlength="128" required/><i>(maximum of 128 characters)</i></p>'.
               '<p><label>Ordering </label><input type="radio" name="Ordering" value="ASC"/><label>Ascending</label><input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label></p>'.
               '<p><input type="submit" value="Search"/></p>'.
               '</fieldset></form>'.
               '<form action="searchResultsEventSingleAttribute.php" method="post"><fieldset>'.
               '<h1><strong>Search Events by Like-Location</strong></h1>'.
               '<p><label>Location</label><input type="text" name="EventLocationLike" maxlength="128" required/><i>(maximum of 128 characters)</i></p>'.
               '<p><label>Ordering </label><input type="radio" name="Ordering" value="ASC"/><label>Ascending</label><input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label></p>'.
               '<p><input type="submit" value="Search"/></p>'.
               '</fieldset></form>';
         break;
      case "EventDescription":
      $form='<form action="searchResultsEventSingleAttribute.php" method="post"><fieldset>'.
               '<h1><strong>Search Events by Like-Description</strong></h1>'.
               '<p><label>Description</label><textarea name="EventDescriptionLike" maxlength="2048" rows="10" cols="45" required> </textarea><i>(maximum of 2048 characters)</i></p>'.
               '<p><label>Ordering </label><input type="radio" name="Ordering" value="ASC"/><label>Ascending</label><input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label></p>'.
               '<p><input type="submit" value="Search"/></p>'.
               '</fieldset></form>';
         break;
   }
   
?>
<html>

<head>
<title></title>
</head>

<!--<body style = "Color: #000000; background-color:#afbfff;">-->
<body>
   <?php echo $form;?>
   <form action="searchAttributeMenu.php" method="post">
      <input type="submit" value="Back"/>
   </form>
</body>

</html>