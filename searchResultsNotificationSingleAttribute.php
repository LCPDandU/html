<?php
include('config.php');
include('header.php');


/*Processing of URL variables 'order' and 'sort'*/
//Determine what Attribute to ORDER BY (ID is the default)
if(isset($_GET['order']))
{
   if($_GET['order']=='ID'){$order='ID';}
   else if($_GET['order']=='Title'){$order='Title';}
   else if($_GET['order']=='Description'){$order='Description';}
   else if($_GET['order']=='PostDate'){$order='PostDate';}
   else if($_GET['order']=='PostTime'){$order='PostTime';}
   else if($_GET['order']=='PostTimeAMPM'){$order='PostTimeAMPM';}
   else{$order='ID';}
}
else
{
   $order='ID';
}
//Determine whether sorting is Ascending or Descending (Descending is default)
if(isset($_POST['Ordering']))
{
   if($_POST['Ordering']=='DESC'){$sort='DESC';$sorting='Descending';}
   else if($_POST['Ordering']=='ASC'){$sort='ASC';$sorting='Ascending';}
   else{$sort='DESC';$sorting='Descending';}
}
else if(isset($_GET['sort']))
{
   if($_GET['sort']=='desc'){$sort='DESC';$sorting='Descending';}
   else if($_GET['sort']=='asc'){$sort='ASC';$sorting='Ascending';}
   else{$sort='DESC';$sorting='Descending';}
}
else
{
   $sort='DESC';$sorting='Descending';
  //isset($_POST['Ordering']) ? $sort=$_POST['Ordering'] : $title='DESC';
}


/*Processing of form/URL variables*/
//Form variables ($_POST) come from the initial form on the page searchSingleAttributeInputNotification
//URL variables ($_GET) are used to preserve search criteria while allowing the results to be dynamically sorted via table headers

//The following variables are set below: $url, $href, $attr, and the appropriate variables for each search

//$url - A variable used to hold the REST api route
//$attr - A variable used to hold the Single Attribute Search being performed
//$href - A variable used to hold the new URL variables that will be used to preserve search criteria
if(isset($_POST['NotificationTitleExact']) || isset($_GET['NotificationTitleExact']))
{
   //The Exact Title being searched for
   isset($_POST['NotificationTitleExact']) ? $title=$_POST['NotificationTitleExact'] : $title=$_GET['NotificationTitleExact'];

   $href="?NotificationTitleExact=".$title;
   $url="http://localhost/public/api/notifications/order/$order/sort/$sort/TitleExact/$title";
   $attr="Exact Title";
}
if(isset($_POST['NotificationTitleLike']) || isset($_GET['NotificationTitleLike']))
{
   //The Like-Title being searched for
   isset($_POST['NotificationTitleLike']) ? $title=$_POST['NotificationTitleLike'] : $title=$_GET['NotificationTitleLike'];
   
   $href="?NotificationTitleLike=".$title;
   $url="http://localhost/public/api/notifications/order/$order/sort/$sort/TitleLike/$title";
   $attr="Like-Title";
}
if(isset($_POST['NotificationDescriptionLike']) || isset($_GET['NotificationDescriptionLike']))
{
   //The Description key-words being searched for
   isset($_POST['NotificationDescriptionLike']) ? $description=$_POST['NotificationDescriptionLike'] : $description=$_GET['NotificationDescriptionLike'];

   $href="?NotificationDescriptionLike=".$description;
   $url="http://localhost/public/api/notifications/order/$order/sort/$sort/DescriptionLike/$description";
   $attr="Like-Description";
}
if(isset($_POST['NotificationDateExact']) || isset($_GET['NotificationDateExact']))
{
   //The Exact Date being searched for
   isset($_POST['NotificationDateExact']) ? $date=$_POST['NotificationDateExact'] : $date=$_GET['NotificationDateExact'];

   $href="?NotificationDateExact=".$date;
   $url="http://localhost/public/api/notifications/order/$order/sort/$sort/PostDateExact/$date";
   $attr="Exact Date";
}
if(isset($_POST['NotificationDateA']) || isset($_GET['NotificationDateA']))
{
   //The Dates describing the date range being searched for
   //The Range is $dateA - $dateB, inclusive
   isset($_POST['NotificationDateA']) ? $dateA=$_POST['NotificationDateA'] : $dateA=$_GET['NotificationDateA'];
   isset($_POST['NotificationDateB']) ? $dateB=$_POST['NotificationDateB'] : $dateB=$_GET['NotificationDateB'];

   $href="?NotificationDateA=".$dateA."&&NotificationDateB=".$dateB;
   $url="http://localhost/public/api/notifications/order/$order/sort/$sort/PostDateA/$dateA/PostDateB/$dateB";
   $attr="Date Range";
}
if(isset($_POST['NotificationDateBefAft']) || isset($_GET['NotificationDateBefAft']))
{
   //Determines whether we are looking at dates before the given date, or after
   isset($_POST['NotificationDateBefAft']) ? $date=$_POST['NotificationDateBefAft'] : $date=$_GET['NotificationDateBefAft'];
   
   //The Date that serves as dividing date
   isset($_POST['BefAftNotifiationDate']) ? $befaft=$_POST['BefAftNotifiationDate'] : $befaft=$_GET['BefAftNotifiationDate'];
   
   $href="?NotificationDateBefAft=".$date."&&BefAftNotifiationDate=".$befaft;
   $url="http://localhost/public/api/notifications/order/$order/sort/$sort/PostDateBefAft/$date/BefAft/$befaft";

   if($befaft=="Before"){
      $attr="Before Date";
   }
   if($befaft=="After"){
      $attr="After Date";
   }
}
if(isset($_POST['NotificationPostTimeHourExact']) || isset($_GET['NotificationPostTimeHourExact']))
{
   //Together form the Exact Post Time being searched for
   isset($_POST['NotificationPostTimeHourExact']) ? $hour=$_POST['NotificationPostTimeHourExact'] : $hour=$_GET['NotificationPostTimeHourExact'];
   isset($_POST['NotificationPostTimeMinuteExact']) ? $minute=$_POST['NotificationPostTimeMinuteExact'] : $minute=$_GET['NotificationPostTimeMinuteExact'];
   isset($_POST['NotificationPostTimeAMPMExact']) ? $ampm=$_POST['NotificationPostTimeAMPMExact'] : $ampm=$_GET['NotificationPostTimeAMPMExact'];
   
   $href="?NotificationPostTimeHourExact=".$hour."&&NotificationPostTimeMinuteExact=".$minute."&&NotificationPostTimeAMPMExact=".$ampm;
   $url="http://localhost/public/api/notifications/order/$order/sort/PostTimeHourExact/$hour/PostTimeMinuteExact/$minute/PostTimeAMPM/$ampm";
   $attr="Exact Start Time";
}
if(isset($_POST['NotificationPostTimeHourBefAft']) || isset($_GET['NotificationPostTimeHourBefAft']))
{
   //Together form the Post Time that serves as dividing time
   isset($_POST['NotificationPostTimeHourBefAft']) ? $hour=$_POST['NotificationPostTimeHourBefAft'] : $hour=$_GET['NotificationPostTimeHourBefAft'];
   isset($_POST['NotificationPostTimeMinuteBefAft']) ? $minute=$_POST['NotificationPostTimeMinuteBefAft'] : $minute=$_GET['NotificationPostTimeMinuteBefAft'];
   isset($_POST['NotificationPostTimeAMPMBefAft']) ? $ampm=$_POST['NotificationPostTimeAMPMBefAft'] : $ampm=$_GET['NotificationPostTimeAMPMBefAft'];
   
   //Determines whether we are looking at times before the given time, or after
   isset($_POST['BefAftNotificationPostTime']) ? $befaft=$_POST['BefAftNotificationPostTime'] : $befaft=$_GET['BefAftNotificationPostTime'];
   
   $href="?NotificationPostTimeHourBefAft=".$hour."&&NotificationPostTimeMinuteBefAft=".$minute."&&NotificationPostTimeAMPMBefAft=".$ampm."&&BefAftNotificationPostTime=".$befaft;
   $url="http://localhost/public/api/notifications/order/$order/sort/PostTimeHourBefAft/$hour/PostTimeMinuteBefAft/$minute/PostTimeAMPM/$ampm/BefAft/$befaft";

   if($befaft=="Before")
   {
      $attr="Before Start Time";
   }
   if($befaft=="After")
   {
      $attr="After Start Time";
   }
}


