<?php
class Auth
{
    // Need to search database for token
    public function getUserByToken($token)
    {
    //          $LoginID = $_SESSION['LoginID'];

    //      $sql = "SELECT * FROM user WHERE LoginID = '$LoginID' AND Token = '$token'";
      $sql = "SELECT * FROM User WHERE token = '$token'";

          // Get DB object
          $db = new db();
          // Call connect; connect to database.
          $db = $db->connect();

          # PDO statement
          $stmt = $db->query($sql);
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $db = null;

      if (! $row) {
            throw new UnauthorizedException('Invalid Token');
      }
    }
  }
use Slim\Middleware\TokenAuthentication\UnauthorizedExceptionInterface;

class UnauthorizedException extends \Exception implements UnauthorizedExceptionInterface
{

}
