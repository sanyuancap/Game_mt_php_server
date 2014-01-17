<?php

function give_s_item($item_id,$num=1){
global $db,$dbpre,$player_id;
if($item_id==0 and $item_id<>"0"){
$item=$db->fetch_array($db->query("select id from sys_pet where name='".$item_id."' "));
$item_id=$item['id'];
} 
$item=$db->fetch_array($db->query("select name,suip from sys_pet where id=".$item_id." "));

$user_item=$db->fetch_array($db->query("select id from ".$dbpre."item where item_id=".$item_id." and player_id=".$player_id." "));
if($user_item['id']<>0){
$db->query("update ".$dbpre."item set num=num+".$num." where item_id=".$item_id." and player_id=".$player_id." ");
} else{
$db->query("insert into ".$dbpre."item(id,player_id,item_id,type,num,name,suip)values(null,".$player_id.",".$item_id.",22,".$num.",'".$item['name']."','".$item['suip']."');");
} 
return($item['name']);
} 

function del_taoz($type,$num=1){
global $db,$dbpre,$player_id;
$db->query("update ".$dbpre."taoz set item0=item0-".$num.",item1=item1-".$num.",item2=item2-".$num.",item3=item3-".$num.",item4=item4-".$num." where player_id=".$player_id." and type=".$type." ");
} 

function get_taoz_num($type){
global $player_id,$db,$dbpre;
$taoz=select("taoz","player_id=".$player_id." and type=".$type);
$items=array($taoz['item0'],$taoz['item1'],$taoz['item2'],$taoz['item3'],$taoz['item4']);
sort($items);
return($items[0]);
} 

function give_t_item($itemid,$num=1){
global $db,$dbpre,$player_id;
$item=explode("-",$itemid);
$db->query("update ".$dbpre."taoz set item".$item[1]."=item".$item[1]."+".$num." where player_id=".$player_id." and type=".$item[0]." ");
} 

function get_next_lvl_exp($lvl=0){
global $data,$shengjsd;
if($lvl==0){
$lvl=$data['lvl'];
} 
$exp=($lvl+1)*$lvl/2*$shengjsd;
return($exp);
} 

function get_can_lvl($exp){
global $data;
for($lvl=1; $lvl<=99999; $lvl++){
$need_exp=$need_exp+get_next_lvl_exp($data['lvl']+$lvl-1);
if($need_exp>=$exp){
break;
} 
}
$lvl_data=array('lvl'=>$lvl,'exp'=>($need_exp-$exp));
return($lvl_data);
} 

function select($table,$where,$fileld="*"){
global $db,$dbpre;
if(!strpos($table,"_")){
$table=$dbpre.$table;
} 
$data=$db->fetch_array($db->query("select ".$fileld." from ".$table." where ".$where." "));
return($data);
} 

function up($table,$set,$where=""){
global $db,$dbpre;
$db->query("update ".$dbpre.$table." set ".$set." where ".$where);
} 

function get_pet_price($user_pet_id){
global $db,$player_id,$dbpre;
$pet=$db->fetch_array($db->query("select lvl,star from ".$dbpre."pet where player_id=".$player_id." and id=".$user_pet_id." "));
$price=ceil($pet['lvl']/4)*$pet['star']*$pet['star']*130;
return($price);
} 

function del_pet($user_pet_id){
global $db,$player_id,$dbpre;
$db->query("delete from ".$dbpre."pet where id=".$user_pet_id." and player_id=".$player_id." ");
} 

function give_pet($pet_id,$lvl=1,$zhuangt=0){
global $db,$player_id,$dbpre;
$pet=$db->fetch_array($db->query("select * from sys_pet where id=".$pet_id." "));
if($pet['id']<>0){
$db->query("insert into ".$dbpre."pet(id,player_id,p_id,name,job,life,power,fangy,baoj,shanb,lvl,zhuangt,star)VALUES(null,".$player_id.",".$pet_id.",'".$pet['name']."',".$pet['job'].",".$pet['life'].",".$pet['power'].",".$pet['fangy'].",".$pet['baoj'].",".$pet['shanb'].",".$lvl.",".$zhuangt.",".$pet['star'].");");
} 

} 

