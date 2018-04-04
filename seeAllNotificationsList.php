<?php

//to connect to the database we do this
include('config.php');

//to include header hyperlinks
include('header.php');
echo "<html><head><h1>See All Notifications List</h1></head>";

 
try
{
   //Connect to MySQL Database  mysqli(Server,User,Password,Database) 
   $link = connectDB();
     
     
   // Prep SQL statement which will pull all notifications and order them by ID in descending order 
   $sql = "SELECT * FROM Notification ORDER BY ID DESC;";
   //echo $sql."<br>"; 
     
   //Run the query 
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
            
      //Loop through all entries
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
              '<input type="hidden" name="NotificationID" value="'.$row['ID'].'"/>' .
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