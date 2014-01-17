<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>选择角色</title>
</head>


<?php
if($_GET['xid']){
$data=$db->fetch_array($db->query("select id from ".$dbpre."user where uid=".$user['id']." and id=".$_GET['xid']." "));
if($data['id']==0){
exit("选择错误");
} else{
$db->query("update username set player_id=".$data['id']." where id=".$user['id']." ");
$user['player_id']=$data['id'];
$data=$db->fetch_array($db->query("select * from ".$dbpre."user where uid=".$user['id']." and id=".$user['player_id']." "));
} 

} else{
$sql="select id,username,lvl from ".$dbpre."user where uid=".$user['id']." ";
$rs=$db->query($sql);
 while($row=mysql_fetch_row($rs))   //mysql_fetch_row函数取得一行返回数组
 {
echo "<p>".$row[1]." ".$row[2]."级 <a href=\"?xid=".$row[0]."\">选择进入</a></p>";
 }
exit();
} 

?>
</html>