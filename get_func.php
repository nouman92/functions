<?Php
require './conf/dbconfig.php';
$in=$_POST['id'];
$msg="";
if(strlen($in)>0 and strlen($in) <20 ){
	$check = mysql_query("select inputs from functions where fid=$in;");
	if (mysql_num_rows($check) != 0)
	{
		$nt = mysql_fetch_array($check);
		$msg="function ".$nt[0];
	}
}
echo $msg;
?>