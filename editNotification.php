<?php

//to connect to the database we do this
include('config.php');

//to include header hyperlinks
include('header.php');
echo "<html>";

if(!isset($_POST['NotificationID']))
{
   $countDown=5;
   echo "<body><p>Invalid request. Redirecting to \"See All Notifications List\" Page in ".$countDown." seconds.</p></body></html>";
   header('refresh: '.$countDown.'; url=seeAllNotificationsList.php');
   exit();
}
else
{
   try
   {
      //Connect to MySQL Database  mysqli(Server,User,Password,Database) 
      $link = connectDB();
        
        
      // Prep SQL statement which pull all events and order them by ID in descending order 
      $sql = "SELECT * FROM Notification WHERE ID=".$_POST['NotificationID'].";";
      //echo $sql."<br>"; 
        
      //Run the query 
      if($result=mysqli_query($link,$sql)) 
      {
               
         //Set variables from query (store query information)
         while($row = mysqli_fetch_assoc($result)) {
            
            $ID=$_POST['NotificationID'];
            $Title=$row['Title'];
            $Description=$row['Description'];
            $Date=$row['PostDate'];
            $Time=$row['PostTime'];
            
            $TimeB=date('h:i a',strtotime($Time));
            preg_match("/([0-9]{1,2}):([0-9]{1,2}) ([a-zA-Z]+)/", $TimeB, $TimeSeparated);
            $TimeHour=$TimeSeparated[1];
            $TimeMinute=$TimeSeparated[2];
            
            $AMPM=$row['PostTimeAMPM'];
                
         }
       
      }
      
      
   }    
   catch(Exception $e)
   {
      $message = 'Unable to process request';
   }
}

?>   

<form action="editNotificationSubmit.php" method="post">
   <fieldset>
      <h1><strong>Create Notification</strong></h1>
      
      <input type="hidden" name="NotificationID" value="<?php echo $ID;?>"/>
      
      <p>
      <label>Title</label>
         <input type="text" name="NotificationTitle" value="<?php echo $Title;?>" maxlength="128" required/>
         <i>(maximum of 128 characters)</i>
      </p>
      
      <p>
      <label>Description</label>
         <!--<input type="text" name="NotificationDescription" maxlength="4096" required/>-->
         <textarea name="NotificationDescription" maxlength="4096" rows="10" cols="45" required><?php echo $Description;?></textarea>
         <i>(maximum of 4096 characters)</i>
      </p>
      
      <p>
      <label>Notification Date</label>
         <input type="date" name="PostDate" value="<?php echo $Date;?>" required/>
         <i>(enter date in YYYY-MM-DD form if typing manually)</i>
      </p>
      
      <p>
      <label>Notification Post Time</label>
         <input type="number" name="PostTimeHour" value="<?php echo $TimeHour;?>" min="1" max="12" required/>
          : 
         <input type="number" name="PostTimeMinute" value="<?php echo $TimeMinute;?>" min="0" max="59" required/>
         
         <?php if ($AMPM == "AM") { ?>  
         <select name="PostTimeAMPM">
            <option value="AM" selected>AM</option>
            <option value="PM">PM</option>
         </select> 
         <?php } ?> 
         
         <?php if ($AMPM == "PM") { ?>  
         <select name="PostTimeAMPM">
            <option value="AM">AM</option>
            <option value="PM" selected>PM</option>
         </select> 
         <?php } ?> 
         
         <i>(First field is hour, Second is minute)</i>
      </p>
      
      <p>
         <input type="submit" value="Edit Notification"/>
      </p>
      
   </fieldset>
</form>


   <form action="seeAllNotificationsList.php" method="post">
      <input type="submit" value="Back"/>
   </form>
    <body>
    <p><?php echo $message; ?></p>
    </body>
</html>