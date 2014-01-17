<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>《我叫MT》游戏</title>
<link href="res/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body><?php
//session_start();

require_once("online.php");
$sex=array("未知","男","女");
require_once("configs/config.php");
if($_GET['q']=="tianj"){
$pet=select("pet","id=".$_GET['id'],"zhuangt");
if($pet['zhuangt']>0){
exit("出战状态的卡牌无法添加");
} 
up("pet","zhuangt=1","id=".$_GET['id']);
} 
if($_GET['q']=="xiux"){
up("pet","zhuangt=0","id=".$_GET['id']);
} 
?><p>&nbsp;</p>
<p><strong><?php echo($data['name']);?> </strong>等级：<?php echo($data['lvl']);?> 经验：<?php echo($data['exp']);?> 体力：<?php echo($data['til']."/".$data['tilsx']);?> 剩余时间：<?php echo(date("i分s秒",$data['tilhhsj']-time()));?></p>
<p>符石：<?php echo($data['emoney']);?> 金币：<?php echo($data['money']);?>
  <!--p>      </p>
<p>     </p>
<p>    </p>
<p>    </p>
<p>     </p>
<p>     </p-->
</p>
<p>我的团队</p>
<?php
$pet=$db->fetch_array($db->query("select name,id,lvl from ".$dbpre."pet where zhuangt=2 and player_id=".$player_id."  "));
$shil=$pet['lvl'];
echo("<p>队长：<a href=\"?id=".$pet['id']."\">".$pet['name']."</a> lv：".$pet['lvl']."</p>");
$sql="select name,id,lvl from ".$dbpre."pet where zhuangt=1 and player_id=".$player_id."  ";
$rs=$db->query($sql);
$shul=$db->affected_rows();
 while($row=mysql_fetch_row($rs))   //mysql_fetch_row函数取得一行返回数组
 {
$shil=$shil+$row[2];
echo("<p>队员：<a href=\"?id=".$row[1]."\">".$row[0]."</a> lv：".$row[2]." <a href=\"?q=xiux&id=".$row[1]."\">休息</a></p>");
//$sql="select name,id,lvl from ".$dbpre."pet where zhuangt=1 and player_id=".$player_id."  ";
 }
for($i=1; $i<=(4-$shul); $i++){
echo("<p>队员：<a href=\"pet.php?q=tianj\">点击添加</a> lv：</p>");
}
?>
<p>领导力<?php echo($data['lingdl']."/".$data['lingdlsx']);?>： 团队实力：<?php echo round($shil*17.2);?></p>
<ul class="youxi">
<li><a href="pet.php">英&nbsp;&nbsp;雄</a></li>
<li><a href="shengj.php">升&nbsp;&nbsp;级</a></li>
<li><a href="jinh.php">进&nbsp;&nbsp;化</a></li>
<li><a href="task.php">奖&nbsp;&nbsp;励</a></li>
<li><a href="suip.php">碎&nbsp;&nbsp;片</a></li>
<li><a href="ac.php?do=tingzxl">技能学院</a></li>
<li><a href="shop.php">副&nbsp;&nbsp;本</a></li>
<li><a href="pk.php">战&nbsp;&nbsp;斗</a></li>
<li><a href="shop.php">商&nbsp;&nbsp;店</a></li>
<li><a href="item.php">好&nbsp;&nbsp;友</a></li>
<li><a href="gongl.php">攻&nbsp;&nbsp;略</a></li>
<li><a href="gm.php">G &nbsp;&nbsp;M</a></li>
<li><a href="index.php">退&nbsp;&nbsp;出</a></li>
</ul>
</body>
</html>
