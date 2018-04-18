<?php
# Creates routes that deal with request and response objects.
# Slim supports psr 7.
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Slim\App;
use Slim\Middleware\TokenAuthentication;

require 'MyAuth.php';

$config = [
    'settings' => [
        'displayErrorDetails' => true,
  //      'addContentLengthHeader' => false
    ]
];

$app = new App($config);

$authenticator = function($request, TokenAuthentication $tokenAuth){

    // Try find authorization token via header, parameters, cookie or attribute
    //  If token not found, return response with status 401 (unauthorized)
    $token = $tokenAuth->findToken($request);

    //  Call authentication logic class
    $auth = new MyAuth();

    // Verify if token is valid on database
    //  If token isn't valid, must throw an UnauthorizedExceptionInterface
    $auth->getUserByToken($token);

};

$app->add(new TokenAuthentication([
    'path' =>   '/api/notifications/add',
//    'path' =>   '/api/restrict',
    'authenticator' => $authenticator
]));

/*********************************************
GET: NOTIFICATIONS
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

# Get notification by title.  (Like-Title)
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

# Get notification by date. (Exact Date)
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

#Get all notifications ordered
$app->get('/api/notifications/order/{order}/sort/{sort}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   $sql = "SELECT * FROM Notification ORDER BY $order $sort";
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $notifications = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($notifications);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all notifications by exact Title
$app->get('/api/notifications/order/{order}/sort/{sort}/TitleExact/{title}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $title = $request->getAttribute('title');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   $sql = "SELECT * FROM Notification WHERE Title='$title' ORDER BY $order $sort";
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all notifications by like-Title
$app->get('/api/notifications/order/{order}/sort/{sort}/TitleLike/{title}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $title = $request->getAttribute('title');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   $sql = "SELECT * FROM Notification WHERE Title LIKE '%$title%' ORDER BY $order $sort";
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all notifications by like-Description
$app->get('/api/notifications/order/{order}/sort/{sort}/DescriptionLike/{description}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $description = $request->getAttribute('description');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   $sql = "SELECT * FROM Notification WHERE Description LIKE '%$description%' ORDER BY $order $sort";
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all notifications by exact Date
$app->get('/api/notifications/order/{order}/sort/{sort}/PostDateExact/{date}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $date = $request->getAttribute('date');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   $sql = "SELECT * FROM Notification WHERE PostDate='$date' ORDER BY $order $sort";
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all notifications by Date Range
$app->get('/api/notifications/order/{order}/sort/{sort}/PostDateA/{dateA}/PostDateB/{dateB}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $dateA = $request->getAttribute('dateA');
   $dateB = $request->getAttribute('dateB');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   $sql = "SELECT * FROM Notification WHERE PostDate BETWEEN '$dateA' AND '$dateB' ORDER BY $order $sort";
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all notificaions by Before/After Date
$app->get('/api/notificaions/order/{order}/sort/{sort}/PostDateBefAft/{date}/BefAft/{befaft}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $date = $request->getAttribute('date');
   $processedbefaft = $request->getAttribute('befaft');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   if($processedbefaft=='Before'||$processedbefaft=='After')
   {
      $befaft=$processedbefaft;
   }
   else if($processedbefaft=='before'){
      $befaft='Before';
   }
   else if($processedbefaft=='after'){
      $befaft='After';
   }
   else{
      $befaft='After';
   }
   
   if($beftaft=='After'){
      $sql = "SELECT * FROM Notification WHERE PostDate>='$date' ORDER BY $order $sort";
   }
   //$befaft must be Before
   else{
      $sql = "SELECT * FROM Notification WHERE PostDate<='$date' ORDER BY $order $sort";
   }
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all notifications by exact StartTime
$app->get('/api/notifications/order/{order}/sort/{sort}/PostTimeHourExact/{hour}/PostTimeMinuteExact/{minute}/PostTimeAMPM/{ampm}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $hour = $request->getAttribute('hour');
   $minute = $request->getAttribute('minute');
   $processedampm = $request->getAttribute('ampm');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   if($processedampm=='PM'||$processedampm=='AM')
   {
      $ampm=$processedampm;
   }
   else if($processedampm=='am'){
      $ampm='AM';
   }
   else if($processedampm=='pm'){
      $ampm='PM';
   }
   else{
      $ampm='AM';
   }
   
   $sql = "SELECT * FROM Notification WHERE PostTime='$hour:$minute' AND PostStartTimeAMPM='$ampm' ORDER BY $order $sort";
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all notifications by Before/After StartTime
$app->get('/api/notifications/order/{order}/sort/{sort}/PostTimeHourBefAft/{hour}/PostTimeMinuteBefAft/{minute}/PostTimeAMPM/{ampm}/BefAft/{befaft}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $hour = $request->getAttribute('hour');
   $minute = $request->getAttribute('minute');
   $processedampm = $request->getAttribute('ampm');
   $processedbefaft = $request->getAttribute('befaft');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   if($processedampm=='PM'||$processedampm=='AM')
   {
      $ampm=$processedampm;
   }
   else if($processedampm=='am'){
      $ampm='AM';
   }
   else if($processedampm=='pm'){
      $ampm='PM';
   }
   else{
      $ampm='AM';
   }
   
   if($processedbefaft=='Before'||$processedbefaft=='After')
   {
      $befaft=$processedbefaft;
   }
   else if($processedbefaft=='before'){
      $befaft='Before';
   }
   else if($processedbefaft=='after'){
      $befaft='After';
   }
   else{
      $befaft='After';
   }
   
   if($beftaft=='After'){
      if($ampm=='PM'){
         $sql="SELECT * FROM Notification WHERE PostTime>='$hour:$minute' AND PostStartTimeAMPM='PM' ORDER BY $order $sort";
      }
      else{//$ampm must be 'AM'
         $sql="SELECT * FROM Notification WHERE PostTime>='$hour:$minute' AND ID IN (SELECT ID FROM Notification WHERE PostStartTimeAMPM='AM' OR PostStartTimeAMPM='PM') ORDER BY $order $sort";
      }
   }
   //$befaft must be Before
   else{
      if($ampm=='AM'){
         $sql="SELECT * FROM Notification WHERE PostTime<='$hour:$minute' AND PostStartTimeAMPM='AM' ORDER BY $order $sort";
      }
      else{//$ampm must be 'PM'
         $sql="SELECT * FROM Notification WHERE PostTime<='$hour:$minute' AND ID IN (SELECT ID FROM Notification WHERE PostStartTimeAMPM='AM' OR PostStartTimeAMPM='PM') ORDER BY $order $sort";
      }
   }
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

/*********************************************
GET: EVENTS
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

# Get all events ordered
$app->get('/api/events/order/{order}/sort/{sort}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   $sql = "SELECT * FROM CalendarEvent ORDER BY $order $sort";
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all events by exact Title
$app->get('/api/events/order/{order}/sort/{sort}/TitleExact/{title}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $title = $request->getAttribute('title');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   $sql = "SELECT * FROM CalendarEvent WHERE Title='$title' ORDER BY $order $sort";
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all events by like-Title
$app->get('/api/events/order/{order}/sort/{sort}/TitleLike/{title}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $title = $request->getAttribute('title');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   $sql = "SELECT * FROM CalendarEvent WHERE Title LIKE '%$title%' ORDER BY $order $sort";
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all events by Category
$app->get('/api/events/order/{order}/sort/{sort}/Category/{category}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $category = $request->getAttribute('category');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   $sql = "SELECT * FROM CalendarEvent WHERE Category='$category' ORDER BY $order $sort";
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all events by exact Date
$app->get('/api/events/order/{order}/sort/{sort}/EventDateExact/{date}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $date = $request->getAttribute('date');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   $sql = "SELECT * FROM CalendarEvent WHERE EventDate='$date' ORDER BY $order $sort";
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all events by Date Range
$app->get('/api/events/order/{order}/sort/{sort}/EventDateA/{dateA}/EventDateB/{dateB}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $dateA = $request->getAttribute('dateA');
   $dateB = $request->getAttribute('dateB');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   $sql = "SELECT * FROM CalendarEvent WHERE EventDate BETWEEN '$dateA' AND '$dateB' ORDER BY $order $sort";
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all events by Before/After Date
$app->get('/api/events/order/{order}/sort/{sort}/EventDateBefAft/{date}/BefAft/{befaft}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $date = $request->getAttribute('date');
   $processedbefaft = $request->getAttribute('befaft');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   if($processedbefaft=='Before'||$processedbefaft=='After')
   {
      $befaft=$processedbefaft;
   }
   else if($processedbefaft=='before'){
      $befaft='Before';
   }
   else if($processedbefaft=='after'){
      $befaft='After';
   }
   else{
      $befaft='After';
   }
   
   if($beftaft=='After'){
      $sql = "SELECT * FROM CalendarEvent WHERE EventDate>='$date' ORDER BY $order $sort";
   }
   //$befaft must be Before
   else{
      $sql = "SELECT * FROM CalendarEvent WHERE EventDate<='$date' ORDER BY $order $sort";
   }
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all events by exact StartTime
$app->get('/api/events/order/{order}/sort/{sort}/StartTimeHourExact/{hour}/StartTimeMinuteExact/{minute}/StartTimeAMPM/{ampm}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $hour = $request->getAttribute('hour');
   $minute = $request->getAttribute('minute');
   $processedampm = $request->getAttribute('ampm');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   if($processedampm=='PM'||$processedampm=='AM')
   {
      $ampm=$processedampm;
   }
   else if($processedampm=='am'){
      $ampm='AM';
   }
   else if($processedampm=='pm'){
      $ampm='PM';
   }
   else{
      $ampm='AM';
   }
   
   $sql = "SELECT * FROM CalendarEvent WHERE EventStartTime='$hour:$minute' AND EventStartTimeAMPM='$ampm' ORDER BY $order $sort";
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all events by Before/After StartTime
$app->get('/api/events/order/{order}/sort/{sort}/StartTimeHourBefAft/{hour}/StartTimeMinuteBefAft/{minute}/StartTimeAMPM/{ampm}/BefAft/{befaft}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $hour = $request->getAttribute('hour');
   $minute = $request->getAttribute('minute');
   $processedampm = $request->getAttribute('ampm');
   $processedbefaft = $request->getAttribute('befaft');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   if($processedampm=='PM'||$processedampm=='AM')
   {
      $ampm=$processedampm;
   }
   else if($processedampm=='am'){
      $ampm='AM';
   }
   else if($processedampm=='pm'){
      $ampm='PM';
   }
   else{
      $ampm='AM';
   }
   
   if($processedbefaft=='Before'||$processedbefaft=='After')
   {
      $befaft=$processedbefaft;
   }
   else if($processedbefaft=='before'){
      $befaft='Before';
   }
   else if($processedbefaft=='after'){
      $befaft='After';
   }
   else{
      $befaft='After';
   }
   
   if($beftaft=='After'){
      if($ampm=='PM'){
         $sql="SELECT * FROM CalendarEvent WHERE EventStartTime>='$hour:$minute' AND EventStartTimeAMPM='PM' ORDER BY $order $sort";
      }
      else{//$ampm must be 'AM'
         $sql="SELECT * FROM CalendarEvent WHERE EventStartTime>='$hour:$minute' AND ID IN (SELECT ID FROM CalendarEvent WHERE EventStartTimeAMPM='AM' OR EventStartTimeAMPM='PM') ORDER BY $order $sort";
      }
   }
   //$befaft must be Before
   else{
      if($ampm=='AM'){
         $sql="SELECT * FROM CalendarEvent WHERE EventStartTime<='$hour:$minute' AND EventStartTimeAMPM='AM' ORDER BY $order $sort";
      }
      else{//$ampm must be 'PM'
         $sql="SELECT * FROM CalendarEvent WHERE EventStartTime<='$hour:$minute' AND ID IN (SELECT ID FROM CalendarEvent WHERE EventStartTimeAMPM='AM' OR EventStartTimeAMPM='PM') ORDER BY $order $sort";
      }
   }
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all events by exact Location
$app->get('/api/events/order/{order}/sort/{sort}/LocationExact/{location}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $location = $request->getAttribute('location');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   $sql = "SELECT * FROM CalendarEvent WHERE Location='$location' ORDER BY $order $sort";
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all events by like-Location
$app->get('/api/events/order/{order}/sort/{sort}/LocationLike/{location}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $location = $request->getAttribute('location');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   $sql = "SELECT * FROM CalendarEvent WHERE Location LIKE '%$location%' ORDER BY $order $sort";
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

#Get all events by like-Description
$app->get('/api/events/order/{order}/sort/{sort}/DescriptionLike/{description}', function(Request $request, Response $response){
   
   //Get Parameters from url
   //order is the Attribute that results are 'Ordered By'
   //sort can be either ASC (ascending order), or DESC (descending order)
   $order = $request->getAttribute('order');
   $processedSort = $request->getAttribute('sort');
   $description = $request->getAttribute('description');
   
   if($processedSort=='desc'||$processedSort=='asc'||$processedSort=='DESC'||$processedSort=='ASC')
   {
      $sort=$processedSort;
   }
   else
   {
      $sort='DESC';
   }
   
   $sql = "SELECT * FROM CalendarEvent WHERE Description LIKE '%$description%' ORDER BY $order $sort";
   
   try{
      //get db object
      $db = new db();
      //call connect to connect to database
      $db = $db->connect();
      
      #PDO statement
      $stmt = $db->query($sql);
      $events = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      
      echo json_encode($events);
   } catch(PDOException $e){
      echo '{error": {"text": '.$e->getMessage().'}';
   }
});

/*********************************************
GET: USERS
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

#Login get request
$app->get('/api/users/login/LoginID/{login}/Password/{password}', function(Request $request, Response $response){
   $login=$request->getAttribute('login');
   $password=$request->getAttribute('password');

    $sql = "SELECT * FROM User WHERE LoginID='$login' AND AccountStatus!='Pending' AND Password='$password'";

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

//Restrict route example    Our token is "usertokensecret"
$app->get('/api/restrict', function(Request $request, Response $response){
    $output = ['msg' => 'It\'s a restrict area. Token authentication works!'];
    $response->withJson($output, 200, JSON_PRETTY_PRINT);

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

/*********************************************
POST: NOTIFICATION
*********************************************/
# Add notification.
$app->post('/api/notifications/add', function(Request $request, Response $response){

    $NotificationTitle = $request->getParam('NotificationTitle');
    $NotificationDescription = $request->getParam('NotificationDescription');
    $PostDate = $request->getParam('PostDate');
    $PostTimeHour = $request->getParam('PostTimeHour');
    $PostTimeMinute = $request->getParam('PostTimeMinute');
    $PostTime = $PostTimeHour.":".$PostTimeMinute;
    $PostTimeAMPM = $request->getParam('PostTimeAMPM');

    $sql = "INSERT INTO Notification (ID,Title,Description,PostDate,PostTime,PostTimeAMPM)
      VALUES (NULL,:NotificationTitle,:NotificationDescription,:PostDate,:PostTime,:PostTimeAMPM)";


    try{
      // Get DB object
      $db = new db();
      // Call connect; connect to database.
      $db = $db->connect();

      # PDO statement
      $stmt = $db->prepare($sql);

      $stmt->bindParam(':NotificationTitle', $NotificationTitle);
      $stmt->bindParam(':NotificationDescription', $NotificationDescription);
      $stmt->bindParam(':PostDate', $PostDate);
      $stmt->bindParam(':PostTime', $PostTime);
      $stmt->bindParam(':PostTimeAMPM', $PostTimeAMPM);

      $stmt->execute();
      echo '{"notice": {"text": "Notification Added"}';

    } catch(PDOException $e){
      echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
