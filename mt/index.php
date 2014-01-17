<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>《我叫MT》-登陆</title>
<meta name="Keywords" content="我叫MT" />
<style type="text/css"><!--@import url(css/main.css);/*这里是通过@import引用CSS的样式内容*/--></style>
</head>

<body><?php
$no_location=1;
require_once("db.php");
if(!$str){
$str="<a href=\"login.php?s=".intval($server_data['server_id'])."\" target=\"_blank\">第".(intval($server_data['server_id']))."大区:".$game_servers_name[$server_data['server_id']-1]."</a>";
} 
?>
<table width="285" border="1" align="center" cellspacing="15">
  <tr>
    <th scope="col">最近登录:<?php echo($str);?></th>
  </tr>
<?php
for($i=0; $i<count($game_servers); $i++){
echo("<tr>   <td><div align=\"center\"><a href=\"login.php?s=".intval($game_servers[$i])."\" target=\"_blank\">第".intval($game_servers[$i])."大区:".$game_servers_name[$i]."</a></div></td></tr>");
}
?>
  

</table>
<p>&nbsp;</p>
</body>
</html>
