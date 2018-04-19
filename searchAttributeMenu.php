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
  <p>Search Options <i>(Selecting "None" will not use that attribute in the search)</i></p>
  </p> 
  <table>
  <tr><div>
   <td><label>Title</label></td>
       <td><input type="radio" name="EventTitleOption" value="None" checked/><label>None</label></td>
       <td><input type="radio" name="EventTitleOption" value="EventTitleExact"/><label>Exact Title</label></td>
       <td><input type="radio" name="EventTitleOption" value="EventTitleLike"/><label>Like-Title</label></td>
  </div></tr>
  <tr><div>
   <td><label>Category</label></td>
       <td><input type="radio" name="EventCategoryOption" value="None" checked/><label>None</label></td>
       <td><input type="radio" name="EventCategoryOption" value="EventCategoryExact"/><label>Exact Category</label></td>
  </div></tr>
  <tr><div>
   <td><label>Date</label></td>
       <td><input type="radio" name="EventDateOption" value="None" checked/><label>None</label></td>
       <td><input type="radio" name="EventDateOption" value="EventDateExact"/><label>Exact Date</label></td>
       <td><input type="radio" name="EventDateOption" value="EventDateRange"/><label>Date Range</label></td>
       <td><input type="radio" name="EventDateOption" value="EventDateBefAft"/><label>Before/After Date</label></td>
  </div></tr>
  <tr><div>
   <td><label>Start Time</label></td>
       <td><input type="radio" name="EventStartTimeOption" value="None" checked/><label>None</label></td>
       <td><input type="radio" name="EventStartTimeOption" value="EventStartTimeExact"/><label>Exact Start Time</label></td>
       <td><input type="radio" name="EventStartTimeOption" value="EventStartTimeBefAft"/><label>Before/After Start Time</label></td>
  </div></tr>
  <tr><div>
   <td><label>Location</label></td>
       <td><input type="radio" name="EventLocationOption" value="None" checked/><label>None</label></td>
       <td><input type="radio" name="EventLocationOption" value="EventLocationExact"/><label>Exact Location</label></td>
       <td><input type="radio" name="EventLocationOption" value="EventLocationLike"/><label>Like-Location</label></td>
  </div></tr>
  <tr><div>
   <td><label>Description</label></td>
       <td><input type="radio" name="EventDescriptionOption" value="None" checked/><label>None</label></td>
       <td><input type="radio" name="EventDescriptionOption" value="EventDescriptionLike"/><label>Like-Description</label></td>
  </div></tr>
  <tr>
      <td><input type="submit" value="Next"/></td>
  </tr>  
  </table>
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