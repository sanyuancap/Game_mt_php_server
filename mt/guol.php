<?php
//error_reporting(0);
$filename = explode('/',$_SERVER['PHP_SELF']);
$filename = $filename[count($filename)-1];
foreach ($_POST as $hk){
$fangzr=$fangzr.$hk;
next($_POST);
}
foreach ($_GET as $b=>$hk){
$_GET[$b]=str_replace("=","",$_GET[$b]);
$_GET[$b]=str_replace("script","",$_GET[$b]);
$fangzr=$fangzr.$_GET[$b];
next($_GET);
}
foreach ($_COOKIE as $b=>$hk){
$_COOKIE[$b]=str_replace(",","",$_COOKIE[$b]);
$_COOKIE[$b]=str_replace("-","",$_COOKIE[$b]);
$_COOKIE[$b]=str_replace("=","",$_COOKIE[$b]);
$_COOKIE[$b]=str_replace("+","",$_COOKIE[$b]);
$_COOKIE[$b]=str_replace("delete","",$_COOKIE[$b]);
$fangzr=$fangzr.$_COOKIE[$b];
next($_COOKIE);
}
$fangzr=strtolower($fangzr);
if($filename<>"other.php"){
$fzrq=array("where","*","'","delete","drop","update","select","insert","'",";","(|)","exec","count","*","and ","master","truncate","char","declare","user",'"',",","=","+","-","script","onerror");
$fzr_i=count($fzrq);
for($i=0; $i<=$fzr_i -1 ; $i++) {
$fzr_str=explode($fzrq[$i],$fangzr);
$s=count($fzr_str);
if($s>1){
header("Content-Type:text/html;charset=gb2312"); 
exit("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"><html xmlns=\"http://www.w3.org/1999/xhtml\"><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\" /><title>出错啦！</title></head><body><p>".$filename."的".$fangzr."里发现非法字符".$fzrq[$i].",有问题请与管理员QQ843848283联系</p><p><a href=\"javascript:history.go(-1);\">返回</a></p></body></html>");
} 
}
}
?>