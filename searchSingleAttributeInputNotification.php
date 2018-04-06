<?php include('header.php');?>

<?php 

  switch($_POST['Attribute'])
  {
    case "NotificationTitle":
       $form='<form action="searchResultsNotificationSingleAttribute.php" method="post"><fieldset>'.
             '<h1><strong>Search Notifications by Exact Title</strong></h1>'.
             
             //exact title
             '<p>
                <label>Title </label>
                <input type="text" name="NotificationTitleExact" value="" maxlength="128" required/>
                <i>(maximum of 128 characters)</i>
              </p>'.
             '<p>
                <label>Ordering <label>
                <input type="radio" name="Ordering" value="ASC"/><label>Ascending</label>
                <input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label>
              </p>'.
             '<p>
                <input type="submit" value="Search"/>
              </p>'.
             '</fieldset></form>'.
             
             //like title
             '<form action="searchResultsNotificationSingleAttribute.php" method="post"><fieldset>'.
             '<h1><strong>Search Notifications by Like-Title</strong></h1>'.
             '<p>
                <label>Title </label>
                <input type="text" name="NotificationTitleLike" value="" maxlength="128" required/>
                <i>(maximum of 128 characters)</i>
              </p>'.
             '<p>
                <label>Ordering <label>
                <input type="radio" name="Ordering" value="ASC"/><label>Ascending</label>
                <input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label>
              </p>'.
             '<p>
                <input type="submit" value="Search"/>
              </p>'.
             '</fieldset></form>';
       break;
    case "NotificationDescription":
       $form='<form action="searchResultsNotificationSingleAttribute.php" method="post"><fieldset>'.
             '<h1><strong>Search Notifications by Like-Description</strong></h1>'.
             
             //like description
             '<p>
                <label>Description</label>
                <textarea name="NotificationDescriptionLike" maxlength="2048" rows="10" cols="45" required> </textarea>
                <i>(maximum of 2048 characters)</i></p>'.
             '<p>
                <label>Ordering </label>
                <input type="radio" name="Ordering" value="ASC"/><label>Ascending</label>
                <input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label></p>'.
             '<p>
                <input type="submit" value="Search"/>
              </p>'.
             '</fieldset></form>';
       break;
    case "NotificationDate":
       $form='<form action="searchResultsNotificationSingleAttribute.php" method="post"><fieldset>'.
             '<h1><strong>Search Notification by Exact Date</strong></h1>'.
             
             //exact date
             '<p>
                <label>Notification Date </label>
                <input type="date" name="NotificationDateExact" value="" required/>
                <i>(enter date in YYYY-MM-DD form if typing manually)</i>
              </p>'.
             '<p>
                <label>Ordering </label>
                <input type="radio" name="Ordering" value="ASC"/><label>Ascending</label>
                <input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label>
              </p>'.
             '<p>
                <input type="submit" value="Search"/>
              </p>'.
             '</fieldset></form>'.
             
             //range date
             '<form action="searchResultsNotificationSingleAttribute.php" method="post"><fieldset>'.
             '<h1><strong>Search Notification by Date Range</strong></h1>'.
             '<p>
                <label>From </label>
                <input type="date" name="NotificationDateA" value="" required/>'.
               '<label>   To </label>
                <input type="date" name="NotificationDateB" value="" required/>
                <i>(enter date in YYYY-MM-DD form if typing manually)</i>
              </p>'.
             '<p>
                <label>Ordering </label>
                <input type="radio" name="Ordering" value="ASC"/><label>Ascending</label>
                <input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label>
              </p>'.
             '<p>
                <input type="submit" value="Search"/>
              </p>'.
             '</fieldset></form>'.
             
             //before or after date
             '<form action="searchResultsNotificationSingleAttribute.php" method="post"><fieldset>'.
             '<h1><strong>Search Notification Before/After Date</strong></h1>'.
             '<p>
                <label>Notification Date </label>
                <input type="date" name="NotificationDateBefAft" value="" required/>
                <i>(enter date in YYYY-MM-DD form if typing manually)</i>
              </p>'.
             '<p>
                <label>Before-After </label>
                <input type="radio" name="BefAftNotificationDate" value="Before" checked/><label>Before</label>
                <input type="radio" name="BefAftNotificaitonDate" value="After"/><label>After</label>
              </p>'.
             '<p>
                <label>Ordering </label>
                <input type="radio" name="Ordering" value="ASC"/><label>Ascending</label>
                <input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label>
              </p>'.
             '<p>
                <input type="submit" value="Search"/>
              </p>'.
             '</fieldset></form>';
       break;
    case "NotificationPostTime":
       $form='<form action="searchResultsNotificationSingleAttribute.php" method="post"><fieldset>'.
             '<h1><strong>Search Notificaiton by Exact Post Time</strong></h1>'.
             '<p>
                <label>Notification Post Time </label>'.
                
               //exact time
               '<input type="number" name="NotificationPostTimeHourExact" min="1" max="12" required/> : <input type="number" name="NotificationPostTimeMinuteExact" min="0" max="59" required/>'.
               '<select name="NotificationPostTimeAMPMExact">
                  <option value="AM" selected>AM</option>
                  <option value="PM">PM</option>
                </select>'.
               '<i>(First field is hour, Second is minute)</i>
              </p>'.
             '<p>
                <label>Ordering </label>
                <input type="radio" name="Ordering" value="ASC"/><label>Ascending</label>
                <input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label>
              </p>'.
             '<p><input type="submit" value="Search"/></p>'.
             '</fieldset></form>';//.
             
             /*
             //before or after time
             '<form action="searchResultsNotificationSingleAttribute.php" method="post"><fieldset>'.
             '<h1><strong>Search Notification Before/After Time</strong></h1>'.
             '<p>
                <label>Notification Post Time </label>'.
               '<input type="number" name="NotificationPostTimeHourBefAft" min="1" max="12" required/> : <input type="number" name="NotificationPostTimeMinuteBefAft" min="0" max="59" required/>'.
               '<select name="NotificationPostTimeAMPMBefAft">
                  <option value="AM" selected>AM</option>
                  <option value="PM">PM</option>
                </select>'.
               '<i>(First field is hour, Second is minute)</i>
              </p>'.
             '<p>
                <label>Before-After </label>
                <input type="radio" name="BefAftNotificationPostTime" value="Before" checked/><label>Before</label>
                <input type="radio" name="BefAftNotificationPostTime" value="After"/><label>After</label></p>'.
             '<p>
                <label>Ordering </label>
                <input type="radio" name="Ordering" value="ASC"/><label>Ascending</label>
                <input type="radio" name="Ordering" value="DESC" checked/><label>Descending</label>
              </p>'.
             '<p>
                <input type="submit" value="Search"/>
              </p>'.
             '</fieldset></form>';*/
       break;
  }


?>

<html>

<head>
<title></title>
</head>

<!--<body style = "Color: #000000; background-color:#afbfff;">-->
<body>

  <!--
  <form action="seeAllMenu.php" method="post">
      <input type="submit" value="See All Menu"/>
  </form>
  -->
  <?php echo $form; ?>
  <form action="searchAttributeMenu.php" method="post">
      <input type="submit" value="Back"/>
      <i>(not implemented yet)</i>
  </form>
</body>

</html>