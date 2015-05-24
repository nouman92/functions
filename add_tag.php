<?php
require './conf/dbconfig.php';
session_start();
if (isset($_SESSION['FBID']))
{
		if($_POST)
		{
			$FBID = $_SESSION['FBID'];
			$check = mysql_query("select UID from users where Fuid = '$FBID';");
			if (mysql_num_rows($check) != 0) {
				$data = mysql_fetch_array($check);
				$UID = $data["UID"];
				
				$function = $_POST["code"];
				mysql_query("insert into functions (UID,function) values ('$UID','$function');");
				$fid = mysql_insert_id();
				$input= $_POST['input'];
				mysql_query("insert into inputs (fid,input) values ('$fid','$input');");
				$output= $_POST['output'];
				mysql_query("insert into outputs (fid,output) values ('$fid','$output');");
			}
		}
}
else
	echo 'Please Login to save data' ;
?>