function give_mm($name){
global $db,$player_id,$dbpre;
$mm=$db->fetch_array($db->query("select id from mm where name='".$name."' "));
$zongsx=50;
$pingjsx=intval($zongsx/3);
$sx1=rand(Ceil($pingjsx/2),$pingjsx);
$sx2=rand(Ceil($pingjsx/2),$pingjsx);
$sx3=rand(Ceil($pingjsx/2),$pingjsx);
$sx4=$zongsx-($sx1+$sx2+$sx3);
$sxz=array($sx1,$sx2,$sx3,$sx4);
shuffle($sxz);
$db->query("INSERT INTO `".$dbpre."mm`(id,uid,m_id,name,lvl,power1,power2,power3,power4)VALUES (null, '".$player_id."','".$mm['id']."', '".$name."','1', '".$sxz[0]."', '".$sxz[1]."', '".$sxz[2]."', '".$sxz[3]."')");

} 

function get_param($name){
global $db,$player_id,$dbpre;
$data=$db->fetch_array($db->query("select value from ".$dbpre."var where uid=".$player_id." and name='".$name."' "));
return($data['value']);
} 

function set_param($name,$value){
global $db,$player_id,$dbpre;
$data=$db->fetch_array($db->query("select id from ".$dbpre."var where uid=".$player_id." and name='".$name."' "));
if($data['id']==0){
$db->query("insert into ".$dbpre."var(id,uid,name,value)values(null,".$player_id.",'".$name."','".$value."'); ");
}else{
$db->query("update ".$dbpre."var set value='".$value."' where uid=".$player_id." and name='".$name."' ");
}
} 



function give_item($item_id,$jiand=0,$bind=0,$num=1,$jif=1){
global $db,$dbpre,$player_id,$q_bases;
if($item_id==0 and $item_id<>"0"){
$item=$db->fetch_array($db->query("select id from item where name='".$item_id."' "));
$item_id=$item['id'];
} 
$item=$db->fetch_array($db->query("select name,type,base,time from item where id=".$item_id." "));
if($jif){
if((get_item_num()+$num)>((get_build_lvl('仓库')+1)*6)){
echo("包袱容量不足，请升级仓库！<br>");
up_player("jif","+".get_item_price($item['name'],$jiand));
return($item['name']."被转换为积分了");
} 
} 
if($item['type']>21){
$jiand=0;
$user_item=$db->fetch_array($db->query("select id from ".$dbpre."item where item_id=".$item_id." and uid=".$player_id." "));
if($user_item['id']<>0){
$db->query("update ".$dbpre."item set num=num+".$num." where item_id=".$item_id." and uid=".$player_id." ");
} else{
$db->query("insert into ".$dbpre."item(id,uid,item_id,`use`,q_lvl,base,type,num,name,bind)values(null,".$player_id.",".$item_id.",0,".$jiand.",".$item['base'].",".$item['type'].",".$num.",'".$item['name']."',".$bind.");");
} 
} else{
if($item['time']==0){
$time=0;
} else{
$time=time()+$item['time'];
} 
for ($i=1; $i<=$num; $i++)
{
if($jiand==0 or $jiand==8){
$db->query("insert into ".$dbpre."item(id,uid,item_id,`use`,q_lvl,base,type,num,name,bind,time)values(null,".$player_id.",".$item_id.",0,".$jiand.",".$item['base'].",".$item['type'].",1,'".$item['name']."',".$bind.",".$time.");");
} else{
$db->query("insert into ".$dbpre."item(id,uid,item_id,`use`,q_lvl,base,type,num,name,bind,time)values(null,".$player_id.",".$item_id.",0,".$jiand.",".($item['base']*$q_bases[$jiand]).",".$item['type'].",1,'".$item['name']."',".$bind.",".$time.");");
} 
}
} 
return($item['name']);
}

function get_item_price($item_id,$jiand=0){
global $db,$dbpre;
$item=$db->fetch_array($db->query("select price,base from item where name='".$item_id."' "));
if($item['price']==0){
$item['price']=$item['base']*6*100;
if($jiand==8){
$item['price']=$item['price']*1.467;
}else{
$item['price']=$item['price']*(1+(0.2*$jiand));
} 
} 
return($item['price']);
} 

function del_sys_item($user_item_id){
global $db,$dbpre;
$db->query("delete from ".$dbpre."item where id=".$user_item_id." ");
$db->query("delete from ".$dbpre."kong where item_id=".$user_item_id." ");
} 

