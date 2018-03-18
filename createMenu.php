<?php include('header.php');?>
<html>

<!--The form for creating a CalendarEvent-->
<form action="createNewEvent.php" method="post">
   <fieldset>
   
      <h1><strong>Create Event</strong></h1>
   
      <p>
         <label>Title</label>
         <input type="text" name="EventTitle" value="" maxlength="128" required/>
         <i>(maximum of 128 characters)</i>
      </p>
      
      <p>
         <label>Category</label>
         <select name="EventCategory">
            <option value="LCPD" selected>LCPD</option>
            <option value="LCFD">LCFD</option>
            <option value="AnimalControl">Animal Control</option>
            <option value="Public">Public</option>
         </select> 
      </p>
      
      <p>
      <label>Event Date</label>
         <input type="date" name="EventDate" value="" required/>
         <i>(enter date in YYYY-MM-DD form if typing manually)</i>
      </p>
      
      <p>
      <label>Event Start Time</label>
         <input type="number" name="EventStartTimeHour" min="1" max="12" required/>
          : 
         <input type="number" name="EventStartTimeMinute" min="0" max="59" required/>
         <select name="EventStartTimeAMPM">
            <option value="AM" selected>AM</option>
            <option value="PM">PM</option>
         </select>
         <i>(First field is hour, Second is minute)</i>
      </p>
      
      <p>
      <label>Location</label>
         <input type="text" name="EventLocation" maxlength="128" required/>
         <i>(maximum of 128 characters)</i>
      </p>
      
      <p>
      <label>Description</label>
         <!--<input type="text" name="EventDescription" maxlength="2048" required/>-->
         <textarea name="EventDescription" maxlength="2048" rows="10" cols="45" required> </textarea>
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
         <input type="submit" value="Create New Event"/>
      </p>
      
   </fieldset>
</form>

<form action="createNewNotification.php" method="post">
   <fieldset>
      <h1><strong>Create Notification</strong></h1>
      
      <p>
      <label>Title</label>
         <input type="text" name="NotificationTitle" maxlength="128" required/>
         <i>(maximum of 128 characters)</i>
      </p>
      
      <p>
      <label>Description</label>
         <!--<input type="text" name="NotificationDescription" maxlength="4096" required/>-->
         <textarea name="NotificationDescription" maxlength="4096" rows="10" cols="45" required></textarea>
         <i>(maximum of 4096 characters)</i>
      </p>
      
      <p>
      <label>Notification Date</label>
         <input type="date" name="PostDate" value="" required/>
         <i>(enter date in YYYY-MM-DD form if typing manually)</i>
      </p>
      
      <p>
      <label>Notification Post Time</label>
         <input type="number" name="PostTimeHour" min="1" max="12" required/>
          : 
         <input type="number" name="PostTimeMinute" min="0" max="59" required/>
         <select name="PostTimeAMPM">
            <option value="AM" selected>AM</option>
            <option value="PM">PM</option>
         </select>
         <i>(First field is hour, Second is minute)</i>
      </p>
      
      <p>
         <input type="submit" value="Create New Notification"/>
      </p>
      
   </fieldset>
</form>


</html>