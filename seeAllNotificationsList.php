<?php

//to connect to the database we do this
include('config.php');

//to include header hyperlinks
include('header.php');

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
if(isset($_GET['sort']))
{
   if($_GET['sort']=='desc'){$sort='DESC';$sorting='Descending';}
   else if($_GET['sort']=='asc'){$sort='ASC';$sorting='Ascending';}
   else{$sort='DESC';$sorting='Descending';}
}
else
{
   $sort='DESC';$sorting='Descending';
}

echo "<html><head><h1>See All Notifications List</h1></head>";

 
try
{
   //Connect to MySQL Database  mysqli(Server,User,Password,Database) 
   $link = connectDB();
     
     
   // Prep SQL statement which will pull all notifications and order them by ID in descending order 
   //$sql = "SELECT * FROM Notification ORDER BY ID DESC;";
   
   $sql = "SELECT * FROM Notification ORDER BY $order $sort;";
   
   //echo $sql."<br>"; 
     
   //Run the query 
   if($result=mysqli_query($link,$sql)) 
   {
      $sort == 'DESC' ? $sort = 'asc' : $sort = 'desc';
   
      echo '<table align="center" style="width:100%">
            <tr>
	            <th><a href="?order=ID&&sort='.$sort.'">ID</a></th>
            	<th><a href="?order=Title&&sort='.$sort.'">Title</a></th>
            	<th><a href="?order=Description&&sort='.$sort.'">Description</a></th>
            	<th><a href="?order=PostDate&&sort='.$sort.'">PostDate</a></th>
            	<th><a href="?order=PostTime&&sort='.$sort.'">PostTime</a></th>
            	<th><a href="?order=PostTimeAMPM&&sort='.$sort.'">PostTimeAMPM</a></th>
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