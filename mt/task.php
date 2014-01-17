<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>任务奖励</title>
</head>

<body><?php
require_once("online.php");
if($_GET['q']=="tij"){
$task_log=select("task","task_id=".$_GET['id']." and player_id=".$player_id,"id");
if($task_log['id']){
exit("这个任务已经完成！");
}else{
$task=select("sys_task","id=".$_GET['id']);
if($task['type']==1){
if($data['lvl']<$task['data']){
exit("任务未达到要求！");
} else{
$db->query("insert into ".$dbpre."task(id,player_id,task_id)values(null,".$player_id.",".$_GET['id'].");");
$chengg=true;
} 
} 
if($chengg){
if($task['jl_type']==1){
$jiangl=explode(" ",$task['jiangl']);
give_pet($jiangl[1],1,0);
} 
exit("成功完成!");
} 
} 
} 

$dess=array('等级提升至{data}级');
$sql="select * from `sys_task` ";
$rs=$db->query($sql);
 while($row=mysql_fetch_row($rs))   //mysql_fetch_row函数取得一行返回数组
 {
$des=str_replace("{data}",$row[5],$dess[$row[1]-1]);
echo "任务名称：".$row[2]." 任务说明：".$des." 进度： <a href=\"?id=".$row[0]."&q=tij\">提交任务</a><br>";
 }
?>
</body>
</html>
