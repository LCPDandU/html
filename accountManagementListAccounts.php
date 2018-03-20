<?php
include ('header.php');
include('config.php');

/***********************************************************
 * Output all of the user accounts info onto the screen in *
 * descending order based on the account's id.             *
 ***********************************************************/
echo "<html><head><h1>Account List</h1></head>";

try
{
  $link = connectDB();
  $sql = "SELECT * FROM User ORDER BY ID DESC;";

  if($result = mysqli_query($link, $sql))
  {
    echo '<table align="center" style="width:100%">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>LoginID</th>
            <th>AccountStatus</th>
            <th>Edit Account</th>
          </tr>';

    while($row = mysqli_fetch_array($result))
    {
      echo '<tr><td align="center">' .
        $row['ID'] . '</td><td align="center">' .
        $row['Name'] . '</td><td align="center">' .
        $row['LoginID'] . '</td><td align="center">' .
        $row['AccountStatus'] . '</td><td align="center">';

      echo '<form action="accountManagementAccountInfo" method="post">' .
           '<input type="hidden" name="ID" value="'.$row['ID'].'"/>' .
           '<input type="submit" value="Manage Account Info"/>' .
           '</form>' .
           '</td>';

      echo '</tr>';
    }//end while
    echo "</tr>";
  }//end if
}//end try
catch(Exception $e)
{
  $message = 'Unable to process request';
}
?>

  <body>
  <p><?php echo $message; ?></p>
  </body>

</html>
