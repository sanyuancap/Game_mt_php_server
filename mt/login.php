<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>九界独尊游戏,网页游戏,文字游戏,手机游戏-登陆</title>
<meta name="Keywords" content="九界独尊游戏,文字游戏,手机游戏,网页游戏,mud游戏,九界独尊网游" />
<style type="text/css"><!--@import url(res/css/main.css);/*这里是通过@import引用CSS的样式内容*/--></style>
</head>
<body><?php
if($_POST['Submit']){
$no_location=1;
require_once("db.php");
//exit($dbpre);
$data=$db->fetch_array($db->query("select * from username where username='".$_POST['textfield']."' "));
if(md5($_POST['textfield'].$_POST['textfield2'])<>$data['password']){
exit("密码错误！<br><a href=\"index.php\">返回</a>");
} else{
if($data['delete']==1){
exit("你的账号被冻结了。请联系QQ843848283解冻");
} 
$player=$db->fetch_array($db->query("select name,id from ".$dbpre."player where uid=".$data['id']." "));
$player_id=$player['id'];
$db->query("update username set server_id='".$_POST['server_id']."',player_id=0 where id=".$data['id']."  ");
//require_once("shancgqzb.php");//删除过期装备
setcookie("account_name", $_POST['textfield'], time() + 60*60*24*30);
setcookie("username", $player['username'], time() + 60*60*24*30);
setcookie("password", $data['password'], time() + 60*60*24*30);
exit("<script language=\"javascript\" type=\"text/javascript\">           window.location.href=\"game.php?gongg=1\";     </script>");
} 
} 
?>
<p>&nbsp;</p>
<h1 align="center">《我叫MT》游戏</h1>
<form id="form1" name="form1" method="post" action="">
  <label>
  <div align="center">账号
    <input type="text" name="textfield" value="<?php echo($_COOKIE['account_name']);?>" />
  </div>
  </label>
  <input name="server_id" type="hidden" id="server_id" value="<?php echo($_GET['s']);?>" />
  <p align="center">
    <label>密码
    <input type="password" name="textfield2" />
    </label>
  </p>
  <p align="center">
    <input type="submit" name="Submit" value="登陆游戏" />
    <a href="reg.php?s=<?php echo($_GET['s']);?>">注册</a></p>
</form>
</body>
</html>
