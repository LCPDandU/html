<?php
include('config.php');
include('header.php');


try
{
  $link = connectDB();

  /**********************
   * Notification Title *
   **********************/
  //query for exact title
  if(isset($_POST['NotificationTitleExact']))
  {
    $sql = "SELECT * FROM Notification WHERE Title='" . $_POST['NotificationTitleExact'] . "' ORDER BY Title " . $_POST['Ordering'] . ";";
    $attr="Exact Title";
  }
  //query for like title
  if(isset($_POST['NotificationTitleLike']))
  {
    $sql = "SELECT * FROM Notification WHERE Title LIKE '%" . $_POST['NotificationTitleLike'] . "%' ORDER BY Title " . $_POST['Ordering'] . ";";
    $attr="Like-Title";
  }

  /****************************
   * Notification Description *
   ****************************/
  //query for like description
  if(isset($_POST['NotificationDescriptionLike']))
  {
    $sql = "SELECT * FROM Notification WHERE Description LIKE '%" . $_POST['NotificationDescriptionLike'] . "%' ORDER BY Description " . $_POST['Ordering'] . ";";
    $attr="Like-Description";
  }

  /*********************
   * Notification Date *
   *********************/
  //query for exact date
  if(isset($_POST['NotificationDateExact']))
  {
    $sql = "SELECT * FROM Notification WHERE PostDate='" . $_POST['NotificationDateExact'] . "' ORDER BY PostDate " . $_POST['Ordering'] . ";";
    $attr="Exact Date";
  }
  //query for date range
  if(isset($_POST['NotificationDateA']))
  {
    $sql = "SELECT * FROM Notification WHERE PostDate BETWEEN '" . $_POST['NotificationDateA'] . "' AND '" . $_POST['NotificationDateB'] . "' ORDER BY PostDate " . $_POST['Ordering'] . ";";
    $attr="Date Range";
  }
  //query for before and after date
  if(isset($_POST['NotificationDateBefAft']))
  {
    //before date
    if($_POST['BefAftNotificationDate']=="Before")
    {
      $sql = "SELECT * FROM Notification WHERE PostDate<'" . $_POST['NotificationDateBefAft'] . "' ORDER BY PostDate " . $_POST['Ordering'] . ";";
      $attr="Before Date";
    }
    //after date
    if($_POST['BefAftNotificationDate']=="After")
    {
      $sql = "SELECT * FROM Notification WHERE PostDate>'" . $_POST['NotificationDateBefAft'] . "' ORDER BY PostDate " . $_POST['Ordering'] . ";";
      $attr="After Date";
    }
  }

  /*********************
   * Notification Time *
   *********************/
  //query for exact post time
  if(isset($_POST['NotificationPostTimeHourExact']))
  {
    $sql = "SELECT * FROM Notification WHERE PostTime='" . $_POST['NotificationPostTimeHourExact'] . ":" . $_POST['NotificationPostTimeMinuteExact'] ."' AND PostTimeAMPM='" . $_POST['NotificationPostTimeAMPMExact'] . "' ORDER BY PostTime " . $_POST['Ordering'] . ";";
    $attr="Exact Post Time";
  }
  
  /*
  //query for before and after post time
  if(isset($_POST['NotificationPostTimeBefAft']))
  {
    //before post time
    if($_POST['BefAftNotificationPostTime']=="Before")
    {
      //am
      if($_POST['NotificationPostTimeAMPMBefAft']=="AM")
      {
        $sql = "SELECT * FROM Notification WHERE PostTime<'" . $_POST['NotificationPostTimeHourBefAft'] . ":" . $_POST['NotificationPostTimeMinuteBefAft'] ."' AND PostTimeAMPM='AM' ORDER BY PostTime " . $_POST['Ordering'] . ";";
      }
      //pm
      if($_POST['NotificationPostTimeAMPMBefAft']=="PM")
      {
        $sql = "SELECT * FROM Notification WHERE PostTime<'" . $_POST['NotificationPostTimeHourBefAft'] . ":" . $_POST['NotificationPostTimeMinuteBefAft'] . "' AND ID IN (SELECT ID FROM Notification WHERE PostTimeAMPM='AM' OR PostTimeAMPM='PM') ORDER BY PostTime " . $_POST['Ordering'] . ";";
      }
      $attr="Before Post Time";
    }
    //after post time
    if($_POST['BefAftNotificationPostTime']=="After")
    {
      //am
      if($_POST['NotificationPostTimeAMPMBefAft']=="PM")
      {
        $sql = "SELECT * FROM Notification WHERE PostTime>'" . $_POST['NotificationPostTimeHourBefAft'] . ":" . $_POST['NotificationPostTimeMinuteBefAft'] ."' AND PostTimeAMPM='PM' ORDER BY PostTime " . $_POST['Ordering'] . ";";
      }
      //pm
      if($_POST['NotificationPostTimeAMPMBefAft']=="AM")
      {
        $sql = "SELECT * FROM Notification WHERE PostTime>'" . $_POST['NotificationPostTimeHourBefAft'] . ":" . $_POST['NotificationPostTimeMinuteBefAft'] . "' AND ID IN (SELECT ID FROM Notification WHERE PostTimeAMPM='AM' OR PostTimeAMPM='PM') ORDER BY PostTime " . $_POST['Ordering'] . ";";
      }
      $attr="After Post Time";
    }
  }*/

  /*display the query results*/
  echo "<html><head><h1>Search Results (Notification by " . $attr . ")</h1></head>";

  //run query
  if($result=mysqli_query($link,$sql))
  {
    echo '<table align="center" style="width:100%">
            <tr>
              <th>ID</th>
            	<th>Title</th>
              <th>Description</th>
            	<th>PostDate</th>
            	<th>PostTime</th>
            	<th>PostTimeAMPM</th>
              <th>Edit Notification</th>
            </tr>';

    //loop through all entries
    while($row = mysqli_fetch_array($result)) {
      echo '<tr><td align="center">' .
        $row['ID'] . '</td><td align="center">' .
        $row['Title'] . '</td><td align="center">' .
        $row['Description'] . '</td><td align="center">' .
        $row['PostDate'] . '</td><td align="center">' .
        $row['PostTime'] . '</td><td align="center">' .
        $row['PostTimeAMPM'] . '</td><td align="center">';

      //edit button is spawned
      echo '<form action="editNotification.php" method="post">' .
             '<input type="hidden" name="ID" value="'.$row['ID'].'"/>' .
             '<input type="submit" value="Edit"/>' .
           '</form>' .
           '</td>';

      echo '</tr>';
    }//end while
    echo "</table>";
  }//end if result
}
catch(exception $e)
{
  $message = 'Unable to process request';
}

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

  <body>
    <p><?php echo $message; ?>
  </body>
</body>

</html>
