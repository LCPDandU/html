<?php

//to connect to the database we do this
include('config.php');

//to include header hyperlinks
include('header.php');


/*Processing of URL variables 'order' and 'sort'*/
//Determine what Attribute to ORDER BY (ID is the default)
if(isset($_POST['Sorting']))
{
   if($_POST['Sorting']=='ID'){$order='ID';}
   else if($_POST['Sorting']=='Title'){$order='Title';}
   else if($_POST['Sorting']=='Category'){$order='Category';}
   else if($_POST['Sorting']=='EventDate'){$order='EventDate';}
   else if($_POST['Sorting']=='EventStartTime'){$order='EventStartTime';}
   else if($_POST['Sorting']=='EventStartTimeAMPM'){$order='EventStartTimeAMPM';}
   else if($_POST['Sorting']=='Location'){$order='Location';}
   else if($_POST['Sorting']=='Description'){$order='Description';}
   else{$order='ID';}
}
else if(isset($_GET['order']))
{
   if($_GET['order']=='ID'){$order='ID';}
   else if($_GET['order']=='Title'){$order='Title';}
   else if($_GET['order']=='Category'){$order='Category';}
   else if($_GET['order']=='EventDate'){$order='EventDate';}
   else if($_GET['order']=='EventStartTime'){$order='EventStartTime';}
   else if($_GET['order']=='EventStartTimeAMPM'){$order='EventStartTimeAMPM';}
   else if($_GET['order']=='Location'){$order='Location';}
   else if($_GET['order']=='Description'){$order='Description';}
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
//Form variables ($_POST) come from the initial form on the page searchSingleAttributeInputEvent
//URL variables ($_GET) are used to preserve search criteria while allowing the results to be dynamically sorted via table headers

//The following variables are set below: $url, $href, $attr, and the appropriate variables for each search

//$url - A variable used to hold the REST api route
//$attr - A variable used to hold the Single Attribute Search being performed
//$href - A variable used to hold the new URL variables that will be used to preserve search criteria

$url="http://localhost/public/api/events/order/$order/sort/$sort";
$href="?";

$ignoreString="|||";

$exactTitle=$ignoreString;
$likeTitle=$ignoreString;
$category=$ignoreString;
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
$locationExact=$ignoreString;
$locationLike=$ignoreString;
$descriptionLike=$ignoreString;

$attr="";

if(isset($_POST['EventTitleExact']) || isset($_GET['EventTitleExact']))
{
   //The Exact Title being searched for
   isset($_POST['EventTitleExact']) ? $title=$_POST['EventTitleExact'] : $title=$_GET['EventTitleExact'];
   $exactTitle=urlencode($title);

   $href.="EventTitleExact=".$title."&&";
   $attr.="[Exact Title]";
}
if(isset($_POST['EventTitleLike']) || isset($_GET['EventTitleLike']))
{
   //The Like-Title being searched for
   isset($_POST['EventTitleLike']) ? $title=$_POST['EventTitleLike'] : $title=$_GET['EventTitleLike'];
   $likeTitle=urlencode($title);
   
   $href.="EventTitleLike=".$title."&&";
   $attr.="[Like-Title]";
}
if(isset($_POST['EventCategory']) || isset($_GET['EventCategory']))
{
   //The Category being searched for
   isset($_POST['EventCategory']) ? $category=$_POST['EventCategory'] : $category=$_GET['EventCategory'];
   $category=urlencode($category);

   $href.="EventCategory=".$category."&&";
   $attr.="[Category]";
}
if(isset($_POST['EventDateExact']) || isset($_GET['EventDateExact']))
{
   //The Exact Date being searched for
   isset($_POST['EventDateExact']) ? $date=$_POST['EventDateExact'] : $date=$_GET['EventDateExact'];
   $dateExact=urlencode($date);

   $href.="EventDateExact=".$date."&&";
   $attr.="[Exact Date]";
}
if(isset($_POST['EventDateA']) || isset($_GET['EventDateA']))
{
   //The Dates describing the date range being searched for
   //The Range is $dateA - $dateB, inclusive
   isset($_POST['EventDateA']) ? $dateA=$_POST['EventDateA'] : $dateA=$_GET['EventDateA'];
   $dateA=urlencode($dateA);
   isset($_POST['EventDateB']) ? $dateB=$_POST['EventDateB'] : $dateB=$_GET['EventDateB'];
   $dateB=urlencode($dateB);

   $href.="EventDateA=".$dateA."&&EventDateB=".$dateB."&&";
   $attr.="[Date Range]";
}
if(isset($_POST['EventDateBefAft']) || isset($_GET['EventDateBefAft']))
{
   //Determines whether we are looking at dates before the given date, or after
   isset($_POST['EventDateBefAft']) ? $date=$_POST['EventDateBefAft'] : $date=$_GET['EventDateBefAft'];
   $dateBefAft=urlencode($date);
   
   //The Date that serves as dividing date
   isset($_POST['BefAftEventDate']) ? $befaft=$_POST['BefAftEventDate'] : $befaft=$_GET['BefAftEventDate'];
   $befAftDate=urlencode($befaft);
   
   $href.="EventDateBefAft=".$date."&&BefAftEventDate=".$befaft."&&";
   
   if($befaft=="Before"){
      $attr.="[Before Date]";
   }
   if($befaft=="After"){
      $attr.="[After Date]";
   }
}
if(isset($_POST['EventStartTimeHourExact']) || isset($_GET['EventStartTimeHourExact']))
{
   //Together form the Exact Start Time being searched for
   isset($_POST['EventStartTimeHourExact']) ? $hour=$_POST['EventStartTimeHourExact'] : $hour=$_GET['EventStartTimeHourExact'];
   $hourExact=urlencode($hour);
   isset($_POST['EventStartTimeMinuteExact']) ? $minute=$_POST['EventStartTimeMinuteExact'] : $minute=$_GET['EventStartTimeMinuteExact'];
   $minuteExact=urlencode($minute);
   isset($_POST['EventStartTimeAMPMExact']) ? $ampm=$_POST['EventStartTimeAMPMExact'] : $ampm=$_GET['EventStartTimeAMPMExact'];
   $ampmExact=urlencode($ampm);
   
   $href.="EventStartTimeHourExact=".$hour."&&EventStartTimeMinuteExact=".$minute."&&EventStartTimeAMPMExact=".$ampm."&&";
   $attr.="[Exact Start Time]";
}
if(isset($_POST['EventStartTimeHourBefAft']) || isset($_GET['EventStartTimeHourBefAft']))
{
   //Together form the Start Time that serves as dividing time
   isset($_POST['EventStartTimeHourBefAft']) ? $hour=$_POST['EventStartTimeHourBefAft'] : $hour=$_GET['EventStartTimeHourBefAft'];
   $hourBefAft=urlencode($hour);
   isset($_POST['EventStartTimeMinuteBefAft']) ? $minute=$_POST['EventStartTimeMinuteBefAft'] : $minute=$_GET['EventStartTimeMinuteBefAft'];
   $minuteBefAft=urlencode($minute);
   isset($_POST['EventStartTimeAMPMBefAft']) ? $ampm=$_POST['EventStartTimeAMPMBefAft'] : $ampm=$_GET['EventStartTimeAMPMBefAft'];
   $ampmBefAft=urlencode($ampm);
   
   //Determines whether we are looking at times before the given time, or after
   isset($_POST['BefAftEventStartTime']) ? $befaft=$_POST['BefAftEventStartTime'] : $befaft=$_GET['BefAftEventStartTime'];
   $befAftTime=urlencode($befaft);
   
   $href.="EventStartTimeHourBefAft=".$hour."&&EventStartTimeMinuteBefAft=".$minute."&&EventStartTimeAMPMBefAft=".$ampm."&&BefAftEventStartTime=".$befaft."&&";

   if($befaft=="Before")
   {
      $attr.="[Before Start Time]";
   }
   if($befaft=="After")
   {
      $attr.="[After Start Time]";
   }
}
if(isset($_POST['EventLocationExact']) || isset($_GET['EventLocationExact']))
{
   //The Exact Location being searched for
   isset($_POST['EventLocationExact']) ? $location=$_POST['EventLocationExact'] : $location=$_GET['EventLocationExact'];
   $locationExact=urlencode($location);

   $href.="EventLocationExact=".$location."&&";
   $attr.="[Exact Location]";
}
if(isset($_POST['EventLocationLike']) || isset($_GET['EventLocationLike']))
{
   //The Like-Location being searched for
   isset($_POST['EventLocationLike']) ? $location=$_POST['EventLocationLike'] : $location=$_GET['EventLocationLike'];
   $locationLike=urlencode($location);

   $href.="EventLocationLike=".$location."&&";
   $attr.="[Like-Location]";
}
if(isset($_POST['EventDescriptionLike']) || isset($_GET['EventDescriptionLike']))
{
   //The Description key-words being searched for
   isset($_POST['EventDescriptionLike']) ? $description=$_POST['EventDescriptionLike'] : $description=$_GET['EventDescriptionLike'];
   $descriptionLike=urlencode($description);

   $href.="EventDescriptionLike=".$description."&&";
   $attr.="[Like-Description]";
}

$url="http://localhost/public/api/events/MultiAttr/order/$order/sort/$sort/$exactTitle/$likeTitle/$category/$dateExact/$dateA/$dateB/$dateBefAft/$befAftDate/$hourExact/$minuteExact/$ampmExact/$hourBefAft/$minuteBefAft/$ampmBefAft/$befAftTime/$locationExact/$locationLike/$descriptionLike";

echo "<html><head><h1>Search Results (Event by " . $attr . ", Ordered by ".$order.", ".$sorting." Sorting)</h1></head>";

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
            	<th><a href="'.$href.'&&order=Category&&sort='.$sort.'">Category</a></th>
            	<th><a href="'.$href.'&&order=EventDate&&sort='.$sort.'">EventDate</a></th>
            	<th><a href="'.$href.'&&order=EventStartTime&&sort='.$sort.'">EventStartTime</a></th>
            	<th><a href="'.$href.'&&order=EventStartTimeAMPM&&sort='.$sort.'">EventStartTimeAMPM</a></th>
            	<th><a href="'.$href.'&&order=Location&&sort='.$sort.'">Location</a></th>
               <th><a href="'.$href.'&&order=Description&&sort='.$sort.'">Description</a></th>
               <th>Media1</th>
               <th>Media2</th>
               <th>Media3</th>
               <th>Edit Event</th>
            </tr>';
            
      //Loop through all entries
        foreach(json_decode($line,true) as $row){
         echo '<tr><td align="center">' .
           $row['ID'] . '</td><td align="center">' .
           $row['Title'] . '</td><td align="center">' .
           $row['Category'] . '</td><td align="center">' .
           $row['EventDate'] . '</td><td align="center">' .
           $row['EventStartTime'] . '</td><td align="center">' .
           $row['EventStartTimeAMPM'] . '</td><td align="center">' .
           $row['Location'] . '</td><td align="center">' .
           $row['Description'] . '</td><td align="center">'; 
         
         //Media fields not implemented yet
         echo '<i>(not implemented yet)</i></td><td align="center">' . 
              '<i>(not implemented yet)</i></td><td align="center">' .
              '<i>(not implemented yet)</i></td><td align="center">';
              
         //edit button is spawned
         echo '<form action="editEvent.php" method="post">' .
              '<input type="hidden" name="EventID" value="'.$row['ID'].'"/>' .
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