<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商店</title>
</head>

<body><?php
require_once("online.php");
if($_GET['q']=="chongz"){
up_player("emoney","+1000");
exit("充值100元成功");
} 
if($_GET['q']=="goumtl"){
if($data['goumtlr']<>date("d",time())){
up_player("goumtlr",date("d",time()).",goumtlcs=0");
$data['goumtlcs']=0;
} 
if($data['goumtlcs']>0){
exit("你今日已经购买过体力！");
} elseif($data['emoney']<50){
exit("符石不足");
}else{
up_player("til","120,emoney=emoney-50,goumtlcs=goumtlcs+1");
exit("购买成功！");
} 
} 

if($_GET['q']=="goumbb"){
if($data['emoney']<50){
exit("符石不足");
}else{
up_player("emoney","-50,beibsx=beibsx+5");
exit("购买成功！");
} 
} 

if($_GET['q']=="youqcj"){
if($data['youq']<100){
exit("友情不足100");
}else{
up_player("youq","-100");
$item=$db->fetch_array($db->query("SELECT * FROM sys_choujyq ORDER BY RAND() LIMIT 1"));
$pet=select("sys_pet","name='".$item['name']."'","id");
give_pet($pet['id']);
exit("获得".$item['name']."！");
} 
} 

if($_GET['q']=="fuscj"){
if($data['emoney']<280){
exit("符石不足280");
}else{
up_player("emoney","-280");
$item=$db->fetch_array($db->query("SELECT * FROM sys_choujyq ORDER BY RAND() LIMIT 1"));
$pet=select("sys_pet","name='".$item['name']."'","id");
give_pet($pet['id']);
exit("获得".$item['name']."！");
} 
} 

?>
<p><a href="?q=chongz">充值</a></p>
<p><a href="?q=goumtl">购买体力</a> <a href="?q=youqcj">友情抽奖</a></p>
<p><a href="?q=goumbb">购买背包</a> <a href="?q=fuscj">符石抽奖</a></p>
</body>
</html>
