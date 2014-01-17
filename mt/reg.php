<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>注册</title>
<style type="text/css"><!--@import url(css/main.css);/*这里是通过@import引用CSS的样式内容*/--></style>
</head>
<body><?php
if($_POST['Submit']){
/*
if($_COOKIE['yzc2']<>0){
exit("请勿重复注册多个账号！ <a href=\"javascript:history.go(-1);\">返回</a>");
}
*/
if($_POST['textfield3']<>$_POST['textfield2']){
exit("密码不一致！ <a href=\"javascript:history.go(-1);\">返回</a>");
} 
require_once("db.php");
$data=$db->fetch_array($db->query("select id from username where username='".$_POST['textfield']."' "));
if($data['id']<>0){
exit("这个账号已经被注册！ <a href=\"javascript:history.go(-1);\">返回</a>");
} else{
$data2=$db->fetch_array($db->query("select id from username where reg_ip='".$_SERVER["REMOTE_ADDR"]."' "));

$db->query("INSERT INTO `username` (id,username,password,reg_ip,reg_time,log_ip,server_id)VALUES (null, '".$_POST['textfield']."', '".md5($_POST['textfield'].$_POST['textfield2'])."', '".$_SERVER["REMOTE_ADDR"]."', '".time()."', '".$_SERVER["REMOTE_ADDR"]."','".$_POST['server_id']."');");
$user_id=$db->insert_id();
if($_GET['id']){
if($_COOKIE['yzc2']<>1){
if($data2['id']==0){
require_once("configs/config.php");
$tg_user=$db->fetch_array($db->query("select server_id from username where id=".$_GET['id']." "));
//$db->query("update u".$tg_user['server_id']."_user set emoney=emoney+18000 where uid='".$_GET['id']."' ");
$db->query("update username set tg_uid=".$_GET['id'].",server_id='".$tg_user['server_id']."',chongzjl=chongzjl+".$tuigjl." where id=".$user_id." ");
} 
} 
} 
setcookie("yzc2",1,time()+60*60*24*30*6);
setcookie("account_name", $_POST['textfield'], time() + 60*60*24*30);
setcookie("username", $_POST['textfield'], time() + 60*60*24*30);
setcookie("password", md5($_POST['textfield'].$_POST['textfield2']), time() + 60*60*24*30);
exit("<script language=\"javascript\" type=\"text/javascript\">           window.location.href=\"game.php?gongg=1\";     </script>");
//exit("注册成功！");
} 
} 
if($_GET['s']==0){
$_GET['s']=1;
} 
?>
<p>&nbsp;</p>
<h1 align="center">《我叫MT》游戏</h1>
<form id="form1" name="form1" method="post" action="?id=<?php echo($_GET['id']);?>">
  <input name="server_id" type="hidden" id="server_id" value="<?php echo($_GET['s']);?>" />
  <label>
  <div align="center">账号
    <input type="text" name="textfield" />
  </div>
  </label>
  <p align="center">
    <label>密码
    <input type="password" name="textfield2" />
    </label>
  </p>
  <p align="center">
    <label>确认
    <input type="password" name="textfield3" />
    </label>
  </p>
  <p align="center">
    <label>邮箱
    <input type="text" name="textfield4" />
    </label>
  </p>
  <p align="center">
    <input type="submit" name="Submit" value="注册" />
    <a href="index.php"> 返回</a></p>
</form>
</body>
</html>
