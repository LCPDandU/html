<?php

//to connect to the database we do this
include('config.php');

//to include header hyperlinks
include('header.php');

 
try
{
   //Connect to MySQL Database  mysqli(Server,User,Password,Database) 
   $link = connectDB();
     
     
   // Prep SQL statement which pull all events and order them by ID in descending order 
   //$sql = "SELECT * FROM CalendarEvent ORDER BY ID DESC;";
   
   if(isset($_POST['EventTitleExact']))
   {
      $sql = "SELECT * FROM CalendarEvent WHERE Title='" . $_POST['EventTitleExact'] . "' ORDER BY Title " . $_POST['Ordering'] . ";";
      $attr="Exact Title";
   }
   if(isset($_POST['EventTitleLike']))
   {
      $sql = "SELECT * FROM CalendarEvent WHERE Title LIKE '%" . $_POST['EventTitleLike'] . "%' ORDER BY Title " . $_POST['Ordering'] . ";";
      $attr="Like-Title";
   }
   if(isset($_POST['EventCategory']))
   {
      $sql = "SELECT * FROM CalendarEvent WHERE Category='" . $_POST['EventCategory'] . "' ORDER BY ID " . $_POST['Ordering'] . ";";
      $attr="Category";
   }
   if(isset($_POST['EventDateExact']))
   {
      $sql = "SELECT * FROM CalendarEvent WHERE EventDate='" . $_POST['EventDateExact'] . "' ORDER BY EventDate " . $_POST['Ordering'] . ";";
      $attr="Exact Date";
   }
   if(isset($_POST['EventDateA']))
   {
      $sql = "SELECT * FROM CalendarEvent WHERE EventDate BETWEEN '" . $_POST['EventDateA'] . "' AND '" . $_POST['EventDateB'] . "' ORDER BY EventDate " . $_POST['Ordering'] . ";";
      $attr="Date Range";
   }
   if(isset($_POST['EventDateBefAft']))
   {
      if($_POST['BefAftEventDate']=="Before"){$sql = "SELECT * FROM CalendarEvent WHERE EventDate<'" . $_POST['EventDateBefAft'] . "' ORDER BY EventDate " . $_POST['Ordering'] . ";";$attr="Before Date";}
      if($_POST['BefAftEventDate']=="After"){$sql = "SELECT * FROM CalendarEvent WHERE EventDate>'" . $_POST['EventDateBefAft'] . "' ORDER BY EventDate " . $_POST['Ordering'] . ";";$attr="After Date";}
   }
   if(isset($_POST['EventStartTimeHourExact']))
   {
      $sql = "SELECT * FROM CalendarEvent WHERE EventStartTime='" . $_POST['EventStartTimeHourExact'] . ":" . $_POST['EventStartTimeMinuteExact'] ."' AND EventStartTimeAMPM='" . $_POST['EventStartTimeAMPMExact'] . "' ORDER BY EventStartTime " . $_POST['Ordering'] . ";";
      $attr="Exact Start Time";
   }
   if(isset($_POST['EventStartTimeHourBefAft']))
   {
      if($_POST['BefAftEventStartTime']=="Before")
      {
         if($_POST['EventStartTimeAMPMBefAft']=="AM")
         {
            $sql = "SELECT * FROM CalendarEvent WHERE EventStartTime<'" . $_POST['EventStartTimeHourBefAft'] . ":" . $_POST['EventStartTimeMinuteBefAft'] ."' AND EventStartTimeAMPM='AM' ORDER BY EventStartTime " . $_POST['Ordering'] . ";";
         }
         if($_POST['EventStartTimeAMPMBefAft']=="PM")
         {
            $sql = "SELECT * FROM CalendarEvent WHERE EventStartTime<'" . $_POST['EventStartTimeHourBefAft'] . ":" . $_POST['EventStartTimeMinuteBefAft'] . "' AND ID IN (SELECT ID FROM CalendarEvent WHERE EventStartTimeAMPM='AM' OR EventStartTimeAMPM='PM') ORDER BY EventStartTime " . $_POST['Ordering'] . ";";
         }
         $attr="Before Start Time";
      }
      if($_POST['BefAftEventStartTime']=="After")
      {
         if($_POST['EventStartTimeAMPMBefAft']=="PM")
         {
            $sql = "SELECT * FROM CalendarEvent WHERE EventStartTime>'" . $_POST['EventStartTimeHourBefAft'] . ":" . $_POST['EventStartTimeMinuteBefAft'] ."' AND EventStartTimeAMPM='PM' ORDER BY EventStartTime " . $_POST['Ordering'] . ";";
         }
         if($_POST['EventStartTimeAMPMBefAft']=="AM")
         {
            $sql = "SELECT * FROM CalendarEvent WHERE EventStartTime>'" . $_POST['EventStartTimeHourBefAft'] . ":" . $_POST['EventStartTimeMinuteBefAft'] . "' AND ID IN (SELECT ID FROM CalendarEvent WHERE EventStartTimeAMPM='AM' OR EventStartTimeAMPM='PM') ORDER BY EventStartTime " . $_POST['Ordering'] . ";";
         }
         $attr="After Start Time";
      }
   }
   if(isset($_POST['EventLocationExact']))
   {
      $sql = "SELECT * FROM CalendarEvent WHERE Location='" . $_POST['EventLocationExact'] . "' ORDER BY Location " . $_POST['Ordering'] . ";";
      $attr="Exact Location";
   }
   if(isset($_POST['EventLocationLike']))
   {
      $sql = "SELECT * FROM CalendarEvent WHERE Location LIKE '%" . $_POST['EventLocationLike'] . "%' ORDER BY Location " . $_POST['Ordering'] . ";";
      $attr="Like-Location";
   }
   if(isset($_POST['EventDescriptionLike']))
   {
      $sql = "SELECT * FROM CalendarEvent WHERE Description LIKE '%" . $_POST['EventDescriptionLike'] . "%' ORDER BY Description " . $_POST['Ordering'] . ";";
      $attr="Like-Description";
   }
   
   echo "<html><head><h1>Search Results (Event by " . $attr . ")</h1></head>";
   //echo $sql."<br>"; 
     
   //Run the query 
   if($result=mysqli_query($link,$sql)) 
   {
   
      echo '<table align="center" style="width:100%">
            <tr>
	            <th>ID</th>
            	<th>Title</th>
            	<th>Category</th>
            	<th>EventDate</th>
            	<th>EventStartTime</th>
            	<th>EventStartTimeAMPM</th>
            	<th>Location</th>
               <th>Description</th>
               <th>Media1</th>
               <th>Media2</th>
               <th>Media3</th>
               <th>Edit Event</th>
            </tr>';
            
      //Loop through all entries
        while($row = mysqli_fetch_array($result)) {
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
}    
catch(Exception $e)
{
   $message = 'Unable to process request';
}

?>   

   <form action="searchAttributeMenu.php" method="post">
      <input type="submit" value="Return"/>
   </form>

    <body>
    <p><?php echo $message; ?>
    </body>
    
</html>
