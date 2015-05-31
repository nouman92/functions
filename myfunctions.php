<!DOCTYPE>
<html>
<head>
<title>Algorithem Executer</title>
<script src="js/jquery.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="js/jquery-linedtextarea.js"></script>
<script src="js/functions.js"></script>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Cookie'  type='text/css'>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/style.css" />

</head>

<body >
<?php include 'header.php';
if (!isset($_SESSION['FBID']))
{
 header("Location: login.php");
 die();
}
?>

<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-5">
		<?php
	$FBID = $_SESSION['FBID'];
			$check = mysql_query("select UID from users where Fuid = '$FBID';");
			if (mysql_num_rows($check) != 0) { 
			$data = mysql_fetch_array($check);
			echo'	<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Functions</th>
				</tr>
			</thead> ';
			$UID = $data["UID"];
			$check = mysql_query("select * from functions where UID = '$UID';");
			if (mysql_num_rows($check) != 0) { 
			$i=1;
			while($data = mysql_fetch_array($check))
			{
			echo '<tbody>
				<tr>
				
					<th scope="row">'.$i++.'</th>
					<td>'.$data["function"].'</td>
				
				</tr>
			</tbody>' ;
			}
			 } 
			 else
			 {
				 echo '<h3>You have not created any algorithm yet</h3>
				 <h4><a href="./index.php">Write First One</a></h4>
				 ';
			 }
			 echo '</table>
	</div>
	<div class="col-md-4"> </div>
</div>';
			 ?>
			
		
		<?php
}?>

<?php include 'footer.php'; ?>
</body>
</html>
