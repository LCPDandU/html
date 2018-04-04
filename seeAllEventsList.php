<?php

//to connect to the database we do this
include('config.php');

//to include header hyperlinks
include('header.php');
echo "<html><head><h1>See All Events List</h1></head>";
 
try
{
   //Connect to MySQL Database  mysqli(Server,User,Password,Database) 
   $link = connectDB();
     
     
   // Prep SQL statement which pull all events and order them by ID in descending order 
   $sql = "SELECT * FROM CalendarEvent ORDER BY ID DESC;";
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

   <form action="seeAllMenu.php" method="post">
      <input type="submit" value="Return"/>
   </form>

    <body>
    <p><?php echo $message; ?>
    </body>
    
</html>