function get_sys_item_price($user_item_id){
global $db,$dbpre;
$item=$db->fetch_array($db->query("select item_id,num,base,s_lvl,x_lvl,k_power,type,time from ".$dbpre."item where id=".$user_item_id." "));
if($item['type']>21 or $item['time']>0){
$sys_item=$db->fetch_array($db->query("select price from item where id=".$item['item_id']." "));
$price=$sys_item['price']*$item['num'];
}else{
if($item['q_lvl']==8){
$price=$item['base']*6*100*1.467;
}else{
$price=($item['base']+($item['s_lvl']*50)+($item['x_lvl']*20/100*$item['base'])+$item['k_power'])*6*100;
} 
}  
return($price);
} 

function money_to_item($money){
global $db,$dbpre;
$base=round($money/100/6/1.467);
$item=$db->fetch_array($db->query("select base from item where base<".$base." and type<22 and name<>'' order by base desc limit 1 "));
$item=$db->fetch_array($db->query("select name from item where base=".$item['base']." and type<22 and name<>'' ORDER BY RAND() LIMIT 1 "));
return($item['name']);
} 

function jiesjy($d_id){
global $db,$dbpre,$chongwhdjybl,$player_id;
$dui=$db->fetch_array($db->query("select shul,exp,money from ".$dbpre."duiw where id=".$d_id." "));

if($dui['exp']<>0 or $dui['money']<>0){
//exit($d_id);
$zongs=(1+$dui['shul'])*$dui['shul']/2;
$db->query("update ".$dbpre."duiw set exp=0,money=0 where id=".$d_id." ");
$sql="select id,p_id from ".$dbpre."user where d_id=".$d_id." order by lvl desc ";
$rs=$db->query($sql);
 while($row=mysql_fetch_row($rs))   //mysql_fetch_row函数取得一行返回数组
 {
$i++;
$exp=round($dui['exp']/2/$dui['shul']+$dui['exp']/2*$i/$zongs);
$pet_exp=round($exp*2/3);
$exp=round($exp*(1-2/3));
if($row[1]){
$pet_exp=$pet_exp*1/2;
$db->query("update ".$dbpre."pet set exp=exp+".$pet_exp." where id=".$row[1]." and uid=".$player_id." and zhuangt=1 ");
}

$db->query("update ".$dbpre."user set exp=exp+".$exp.",money=money+".round($dui['money']*$i/$zongs).",jif=jif+".round($pet_exp/10)." where id=".$row[0]." ");
 }
} 

} 

function up_player($name,$value,$player='',$group=0){
global $db,$dbpre,$player_id,$player_group_id;
if($player){
$tiaoj="name='".$player."' ";
}else{
$tiaoj="id=".$player_id." ";
} 
$str=substr($value,0,1);
if($str=="+" or $str=="-"){
$db->query("update ".$dbpre."player set `".$name."`=`".$name."`".$value." where ".$tiaoj);
} else{
$db->query("update ".$dbpre."player set `".$name."`=".$value." where ".$tiaoj);
} 

}


function get_build_lvl($name){
global $db,$data;
$build=$db->fetch_array($db->query("select id from build where name='".$name."' "));
return($data['jz'.$build['id']]);
} 

function get_item_num(){
global $db,$dbpre,$player_id;
$item=$db->fetch_array($db->query("select sum(num) as num from ".$dbpre."item where uid=".$player_id." "));
return($item['num']);
} 

function get_pet_num(){
global $db,$dbpre,$player_id;
$db->query("select id from ".$dbpre."pet where uid=".$player_id." ");
return($db->affected_rows());
} 

function delzb($id){
global $db,$dbpre,$data;
if($data[$id]<>0){
$data2=$db->fetch_array($db->query("select item_id,base,s_lvl,x_lvl,k_power from ".$dbpre."item where id=".$data[$id]." "));
//$data3=$db->fetch_array($db->query("select base from item where id=".$data2['item_id']." "));
$db->query("update ".$dbpre."user set power=power-".$data2['base']."-(".$data2['s_lvl']."*50)-(".$data2['x_lvl']."*20/100*".$data2['base'].")-".$data2['k_power'].",".$id."=0 where id=".$data['id']." ");
$db->query("update ".$dbpre."item set `use`=0 where id=".$data[$id]." ");

} 
}

?>