<?php

if($yizx==0){
require_once("guol.php"); 

}
$yizx=1;

class mysqlclass {

	var $db_id;

	var $querynum = 0;



	function connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect = 0) {

		if($pconnect) {

			if(!$this->db_id=@mysql_pconnect($dbhost, $dbuser, $dbpw)) {

				$this->mysql_errormsg('Can not connect to MySQL server');

			}

		} else {

			if(!$this->db_id=@mysql_connect($dbhost, $dbuser, $dbpw)) {

				$this->mysql_errormsg('Can not connect to MySQL server');

			}

		}

		@mysql_query("set names 'utf8'");

		@mysql_select_db($dbname);

	}



	function select_db($dbname) {

		return @mysql_select_db($dbname,$this->db_id);

	}



	function query($sql) {	

$sql=str_replace("INSERT ","INSERT IGNORE ",$sql);

$sql=str_replace("insert ","INSERT IGNORE ",$sql);

	$sql=str_replace("update ","update IGNORE ",$sql);

	$sql=str_replace("UPDATE ","UPDATE IGNORE ",$sql);	

		if(!($query = @mysql_query($sql,$this->db_id))) {

				$this->mysql_errormsg('MySQL Query Error', $sql);

			}		

		$this->querynum++;		

		return $query;

	}

	

	function fetch_array($query, $result_type = MYSQL_ASSOC) {

		return @mysql_fetch_array($query, $result_type);

	}



	function fetch_row($query) {

		$query = @mysql_fetch_row($query);

		return $query;

	}

	

	function num_rows($query) {

		$query = @mysql_num_rows($query);

		return $query;

	}



	function insert_id() {

		$id = @mysql_insert_id();

		return $id;

	}

	

	function free_result($query) {

		return @mysql_free_result($query);

	}

	

	function close() {

		return @mysql_close();

	}

	

	function mysql_errormsg($message = '', $sql = '') {

		echo $message."<br>".$sql."<br>";

		echo $this->errno()." ".$this->error();
		exit;

	}



	function affected_rows() {

		return @mysql_affected_rows();

		//		传回最后查询为INSERT、UPDATE或DELETE所影响的列数目		

	}



	function error() {

		return @mysql_error();

		//从先前MySQL操作传回错误讯息

	}



	function errno() {

		return @intval(mysql_errno());

		//从先前MySQL操作传回错误讯息代号

	}



	function result($query, $row) {

		$query = @mysql_result($query, $row);//

		return result;

		//从MySQL结果传回一格(cell)的内容,效率低.

	}



	function num_fields($query) {

		return @mysql_num_fields($query);

		//传回结果中栏位的数目

	}	

}






require_once("db_config.php");






$db = new mysqlclass;

$db->connect($dbhost,$dbuser,$dbpw,$dbname);

unset($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
function home() {
$url=$_SERVER['HTTP_REFERER'];
if($url==""){
$url="game.php";
} 
$html=ob_get_clean();
$html="<div align=\"center\"><table border=\"0\"><tr><td>".$html;
$html=str_replace("</body>","</td></tr></table></div></body>",$html);
//javascript:history.go(-1);
//echo($html."<style type=\"text/css\"><!--@import url(css/main.css);/*杩欓噷鏄�氳繃@import寮曠敤CSS鐨勬牱寮忓唴瀹�*/--></style><body><div align=\"center\"><table border=\"0\"><tr><td><br><a href=\"javascript:history.go(-1);\">杩斿洖</a><br><a href=\"game.php\">杩斿洖涓荤晫闈�</a></td></tr></table></div></body>");
echo($html."<style type=\"text/css\"><!--@import url(res/css/main.css);/*杩欓噷鏄�氳繃@import寮曠敤CSS鐨勬牱寮忓唴瀹�*/--></style><body><div align=\"center\"><table border=\"0\"><tr><td><br><a href=\"".$url."\"><img src=\"res/ui/fanh.png\" width=\"76\" height=\"33\" border=\"0\" /></a><a href=\"game.php\"><img src=\"res/ui/zhujm.png\" width=\"76\" height=\"33\" border=\"0\" /></a></td></tr></table></div></body>");
}
if(!$no_location){
register_shutdown_function("home"); 
}
require_once("configs/sys_start.php");
if($sys_start==0){
exit("姝ｅ湪缁存姢锛岀◢鍚庡紑鏀撅紒瀹㈡湇QQ锛�843848283");
} 
require_once("configs/game_servers.php");

$server_data=$db->fetch_array($db->query("select server_id from username where username='".$_COOKIE['account_name']."' "));
if($_POST['server_id']){
$server_data['server_id']=$_POST['server_id'];
} 
if(!in_array($server_data['server_id'],$game_servers)){
//print_r($game_servers);
//exit($server_data['server_id']);
if($no_location){
$str="鏃�";
}else{
header("location:index.php");
exit();
} 

} 
$dbpre="u".$server_data['server_id']."_";
//$dbpre
?>