<?php

//to connect to the database we do this
include('../config.php');

//to include header hyperlinks
include('../header.php');


/*Processing of URL variables 'order' and 'sort'*/
//Determine what Attribute to ORDER BY (ID is the default)
if(isset($_POST['Sorting']))
{
   if($_POST['Sorting']=='ID'){$order='ID';}
   else if($_POST['Sorting']=='Title'){$order='Title';}
   else if($_POST['Sorting']=='Description'){$order='Description';}
   else if($_POST['Sorting']=='PostDate'){$order='PostDate';}
   else if($_POST['Sorting']=='PostTime'){$order='PostTime';}
   else if($_POST['Sorting']=='PostTimeAMPM'){$order='PostTimeAMPM';}
   else{$order='ID';}
}
else if(isset($_GET['order']))
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


//User input is scanned for undersierable characters. This is done to prevent SQL injection
$userInput = array(
   $_POST['NotificationTitleExact'],
   $_POST['NotificationTitleLike'],
   $_POST['NotificationDescriptionLike'],
   $_POST['NotificationDateExact'],
   $_POST['NotificationDateA'],
   $_POST['NotificationDateB'],
   $_POST['NotificationDateBefAft'],
   $_POST['BefAftNotificationDate'],
   $_POST['NotificationPostTimeHourExact'],
   $_POST['NotificationPostTimeMinuteExact'],
   $_POST['NotificationPostTimeAMPMExact'],
   $_POST['NotificationPostTimeHourBefAft'],
   $_POST['NotificationPostTimeMinuteBefAft'],
   $_POST['NotificationPostTimeAMPMBefAft'],
   $_POST['BefAftNotificationPostTime'],
   $_GET['NotificationTitleExact'],
   $_GET['NotificationTitleLike'],
   $_GET['NotificationDescriptionLike'],
   $_GET['NotificationDateExact'],
   $_GET['NotificationDateA'],
   $_GET['NotificationDateB'],
   $_GET['NotificationDateBefAft'],
   $_GET['BefAftNotificationDate'],
   $_GET['NotificationPostTimeHourExact'],
   $_GET['NotificationPostTimeMinuteExact'],
   $_GET['NotificationPostTimeAMPMExact'],
   $_GET['NotificationPostTimeHourBefAft'],
   $_GET['NotificationPostTimeMinuteBefAft'],
   $_GET['NotificationPostTimeAMPMBefAft'],
   $_GET['BefAftNotificationPostTime']
);
$inputCount=0;
foreach($userInput as $string)
{
   $evaluate=containsSpecialChar($string);
   if($evaluate['contains']==true)
   {
      if(inputCount==0)echo '<body><p>Your input contains special characters, please go back and remove the characters listed below from your input.</p></body>';
      echo '<body><p>"'.$string.'" contains the following special characters: ['.$evaluate['charList'].']</p></body>';
      $inputCount=$inputCount+1;
   }
}
if($inputCount>0)
{
   echo '<body><p>';
   echo '<form action="searchAttributeMenu.php" method="post">';
   echo '<input type="submit" value="Back"/>';
   echo '</form></p></body>';
   die();
}


/*Processing of form/URL variables*/
//Form variables ($_POST) come from the initial form on the page searchSingleAttributeInputEvent
//URL variables ($_GET) are used to preserve search criteria while allowing the results to be dynamically sorted via table headers

//The following variables are set below: $url, $href, $attr, and the appropriate variables for each search

//$url - A variable used to hold the REST api route
//$attr - A variable used to hold the Single Attribute Search being performed
//$href - A variable used to hold the new URL variables that will be used to preserve search criteria

$url=URL_START ."/public/api/events/order/$order/sort/$sort";
$href="?";

$ignoreString="|||";

$exactTitle=$ignoreString;
$likeTitle=$ignoreString;
$descriptionLike=$ignoreString;
$dateExact=$ignoreString;
$dateA=$ignoreString;
$dateB=$ignoreString;
$dateBefAft=$ignoreString;
$befAftDate=$ignoreString;
$hourExact=$ignoreString;
$minuteExact=$ignoreString;
$ampmExact=$ignoreString;
$hourBefAft=$ignoreString;
$minuteBefAft=$ignoreString;
$ampmBefAft=$ignoreString;
$befAftTime=$ignoreString;

$attr="";

