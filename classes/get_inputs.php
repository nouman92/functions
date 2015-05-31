<?Php
require '../conf/dbconfig.php';
ini_set('display_errors', 0);
error_reporting(0);
$in=$_GET['id'];
$msg="<div class='alert alert-success' ><a href='#' class='close' data-dismiss='alert'>&times;</a>";
if(strlen($in)>0 and strlen($in) <20 ){
	try{
		$check = mysql_query("select input from inputs where fid=$in;");
		if (mysql_num_rows($check) != 0)
		{
			$nt = mysql_fetch_array($check);
			$elements=split(";",$nt[0]);
			foreach($elements as &$element)
			{
				if (strpos($element,'array') !== false) {
					$data =split(",",substr($element,strpos($element,'{')+1,strpos($element,'}')-1));
					$msg .='<div  >';
					$i=0;
					foreach($data as &$ele)
					{
						if($i > 9)
						{
							$msg .= '<br/>  ';
							$i=0;
						}
						$i++;
						$msg .= '<input  type="text" style="width:30px; margin-bottom:2px;" contenteditable="false" disabled="disabled" value="'.$ele.'"/>';
					}
					$msg .= '</div> ,';
				}
				else
				{
					$msg .= '<input  type="text" style="width:30px; margin-bottom:4px;" contenteditable="false" disabled="disabled" value="'.$element.'"/> , <br/>';
				}
			}
					}
	}
	catch(Exception $e)
	{
		echo 'Error:'.$e ;
	}
}
$msg.="<br/><input class='btn btn-default' style='width: 180px;' type='button' value='Use' onclick='use($in);' /> <input class='btn btn-default' type='button' style='width: 180px;' value='Back' onclick='makeform();' /></div>";
echo $msg;
?>