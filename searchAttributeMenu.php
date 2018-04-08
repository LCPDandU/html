<?php include('header.php');?>
<html>

<head>
<title></title>
</head>

<!--<body style = "Color: #000000; background-color:#afbfff;">-->
<body>

  <form action="searchSingleAttributeInputEvent.php" method="post">
  <fieldset>
  <h1><strong>Search Events (Single Attribute)</strong></h1>
  <p>
  <label>Attribute</label>
      <select name="Attribute">
         <option value="EventTitle" selected>Title</option>
         <option value="EventCategory">Category</option>
         <option value="EventDate">Date</option>
         <option value="EventStartTime">Start Time</option>
         <option value="EventLocation">Location</option>
         <option value="EventDescription">Description</option>
      </select>
  </p> 
  <p>
      <input type="submit" value="Next"/>
  </p>  
  </fieldset>
  </form>
  
  
  
  <form action="searchSingleAttributeInputNotification.php" method="post">
  <fieldset>
  <h1><strong>Search Notifications (Single Attribute)</strong></h1>
  <p>
  <label>Attribute</label>
      <select name="Attribute">
         <option value="NotificationTitle" selected>Title</option>
         <option value="NotificationDescription">Description</option>
         <option value="NotificationDate">Date</option>
         <option value="NotificationPostTime">Post Time</option>
      </select>
  </p> 
  <p>
      <input type="submit" value="Next"/>
  </p>  
  </fieldset>
  </form>
  
  
  <form action="searchAttributeInputEvent.php" method="post">
  <fieldset>
  <h1><strong>Search Events (Multiple Attributes)</strong></h1>
  <p>Only exact values can be searched using this function</p>
  </p> 
  <div>
   <input type="checkbox" name="EventTitle" value="EventTitleSet"/>
   <label>Title</label>
  </div>
  <div>
   <input type="checkbox" name="EventCategory" value="EventCategorySet"/>
   <label>Category</label>
  </div>
  <div>
   <input type="checkbox" name="EventDate" value="EventDateSet"/>
   <label>Date</label>
  </div>
  <div>
   <input type="checkbox" name="EventStartTime" value="EventStartTimeSet"/>
   <label>Start Time</label>
  </div>
  <div>
   <input type="checkbox" name="EventLocation" value="EventLocationSet"/>
   <label>Location</label>
  </div>
  <div>
   <input type="checkbox" name="EventDescription" value="EventDescriptionSet"/>
   <label>Description</label>
  </div>
  <p>
      <input type="submit" value="Next"/>
  </p>  
  </fieldset>
  </form>
  
  
  <form action="searchAttributeInputNotification.php" method="post">
  <fieldset>
  <h1><strong>Search Notifications (Multiple Attributes)</strong></h1>
  <p>Only exact values can be searched using this function</p>
  <p>Only exact values can be searched using this function</p>
  </p> 
  <div>
   <input type="checkbox" name="NotificationTitle" value="NotificationTitleSet"/>
   <label>Title</label>
  </div>
  <div>
   <input type="checkbox" name="NotificationDescription" value="NotificationDescriptionSet"/>
   <label>Description</label>
  </div>
  <div>
   <input type="checkbox" name="NotificationDate" value="NotificationDateSet"/>
   <label>Date</label>
  </div>
  <div>
   <input type="checkbox" name="NotificationPostTime" value="NotificationPostTimeSet"/>
   <label>Post Time</label>
  </div>
  <p>
      <input type="submit" value="Next"/>
  </p>   
  </fieldset>
  </form>
  
  
</body>

</html>