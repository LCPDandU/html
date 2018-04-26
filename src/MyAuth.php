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
      $sql = "SELECT TokenStamp FROM User WHERE Token = '$token'";

      // Get DB object
      $configDB = parse_ini_file('../../db.ini');
      $db = new db($configDB['DB_HOST'],$configDB['DB_USER'],$configDB['DB_PWD'],$configDB['DB_NAME']);
          // Call connect to connect to database.
          $db = $db->connect();

          // PHP Data Objects (PDO) statements.
          $stmt = $db->query($sql);
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $db = null;

      // Throw an error if the SQL query returns no results,
      //  aka, the token used is not in the database.
      if (! $row) {
        throw new UnauthorizedException('Invalid Token');
      }

      // Check if timestamp is valid (valid for 4 hours)
      $timestamp = $row['TokenStamp'];
      if (strtotime($timestamp) <= strtotime('-4 hours')) {
                throw new UnauthorizedException('Invalid Token');
              }

    }
  }

// Token authentication error used with the Slim Framework.
use Slim\Middleware\TokenAuthentication\UnauthorizedExceptionInterface;

class UnauthorizedException extends \Exception implements UnauthorizedExceptionInterface
{

}