//CHANGE VALUES OF ARRAY ELEMENTS
if(isset($_POST['NotificationTitleExact']) || isset($_GET['NotificationTitleExact']))
{
   //The Exact Title being searched for
   isset($_POST['NotificationTitleExact']) ? $title=$_POST['NotificationTitleExact'] : $title=$_GET['NotificationTitleExact'];
   $exactTitle=urlencode($title);

   $href.="NotificationTitleExact=".$title."&&";
   $attr.="[Exact Title]";
}
if(isset($_POST['NotificationTitleLike']) || isset($_GET['NotificationTitleLike']))
{
   //The Like-Title being searched for
   isset($_POST['NotificationTitleLike']) ? $title=$_POST['NotificationTitleLike'] : $title=$_GET['NotificationTitleLike'];
   $likeTitle=urlencode($title);
   
   $href.="NotificationTitleLike=".$title."&&";
   $attr.="[Like-Title]";
}
if(isset($_POST['NotificationDescriptionLike']) || isset($_GET['NotificationDescriptionLike']))
{
   //The Description key-words being searched for
   isset($_POST['NotificationDescriptionLike']) ? $description=$_POST['NotificationDescriptionLike'] : $description=$_GET['NotificationDescriptionLike'];
   $descriptionLike=urlencode($description);

   $href.="NotificationDescriptionLike=".$description."&&";
   $attr.="[Like-Description]";
}
if(isset($_POST['NotificationDateExact']) || isset($_GET['NotificationDateExact']))
{
   //The Exact Date being searched for
   isset($_POST['NotificationDateExact']) ? $date=$_POST['NotificationDateExact'] : $date=$_GET['NotificationDateExact'];
   $dateExact=urlencode($date);

   $href.="NotificationDateExact=".$date."&&";
   $attr.="[Exact Date]";
}
if(isset($_POST['NotificationDateA']) || isset($_GET['NotificationDateA']))
{
   //The Dates describing the date range being searched for
   //The Range is $dateA - $dateB, inclusive
   isset($_POST['NotificationDateA']) ? $dateA=$_POST['NotificationDateA'] : $dateA=$_GET['NotificationDateA'];
   $dateA=urlencode($dateA);
   isset($_POST['NotificationDateB']) ? $dateB=$_POST['NotificationDateB'] : $dateB=$_GET['NotificationDateB'];
   $dateB=urlencode($dateB);

   $href.="NotificationDateA=".$dateA."&&NotificationDateB=".$dateB."&&";
   $attr.="[Date Range]";
}
if(isset($_POST['NotificationDateBefAft']) || isset($_GET['NotificationDateBefAft']))
{
   //Determines whether we are looking at dates before the given date, or after
   isset($_POST['NotificationDateBefAft']) ? $date=$_POST['NotificationDateBefAft'] : $date=$_GET['NotificationDateBefAft'];
   $dateBefAft=urlencode($date);
   
   //The Date that serves as dividing date
   isset($_POST['BefAftNotificationDate']) ? $befaft=$_POST['BefAftNotificationDate'] : $befaft=$_GET['BefAftNotificationDate'];
   $befAftDate=urlencode($befaft);
   
   $href.="NotificationDateBefAft=".$date."&&BefAftNotificationDate=".$befaft."&&";
   
   if($befaft=="Before"){
      $attr.="[Before Date]";
   }
   if($befaft=="After"){
      $attr.="[After Date]";
   }
}
if(isset($_POST['NotificationPostTimeHourExact']) || isset($_GET['NotificationPostTimeHourExact']))
{
   //Together form the Exact Start Time being searched for
   isset($_POST['NotificationPostTimeHourExact']) ? $hour=$_POST['NotificationPostTimeHourExact'] : $hour=$_GET['NotificationPostTimeHourExact'];
   $hourExact=urlencode($hour);
   isset($_POST['NotificationPostTimeMinuteExact']) ? $minute=$_POST['NotificationPostTimeMinuteExact'] : $minute=$_GET['NotificationPostTimeMinuteExact'];
   $minuteExact=urlencode($minute);
   isset($_POST['NotificationPostTimeAMPMExact']) ? $ampm=$_POST['NotificationPostTimeAMPMExact'] : $ampm=$_GET['NotificationPostTimeAMPMExact'];
   $ampmExact=urlencode($ampm);
   
   $href.="NotificationPostTimeHourExact=".$hour."&&NotificationPostTimeMinuteExact=".$minute."&&NotificationPostTimeAMPMExact=".$ampm."&&";
   $attr.="[Exact Post Time]";
}
if(isset($_POST['NotificationPostTimeHourBefAft']) || isset($_GET['NotificationPostTimeHourBefAft']))
{
   //Together form the Start Time that serves as dividing time
   isset($_POST['NotificationPostTimeHourBefAft']) ? $hour=$_POST['NotificationPostTimeHourBefAft'] : $hour=$_GET['NotificationPostTimeHourBefAft'];
   $hourBefAft=urlencode($hour);
   isset($_POST['NotificationPostTimeMinuteBefAft']) ? $minute=$_POST['NotificationPostTimeMinuteBefAft'] : $minute=$_GET['NotificationPostTimeMinuteBefAft'];
   $minuteBefAft=urlencode($minute);
   isset($_POST['NotificationPostTimeAMPMBefAft']) ? $ampm=$_POST['NotificationPostTimeAMPMBefAft'] : $ampm=$_GET['NotificationPostTimeAMPMBefAft'];
   $ampmBefAft=urlencode($ampm);
   
   //Determines whether we are looking at times before the given time, or after
   isset($_POST['BefAftNotificationPostTime']) ? $befaft=$_POST['BefAftNotificationPostTime'] : $befaft=$_GET['BefAftNotificationPostTime'];
   $befAftTime=urlencode($befaft);
   
   $href.="NotificationPostTimeHourBefAft=".$hour."&&NotificationPostTimeMinuteBefAft=".$minute."&&NotificationPostTimeAMPMBefAft=".$ampm."&&BefAftNotificationPostTime=".$befaft."&&";

   if($befaft=="Before")
   {
      $attr.="[Before Post Time]";
   }
   if($befaft=="After")
   {
      $attr.="[After Post Time]";
   }
}

$url=URL_START ."/public/api/notifications/MultiAttr/order/$order/sort/$sort/$exactTitle/$likeTitle/$descriptionLike/$dateExact/$dateA/$dateB/$dateBefAft/$befAftDate/$hourExact/$minuteExact/$ampmExact/$hourBefAft/$minuteBefAft/$ampmBefAft/$befAftTime";

echo "<html><head><h1>Search Results (Notifiction by " . $attr . ", Ordered by ".$order.", ".$sorting." Sorting)</h1></head>";

//open the file generated by the REST API
//echo "<body><p>url=".$url."</p></body>";
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
           $row['PostTime'] . '</td><td align="center">' .
           $row['PostTimeAMPM'] . '</td><td align="center">'; 
              
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

   <form action="searchAttributeMenu.php" method="post">
      <input type="submit" value="Return"/>
   </form>

    <body>
    <p><?php echo $message; ?>
    </body>
    
</html>