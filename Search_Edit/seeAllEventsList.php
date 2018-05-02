<?php

//to connect to the database we do this
include('../config.php');

//to include header hyperlinks
include('../header.php');

/*Processing of URL variables 'order' and 'sort'*/
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


echo "<html><head><h1>See All Events List <i>(Order By ".$order.", ".$sorting." Sorting)</i></h1>";
 
// REST url
$url = URL_START .'/public/api/events/order/'.$order.'/sort/'.$sort;

//open the file generated by the REST API
$handle=fopen($url,"r");
if($handle){
   while(($line=fgets($handle))!==false){
      
      $sort == 'DESC' ? $sort = 'asc' : $sort = 'desc';
      
      //Table headers are generated
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
         
         //Media fields
         echo $row['Media1'] . '</td><td align="center">' . 
              $row['Media2'] . '</td><td align="center">' .
              $row['Media3'] . '</td><td align="center">' ;
              
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

   <form action="seeAllMenu.php" method="post">
      <input type="submit" value="Return"/>
   </form>

    <body>
    <p><?php echo $message; ?>
    </body>
    
</html>