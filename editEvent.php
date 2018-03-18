<?php

//to connect to the database we do this
include('config.php');

//to include header hyperlinks
include('header.php');
echo "<html>";

if(!isset($_POST['EventID']))
{
   $countDown=5;
   echo "<body><p>Invalid request. Redirecting to \"See All Events List\" Page in ".$countDown." seconds.</p></body></html>";
   header('refresh: '.$countDown.'; url=seeAllEventsList.php');
   exit();
}
else
{
   try
   {
      //Connect to MySQL Database  mysqli(Server,User,Password,Database) 
      $link = connectDB();
        
        
      // Prep SQL statement which pull all events and order them by ID in descending order 
      $sql = "SELECT * FROM CalendarEvent WHERE ID=".$_POST['EventID'].";";
      //echo $sql."<br>"; 
        
      //Run the query 
      if($result=mysqli_query($link,$sql)) 
      {
               
         //Set variables from query (store query information)
         while($row = mysqli_fetch_assoc($result)) {
            
            $ID=$_POST['EventID'];
            $Title=$row['Title'];
            $Category=$row['Category'];
            $Date=$row['EventDate'];
            $Time=$row['EventStartTime'];
            
            $TimeB=date('h:i a',strtotime($Time));
            preg_match("/([0-9]{1,2}):([0-9]{1,2}) ([a-zA-Z]+)/", $TimeB, $TimeSeparated);
            $TimeHour=$TimeSeparated[1];
            $TimeMinute=$TimeSeparated[2];
            
            $AMPM=$row['EventStartTimeAMPM'];
            $Location=$row['Location'];
            $Description=$row['Description'];
            //media not yet implemented
                
         }
       
      }
      
      
   }    
   catch(Exception $e)
   {
      $message = 'Unable to process request';
   }
}

?>   

<form action="editEventSubmit.php" method="post">
   <fieldset>
   
      <h1><strong>Edit Event</strong></h1>
   
      <input type="hidden" name="EventID" value="<?php echo $ID;?>"/>
   
      <p>
         <label>Title</label>
         <input type="text" name="EventTitle" value="<?php echo $Title;?>" maxlength="128" required/>
         <i>(maximum of 128 characters)</i>
      </p>
      
      <p>
         <label>Category</label>
         
         <?php if ($Category == "LCPD") { ?>  
         <select name="EventCategory">
            <option value="LCPD" selected>LCPD</option>
            <option value="LCFD">LCFD</option>
            <option value="AnimalControl">Animal Control</option>
            <option value="Public">Public</option>
         </select> 
         <?php } ?>
         
         <?php if ($Category == "LCFD") { ?>  
         <select name="EventCategory">
            <option value="LCPD">LCPD</option>
            <option value="LCFD" selected>LCFD</option>
            <option value="AnimalControl">Animal Control</option>
            <option value="Public">Public</option>
         </select> 
         <?php } ?>
         
         <?php if ($Category == "AnimalControl") { ?>  
         <select name="EventCategory">
            <option value="LCPD">LCPD</option>
            <option value="LCFD">LCFD</option>
            <option value="AnimalControl" selected>Animal Control</option>
            <option value="Public">Public</option>
         </select> 
         <?php } ?>
         
         <?php if ($Category == "Public") { ?>  
         <select name="EventCategory">
            <option value="LCPD">LCPD</option>
            <option value="LCFD">LCFD</option>
            <option value="AnimalControl">Animal Control</option>
            <option value="Public" selected>Public</option>
         </select> 
         <?php } ?>  
           
      </p>
      
      <p>
      <label>Event Date</label>
         <input type="date" name="EventDate" value="<?php echo $Date;?>" required/>
         <i>(enter date in YYYY-MM-DD form if typing manually)</i>
      </p>
      
      <p>
      <label>Event Start Time</label>
         <input type="number" name="EventStartTimeHour" value="<?php echo $TimeHour;?>" min="1" max="12" required/>
          : 
         <input type="number" name="EventStartTimeMinute" value="<?php echo $TimeMinute;?>" min="0" max="59" required/>
         
         <?php if ($AMPM == "AM") { ?>  
         <select name="EventStartTimeAMPM">
            <option value="AM" selected>AM</option>
            <option value="PM">PM</option>
         </select> 
         <?php } ?> 
         
         <?php if ($AMPM == "PM") { ?>  
         <select name="EventStartTimeAMPM">
            <option value="AM">AM</option>
            <option value="PM" selected>PM</option>
         </select> 
         <?php } ?> 
         
         <i>(First field is hour, Second is minute)</i>
      </p>
      
      <p>
      <label>Location</label>
         <input type="text" name="EventLocation" value="<?php echo $Location;?>" maxlength="128" required/>
         <i>(maximum of 128 characters)</i>
      </p>
      
      <p>
      <label>Description</label>
         <!--<input type="text" name="EventDescription" maxlength="2048" required/>-->
         <textarea name="EventDescription" maxlength="2048" rows="10" cols="45" required><?php echo $Description;?></textarea>
         <i>(maximum of 2048 characters)</i>
      </p>
      
      <p>
      <label>Media 1</label>
      <i>(not yet implemented)</i>
      </p>
      
      <p>
      <label>Media 2</label>
      <i>(not yet implemented)</i>
      </p>
      
      <p>
      <label>Media 3</label>
      <i>(not yet implemented)</i>
      </p>
      
      <p>
         <input type="submit" value="Edit Event"/>
      </p>
      
   </fieldset>
</form>

   <form action="seeAllEventsList.php" method="post">
      <input type="submit" value="Back"/>
   </form>
    <body>
    <p><?php echo $message; ?></p>
    </body>
</html>