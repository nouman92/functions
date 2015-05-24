<?Php
require './conf/dbconfig.php';
$in=$_GET['txt'];
$msg="";
if(strlen($in)>0 and strlen($in) <20 ){
$check = mysql_query("select * from functions where name like '%$in%';");
if (mysql_num_rows($check) != 0)
{
$msg="<select id='selected_function' ondblclick='selected_fuction(this);' style=' position:absolute; z-index:1000;' size='".mysql_num_rows($check)."'>";
while($nt = mysql_fetch_array($check)){
$msg .="<option value=$nt[fid]:$nt[name]>$nt[name]</option>";
}
$msg .='</select>';
}else
$msg="no results match..";
}

echo $msg;
?>