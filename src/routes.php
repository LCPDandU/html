<?php
# Creates routes that deal with request and response objects.
# Slim supports psr 7.
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

/*********************************************
NOTIFICATIONS
*********************************************/

# Get all notifications.
$app->get('/api/notifications', function(Request $request, Response $response){
    $sql = "SELECT * FROM Notification";

    try{
      // Get DB object
      $db = new db();
      // Call connect; connect to database.
      $db = $db->connect();

      # PDO statement
      $stmt = $db->query($sql);
      $notifications = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      echo json_encode($notifications);
    } catch(PDOException $e){
      echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

# Get notification by ID.
$app->get('/api/notifications/id/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM Notification WHERE id = $id";

    try{
      // Get DB object
      $db = new db();
      // Call connect; connect to database.
      $db = $db->connect();

      # PDO statement
      $stmt = $db->query($sql);
      $notification = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      echo json_encode($notification);
    } catch(PDOException $e){
      echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

# Get notification by title.
$app->get('/api/notifications/title/{title}', function(Request $request, Response $response){
    $title = $request->getAttribute('title');

    $sql = "SELECT * FROM Notification WHERE title LIKE '$title'";

    try{
      // Get DB object
      $db = new db();
      // Call connect; connect to database.
      $db = $db->connect();

      # PDO statement
      $stmt = $db->query($sql);
      $notification = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      echo json_encode($notification);
    } catch(PDOException $e){
      echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

# Get notification by date.
$app->get('/api/notifications/date/day/{date}', function(Request $request, Response $response){
    $date = $request->getAttribute('date');

    $sql = "SELECT * FROM Notification WHERE postdate LIKE '$date'";

    try{
      // Get DB object
      $db = new db();
      // Call connect; connect to database.
      $db = $db->connect();

      # PDO statement
      $stmt = $db->query($sql);
      $notification = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      echo json_encode($notification);
    } catch(PDOException $e){
      echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

# Get notification by month.
$app->get('/api/notifications/date/month/{date}', function(Request $request, Response $response){
    $date = $request->getAttribute('date');

    $sql = "SELECT * FROM Notification WHERE postdate LIKE '$date-__'";

    try{
      // Get DB object
      $db = new db();
      // Call connect; connect to database.
      $db = $db->connect();

      # PDO statement
      $stmt = $db->query($sql);
      $notification = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      echo json_encode($notification);
    } catch(PDOException $e){
      echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

/*********************************************
EVENTS
*********************************************/

# Get all events.
$app->get('/api/events', function(Request $request, Response $response){
    $sql = "SELECT * FROM CalendarEvent";

    try{
      // Get DB object
      $db = new db();
      // Call connect; connect to database.
      $db = $db->connect();

      # PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      echo json_encode($events);
    } catch(PDOException $e){
      echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

/*********************************************
USERS
*********************************************/

# Get all users.
$app->get('/api/users', function(Request $request, Response $response){
    $sql = "SELECT * FROM User";

    try{
      // Get DB object
      $db = new db();
      // Call connect; connect to database.
      $db = $db->connect();

      # PDO statement
      $stmt = $db->query($sql);
      $notifications = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      echo json_encode($notifications);
    } catch(PDOException $e){
      echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
