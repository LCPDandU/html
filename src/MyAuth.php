<?php

// Authorization class. Purpose is to verify that the token used in the REST address
//  is a valid token.
class MyAuth
{
    // Need to search database for token
    public function getUserByToken($token)
    {
      // Check if the token used exists in the database.
      // Need to also check if any found token's timestamp has not expired.
      $sql = "SELECT * FROM User WHERE token = '$token'";

          // Get the database object.
          $db = new db();
          // Call connect to connect to database.
          $db = $db->connect();

          // PHP Data Objects (PDO) statements.
          $stmt = $db->query($sql);
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $db = null;

      // Throw an error if the SQL query returns no results,
      //  aka, the token used is not in the database.
      if (! $row) {

        // Throws error, which is useful for debugging, but needs
        //  to be removed and replaced for the final product.
        throw new UnauthorizedException('Invalid Token');
      }
    }
  }

// Token authentication error used with the Slim Framework.
use Slim\Middleware\TokenAuthentication\UnauthorizedExceptionInterface;

class UnauthorizedException extends \Exception implements UnauthorizedExceptionInterface
{

}
