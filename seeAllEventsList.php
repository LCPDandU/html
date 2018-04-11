<?php

//to connect to the database we do this
include('config.php');

//to include header hyperlinks
include('header.php');

if(isset($_GET['order']))
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

/*if(isset($_POST['TitleSearch']))
{
   $titleSearch=$_POST['TitleSearch'];
   $searchCriteria=$searchCriteria."Title, ";
}
else
{
   $titleSearch="";
}*/
 
//echo "<html><head><h1>See All Events List <i>(Order By ".$order.", ".$sorting." Sorting)</i></h1></head>";
echo "<html><head><h1>See All Events List <i>(Order By ".$order.", ".$sorting." Sorting)</i></h1>";
echo "<h2><i>Search By: ".$searchCriteria."</i></h2></head>";
 
try
{
   //Connect to MySQL Database  mysqli(Server,User,Password,Database) 
   $link = connectDB();
     
     
   // Prep SQL statement which pull all events and order them by ID in descending order 
   //$sql = "SELECT * FROM CalendarEvent ORDER BY ID DESC;";
   
   $sql = "SELECT * FROM CalendarEvent ORDER BY $order $sort;";
   //echo $order.", ";
   //echo $sort.", ";
   //echo $sql;
   
   //echo $sql."<br>"; 
     
   //Run the query 
   if($result=mysqli_query($link,$sql)) 
   {
      $sort == 'DESC' ? $sort = 'asc' : $sort = 'desc';
   
      echo '<table align="center" style="width:100%">
            <tr>
	            <th><a href="?order=ID&&sort='.$sort.'">ID</a></th>
            	<th><a href="?order=Title&&sort='.$sort.'">Title</a></th>
            	<th><a href="?order=Category&&sort='.$sort.'">Category</a></th>
            	<th><a href="?order=EventDate&&sort='.$sort.'">EventDate</a></th>
            	<th><a href="?order=EventStartTime&&sort='.$sort.'">EventStartTime</a></th>
            	<th><a href="?order=EventStartTimeAMPM&&sort='.$sort.'">EventStartTimeAMPM</a></th>
            	<th><a href="?order=Location&&sort='.$sort.'">Location</a></th>
               <th><a href="?order=Description&&sort='.$sort.'">Description</a></th>
               <th>Media1</th>
               <th>Media2</th>
               <th>Media3</th>
               <th>Edit Event</th>
            </tr>';
            //<tr>
            //   <form action="seeAllEventsList.php" method="post">
            //   <th><input type="text" name="TitleSearch"/></th>
            //   <input type="hidden" name="prevSQL" value="'.$sql.'"/>
            //   <th><input type="submit" value="Submit"/></th>
            //   </form>
            //</tr>';
            
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
