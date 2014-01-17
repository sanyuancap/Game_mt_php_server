<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>碎片</title>
</head>

<body><?php
require_once("online.php");
if($_GET['q']=='duih'){
$item=select('item','player_id='.$player_id);
if($item['suip']>$item['num']){
exit("碎片数量不足");
} else{
up('item','num=num-'.$item['suip'],'player_id='.$player_id.' and item_id='.$item['item_id']);
give_pet($item['item_id']);
exit("兑换成功！");
} 
} 
$sql="select * from ".$dbpre."item where player_id=".$player_id." ";
$rs=$db->query($sql);
 while($row=mysql_fetch_row($rs))   //mysql_fetch_row函数取得一行返回数组
 {
echo $row[2]." ".$row[4]."/".$row[5]." <a href=\"?q=duih&id=".$row[0]."\">兑换卡牌</a><br>";
 }
?>

</body>
</html>