echo "<html><head><h1>Search Results (Notifiation by ".$attr.", Ordered by ".$order.", ".$sorting." Sorting)</h1></head>";

//open the file generated by the REST API
$handle=fopen($url,"r");
if($handle){
   while(($line=fgets($handle))!==false){
      
      $sort == 'DESC' ? $sort = 'asc' : $sort = 'desc';
      
      //Table headers are generated
      echo '<table align="center" style="width:100%">
            <tr>
	            <th><a href="'.$href.'&&order=ID&&sort='.$sort.'">ID</a></th>
            	<th><a href="'.$href.'&&order=Title&&sort='.$sort.'">Title</a></th>
               <th><a href="'.$href.'&&order=Description&&sort='.$sort.'">Description</a></th>
            	<th><a href="'.$href.'&&order=PostDate&&sort='.$sort.'">PostDate</a></th>
            	<th><a href="'.$href.'&&order=PostTime&&sort='.$sort.'">PostTime</a></th>
            	<th><a href="'.$href.'&&order=PostTimeAMPM&&sort='.$sort.'">PostTimeAMPM</a></th>
               <th>Edit Notification</th>
            </tr>';
            
      //Loop through all entries
        foreach(json_decode($line,true) as $row){
         echo '<tr><td align="center">' .
           $row['ID'] . '</td><td align="center">' .
           $row['Title'] . '</td><td align="center">' .
           $row['Description'] . '</td><td align="center">' .
           $row['PostDate'] . '</td><td align="center">' .
           $row['PostStartTime'] . '</td><td align="center">' .
           $row['PostStartTimeAMPM'] . '</td><td align="center">'; 
              
         //edit button is spawned
         echo '<form action="editNotification.php" method="post">' .
              '<input type="hidden" name="NotificationID" value="'.$row['ID'].'"/>' .
              '<input type="submit" value="Edit"/>' .
              '</form>' .
              '</td>';
                        
         echo '</tr>';
        }
        
        echo "</table>"; 
   }
   fclose($handle);
}
//If file cannot be read, an error is shown
else{
   echo "error reading file (".$url.")";
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
