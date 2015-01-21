<?php
require_once('model.php');
//session_start();

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