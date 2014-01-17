<?PHP
if($_GET['gongg']){
$sys=$db->fetch_array($db->query("select data from sys_config where `type`='公告' "));
exit("<p>".$sys['data']."</p>
<p><a href=\"game.php\">确定</a> </p>");
} 

?>