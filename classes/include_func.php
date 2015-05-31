<?Php
require '../conf/dbconfig.php';
ini_set('display_errors', 0);
error_reporting(0);
$in=$_GET['id'];
$msg='';
if(strlen($in)>0 and strlen($in) <20 ){
	try{
		$check = mysql_query("select function from functions where fid=$in;");
		if (mysql_num_rows($check) != 0)
		{
			$nt = mysql_fetch_array($check);
			$msg.="function ".$nt[0];
		}
		  
	}
	catch(Exception $e)
	{
		echo 'Error:'.$e ;
	}
}
  echo $msg;
?>