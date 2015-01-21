<?php
require_once('model.php');
session_start();

$room_id = $_GET['room'];
$comment = $_POST['comment'];

$controller = new Controller(DBSERVER, DBUSER, DBPASSWORD, DBNAME);
$controller->RunSQL("'SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

$sql = "SELECT * FROM rooms WHERE id=$room_id ";
$result = $controller->RunSQL($sql);
$row = $controller->Getrow($result);
$comment_date = date('Y-m-d h:i:s');
if(isset($comment)){
	$sql_in = "INSERT INTO messages (room_id, sent_at, content) VALUES ($room_id, '$comment_date', '$comment')";
	$result = $controller->RunSQL($sql_in);
}
else{null;}
$sql = "SELECT * FROM messages WHERE room_id = $room_id ";
$result = $controller->RunSQL($sql);
$msg_list = $controller->GetAll($result);

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $row['name'] ?> のチャットルーム</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/">ルーム一覧</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div class="container">
      <h1>Room - <?php echo $row['name'] ?></h1>
      <p><?php echo $row['name'] ?>のメッセージの一覧です。</p>
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="panel panel-primary">
                      <div class="panel-body">
                          <ul class="chat">
                              <?php if (isset($msg_list))$controller->Echo_Messages($msg_list) ?>
                          </ul>
                      </div>
                      <div class="panel-footer">
                          <form action="chatroom.php<?php echo '?room=' . $room_id ?>" method="post">
                              <div class="input-group">
                                  <input id="btn-input" type="text" name="comment" class="form-control input-sm" placeholder="Type your message here..." />
                                  <span class="input-group-btn"><button class="btn btn-warning btn-sm" id="btn-chat">Send</button></span> 
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div><!-- /.container -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

