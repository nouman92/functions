<?Php
require './conf/dbconfig.php';
$in=$_GET['txt'];
$msg="";
if(strlen($in)>0 and strlen($in) <20 ){
$check = mysql_query("select distinct functions.fid as id,name,tag from functions , tags where name like '%$in%' OR tag like '%$in%';");
if (mysql_num_rows($check) != 0)
{
$msg="<select ondblclick='selected_input(this);' class='form-control' style=' position:absolute; z-index:1000;' size='";
if(mysql_num_rows($check) > 5 )
{
	$msg .= 5;
}
else
{
	$msg .= mysql_num_rows($check);
}
$msg .="'>";
while($nt = mysql_fetch_array($check)){
$msg .="<option value=$nt[id]:$nt[name]>$nt[name]</option>";
}
$msg .='</select>';
}else
$msg="no results match..";
}

echo $msg;
?>