<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>英雄</title>
</head>

<body>
<?php
require_once("online.php");
if($_GET['id']){
$pet=$db->fetch_array($db->query("select name,lvl,power,life,star,id,baoh,zhuangt from ".$dbpre."pet where player_id=".$player_id." and id=".$_GET['id']." "));
if($pet['baoh']==1){
exit("保护状态的卡牌不能出售");
} 
if($pet['zhuangt']>0){
exit("出战状态的卡牌不能出售");
} 
del_pet($pet['id']);
$price=get_pet_price($_GET['id']);
up_player('money','+'.$price);
exit("售出成功，获得".$price);
} 
if($_GET['q']=="xz" or $_GET['q']=="tianj"){
$sql="select name,lvl,power,life,star,id from ".$dbpre."pet where player_id=".$player_id." and zhuangt<>1 ";
}else{
$sql="select name,lvl,power,life,star,id from ".$dbpre."pet where player_id=".$player_id."  ";
} 

$rs=$db->query($sql);
 while($row=mysql_fetch_row($rs))   //mysql_fetch_row函数取得一行返回数组
 {
if($_GET['q']=="xz"){
$str="<a href=\"shengj.php?id=".$row[5]."&wz=".$_GET['wz']."\">选择</a>";
}elseif($_GET['q']=="tianj"){
$str="<a href=\"game.php?id=".$row[5]."&q=tianj\">选择</a>";
}elseif($_GET['q']=="xz2"){
$str="<a href=\"jinh.php?id=".$row[5]."&q=tianj\">选择</a>";
}else{
$str="<a href=\"?id=".$row[5]."\">出售</a>";
} 
echo "<p>".$row[0]." lv：".$row[1]." 生命：".$row[3]." 攻击：".$row[2]." 星级：".$row[4]." 售价：".get_pet_price($row[5])." ".$str."</p>";
 }
?>

<p>&nbsp;</p>
</body>
</html>
