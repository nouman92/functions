<?php
include 'header.php';
?>

<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-5">
		<form role="form">
			<div class="form-group">
				<label for="code">New Code</label>
				<span class="form-group">
				<textarea name="code" id='code' class="lined"  style="height:400px; width:100%;" placeholder="Write Your Code Here" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"></textarea>
				</span> </div>
			<input type="button"  id="Submit1" value="Execute" class="btn btn-default" />
		</form>
	</div>
	<div class="col-md-4">
		<form role="form"  id="outputform">
		<label for="code">Recent Executions</label>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Functions</th>
						<th>Use This</th>
					</tr>
				</thead>
				<?php
			$check = mysql_query("select * from functions ");
			if (mysql_num_rows($check) != 0) { 
			$i=1;
			while($data = mysql_fetch_array($check))
			{
			echo '<tbody>
				<tr>
				
					<th scope="row">'.$i++.'</th>
					<td id="function'.$i.'">'.$data["function"].'</td>
					<td><input onclick="loadfunction('.$i.')" class="btn btn-default"  type="button" value="Load"></td>
				</tr>
			</tbody>' ;
			}
			 } 
			 ?>
			</table>
		</form>
	</div>
	<script>
		function loadfunction(id){
			debugger;
			 var data = document.getElementById("function"+id);
			 var form = document.getElementById("code");
             form.innerHTML = "";
			 form.appendChild(document.createTextNode(data.innerHTML));
		}
	</script>
</div>
<?php
include 'footer.php';
?>