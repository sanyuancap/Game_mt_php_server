<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>进化</title>
</head>

<body><?php
require_once("online.php");
if($_GET['q']=="jinh"){
$pet=select("pet","id=".$_GET['id'],"name,star,lvl,lvl_sx");
if($pet['lvl']<$pet['lvl_sx']){
exit("等级不符合");
}
$jinh=array(2=>array(1),3=>array(2,3),4=>array(4),5=>array(5));
$jinhjg=$jinh[$pet['star']];

for($i=0; $i<count($jinhjg); $i++){


if(get_taoz_num($jinhjg[$i])>=1){
$canjinh=true;
break;
} 
$taoz=select("sys_taoz","id=".$jinhjg[$i],"name,jh_type");
}
if($canjinh==false){
exit($taoz['name']."套装不足");
} else{
if($taoz['jh_type']==0){
up("pet","star=star+1","id=".$_GET['id']);
}else{
up("pet","jingy=1","id=".$_GET['id']);
} 
exit("进化成功！");
} 

} 
if($_GET['q']=="tianj"){
$pet=select("pet","id=".$_GET['id'],"name,star");
$str=$pet['name'];
} else{
$str="<a href=\"pet.php?q=xz2\">点此选择</a>";
} 
?>
<p>选择英雄：<?php echo($str);?></p>
<p><a href="?q=jinh&amp;id=<?php echo($_GET['id']);?>">进化</a></p>
</body>
</html>
