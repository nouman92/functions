<?Php
require '../conf/dbconfig.php';
$in=$_GET['txt'];
$msg="";
if(strlen($in)>0 and strlen($in) <20 ){
$check = mysql_query("select functions.fid as id,name,tag from functions , tags where tags.fid=functions.fid and name like '%$in%' OR tag like '%$in%';");
if (mysql_num_rows($check) != 0)
{
$msg="<select ondblclick='selected_input(this);' class='form-control' style=' position:absolute; width:91%; margin-top:-15px; z-index:1000;' size='5' >";
while($nt = mysql_fetch_array($check)){
$msg .="<option value=$nt[id] >$nt[name]</option>";
}
$msg .='</select>';
}else
$msg="no results match..";
}

echo $msg;
?>