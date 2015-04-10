<?php
include 'header.php';

if (!isset($_SESSION['FBID']))
{
 header("Location: index.php");
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