<?php include 'header.php';
if (isset($_SESSION['FBID']))
{
 header("Location: index.php");
 die();
}
?>
<div class="row" style="margin-top:20px">
	<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form name="form_login" method="post" action="login.php" role="form">
			<fieldset>
				<h2>Please Sign In</h2>
				<hr class="colorgraph">
				<div class="form-group">
					<input name="user_email" type="text" id="user_email" class="form-control input-lg" placeholder="Email Address">
				</div>
				<div class="form-group">
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
				</div>
				<span class="button-checkbox">
				<button type="button" class="btn" data-color="info">Remember Me</button>
				<!-- Additional Option -->
				<input type="checkbox" name="remember_me" id="remember_me" checked="checked" class="hidden">
				<hr class="colorgraph">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<input type="submit" name="Submit" value="Login" class="btn btn-lg btn-success btn-block">
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6"> <a href="./register.php"  class="btn btn-lg btn-info btn-block">Register</a> </div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px"> <a href="./conf/fbconfig.php"  class="btn btn-lg btn-primary btn-block">Login With Facebook</a> </div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
<?php  //if submit is not blanked i.e. it is clicked.
if (isset($_REQUEST['Submit'])) //here give the name of your button on which you would like    //to perform action.
{
// here check the submitted text box for null value by giving there name.
	if($_REQUEST['user_email']=="" || $_REQUEST['password']=="")
	{
	echo ' <div class="alert alert-danger alert-error ">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> All fields must be filled.
    </div>';
	}
	else
	{
	   $sql1= "select * from Users where Femail= '".$_REQUEST['user_email']."' &&  password ='".$_REQUEST['password']."'";
  	   $result=mysql_query($sql1)
	    or exit("Sql Error".mysql_error());
	    $num_rows=mysql_num_rows($result);
	   if($num_rows>0)
	   {
		   $row = mysql_fetch_row($result);
			$_SESSION['USERNAME'] = $row[2];
	        $_SESSION['FBID'] = $row[1];
            $_SESSION['FULLNAME'] = $row[2];
	        $_SESSION['EMAIL'] = $row[3];
			$_SESSION['image'] = './images\unavailable.png';
			header("Location: index.php");
        }
	    else
		{
			echo ' <div class="alert alert-danger alert-error ">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> Invalid email or password.
    </div>';
		}
	}
}
?>
<?php include 'footer.php'; ?>