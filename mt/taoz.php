<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>套装收集</title>
</head>

<body><?php
require_once("online.php");
$sql="select * from ".$dbpre."taoz where player_id=".$player_id." ";
$rs=$db->query($sql);
 while($row=mysql_fetch_row($rs))   //mysql_fetch_row函数取得一行返回数组
 {
$taoz=select("sys_taoz","id=".$row[2]);

echo "<p>".$taoz['name']." 已收集".get_taoz_num($taoz['id'])."套</p><p>部件1：".$row[3]." 部件2：".$row[4]." 部件3：".$row[5]." 部件4：".$row[6]." 部件5：".$row[7]."</p><p>获得来源：".$taoz['get_url']."</p><p>适用英雄：".$taoz['des']."</p><br><br>";
 }
?>

</body>
</html>
