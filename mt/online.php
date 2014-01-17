<?php
ob_start();
require_once("db.php");

$_GET['id']=round($_GET['id']);
$_GET['id']=intval($_GET['id']);
$user=$db->fetch_array($db->query("select id,`delete`,player_id from username where password='".$_COOKIE['password']."' "));
if($user['id']==0){
exit_home("请先登陆！");
} 

require_once("function.php");

$db->query("select id from ".$dbpre."player where uid=".$user['id']." ");
if($db->affected_rows()>1){
if($user['player_id']==0){
require_once("xuanzjs.php");
} else{
$data=$db->fetch_array($db->query("select * from ".$dbpre."player where uid=".$user['id']." and id=".$user['player_id']." "));
} 
} else{
$data=$db->fetch_array($db->query("select * from ".$dbpre."player where uid=".$user['id']." "));
} 
if($data['money']>500000000 or $data['emoney']>500000000 or $data['save_money']>500000000){
$db->query("update username set `delete`=1 where id=".$user['id']." ");
$data['delete']=1;
} 
if($data['money']<0){
$data['money']=0;
} 
if($data['jif']<0){
$data['jif']=0;
} 
if($data['delete']==1){
exit("你的账号被冻结了。请联系QQ843848283解冻");
} 
require_once("gongg.php");
if($data['id']==0){
//header("location:chuangj.php");
require_once("chuangj.php");
} 
$player_id=$data['id'];

function del_item($item_id,$num=1){
global $db,$dbpre,$player_id;
if($item_id>0){
$item=$db->fetch_array($db->query("select name from item where id=".$item_id." "));
$item_id=$item['name'];
} 
$tiaoj="name='".$item_id."'";
$user_item=$db->fetch_array($db->query("select num,id from ".$dbpre."item where ".$tiaoj." and uid=".$player_id." and `use`=0 "));
//exit($user_item['num']);
if($user_item['num']<$num){
return false;
}else{
$price=get_sys_item_price($user_item['id'])*$num;
$item=$db->fetch_array($db->query("select name,type,base from item where ".$tiaoj." "));
if($user_item['num']==1){
$db->query("delete from ".$dbpre."item where id=".$user_item['id']." ");
}else{
$db->query("update ".$dbpre."item set num=num-".$num." where ".$tiaoj." and uid=".$player_id." ");
} 
if($price==0){
return true;
} 
return $price;
} 
} 

function exit_home($txt){
exit($txt."");
} 

if($data['tilhhr']<>date("d")){
up_player("til","120,tilhhr=".date("d").",tilhhsj=".(time()+5*60));
} 
$shengysj=$data['tilhhsj']-time();
if($shengysj<=0){
$shengysj=5*60;
if($data['til']<120){
up_player("til","+1,tilhhsj=".(time()+$shengysj));
} 
} 

?>