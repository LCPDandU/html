<html>
<body>
  <h2>Create Account</h2>
  <form action="addUserSubmit.php" method="post">
  <fieldset>
    <p>
      <label>Name:</label>
      <input type="text" name="Name" value="" maxlength="128" />
      <i>(maximum length of 128 characters)</i>
    </p>
    <p>
      <label>Login ID:</label>
      <input type="text" name="LoginID" value="" minlength="4" maxlength="32" />
      <i>(Login ID must be between 4 and 32 characters long)</i>
    </p>
    <p>
      <label>Password:</label>
      <input type="password" name="Password" value="" minlength="7" maxlength="32" />
      <i>(Password must be between 7 and 32 characters long)</i>
    </p>
    <p>
      <input type="submit" value="Create" />
    </p>
  </fieldset>
  </form>  
</body>
</html>