<?php 
	define("DBSERVER",   "localhost");
    define("DBUSER" ,    "root");
    define("DBPASSWORD", "");
    define("DBNAME",     "webpro2examdb");


class Controller {
	private $row;
    private $link; 
    private $result;  
    function __construct($server, $user, $password, $database) {
        $this->link = mysql_connect($server, $user, $password);
        if ($this->link) {
            $db = mysql_select_db($database, $this->link);
            if (!$db) {
            	mysql_close($this->link_id);
                return false;
            }
            return $this->link;
        }
    }

    function RunSQL($sql) {
            $this->result = mysql_query($sql, $this->link);
            return $this->result;
    }

    function GetRow($result = 0) {
        $result = $this->result;
        if ($result) {
            $row = mysql_fetch_array($result);
            return $row;
        }
    }

    function GetAll($result = 0) {
        $result = $this->result;
        if ($result) {
            while ($row = mysql_fetch_array($result)) {
                $rows[] = $row;
            }
            return $rows;
        }
    }
 
 	function Echo_Roomlists($row){
	  foreach ($row as $value) {
	    $str = "";
	    $str .= '<li class="active"><a href="chatroom.php?room=';
	    $str .= $value['id'];
	    $str .= '">';
	    $str .= $value['name'];
	    $str .= '</a></li>';
	    echo $str, PHP_EOL;
	  }
	} 

	function Echo_Messages($msg_list){
	  foreach ($msg_list as $value) {
	  	$str = "";
	  	$str .= '<li class="left clearfix"><div class="chat-body clearfix"><div class="header"><small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>';
	  	$str .= $value['sent_at'];
	  	$str .= '</small></div><p>';
		$str .= htmlspecialchars($value['content']);
		$str .= '</p></div></li>';
		echo $str, PHP_EOL;
	  }
	}
}
