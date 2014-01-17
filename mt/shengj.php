<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>升级</title>
</head>

<body>
<?php
require_once("online.php");
if($_GET['q']=="shengj" and $_COOKIE['z'] and $_COOKIE['t1']){
$exp=get_pet_price($_COOKIE['t1'])/10;
del_pet($_COOKIE['t1']);
$lvl_data=get_can_lvl($exp);
if($lvl_data['lvl']==0){
up("pet","exp=exp+".$lvl_data['exp'],"id=".$_COOKIE['z']);
exit("获得".$lvl_data['exp']."经验");
} else{
$life=$lvl_data['lvl']*100;
$power=$lvl_data['lvl']*10;
up("pet","exp=exp+".$lvl_data['exp'].",lvl=lvl+".$lvl_data['lvl'].",life=life+".$life.",power=power+".$power,"id=".$_COOKIE['z']);
exit("等级提高".$lvl_data['lvl']."级，获得".$lvl_data['exp']."经验<br>生命提高".$life.",攻击提高".$power." ");
} 

} 
if($_GET['id']){
setcookie($_GET['wz'], $_GET['id'], time() + 60*60);
$_COOKIE[$_GET['wz']]=$_GET['id'];
if($_COOKIE['z']==$_COOKIE['t1']){
exit("升级英雄和吞噬英雄不能选择同一个");
} 
}else{
setcookie("z", "", time() + 60*60);
setcookie("t1", "", time() + 60*60);
$_COOKIE['z']="";
$_COOKIE['t1']="";
} 
?>
<p>升级英雄：<?php
if($_COOKIE['z']){
$sql="select name,lvl,power,life from ".$dbpre."pet where player_id=".$player_id." and id=".$_COOKIE['z']." ";
$pet=$db->fetch_array($db->query($sql));
echo "<a href=\"pet.php?q=xz&wz=z\">".$pet['name']."</a> lv：".$pet['lvl']." 生命：".$pet['life']." 攻击：".$pet['power'];
} else{
echo("<a href=\"pet.php?q=xz&wz=z\">点此选择英雄</a>");
} 
?></p>
<p><a href="?q=shengj">英雄升级</a></p>
<p>吞噬英雄：<?php
if($_COOKIE['t1']){
$sql="select name,lvl,power,life from ".$dbpre."pet where player_id=".$player_id." and id=".$_COOKIE['t1']." ";
$pet=$db->fetch_array($db->query($sql));
echo "<a href=\"pet.php?q=xz&wz=t1\">".$pet['name']."</a> lv：".$pet['lvl']." 生命：".$pet['life']." 攻击：".$pet['power'];
} else{
echo("<a href=\"pet.php?q=xz&wz=t1\">点此选择英雄</a>");
} 
?></p>
<p>&nbsp;</p>
</body>
</html>
