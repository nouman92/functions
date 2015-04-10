<?php include 'header.php';
if (isset($_SESSION['FBID']))
{
 header("Location: index.php");
 die();
}
?>

  <div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
      <form name="form_register" method="post" action="register.php" role="form">
        <fieldset>
          <h2>New User Registration</h2>
          <hr class="colorgraph">
		  <div class="form-group">
            <input name="user_name" type="text" id="user_name" class="form-control input-lg" placeholder="Your Name">
          </div>
          <div class="form-group">
            <input name="user_email" type="text" id="user_email" class="form-control input-lg" placeholder="Email Address">
          </div>
          <div class="form-group">
            <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
          </div>
		  <div class="form-group">
            <input type="password" name="password2" id="password2" class="form-control input-lg" placeholder=" RepeatPassword">
          </div>
		  <hr class="colorgraph">
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <input type="submit" name="Submit" value="Register" class="btn btn-lg btn-success btn-block">
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6"> <a href="./login.php"  class="btn btn-lg btn-info btn-block">Already have Login?</a> </div>
          </div>
		  <div class="row">
		   <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px"> <a href="./conf/fbconfig.php"  class="btn btn-lg btn-primary btn-block">Register With Facebook</a> </div>
		  </div>
        </fieldset>
      </form>
    </div>
  </div>

  <?php
//if submit is not blanked i.e. it is clicked.
if (isset($_REQUEST['Submit'])) //here give the name of your button on which you would like    //to perform action.
{
// here check the submitted text box for null value by giving there name.
	if($_REQUEST['user_email']=="" || $_REQUEST['password']=="" || $_REQUEST['user_name']=="" )
	{
	echo ' <div class="alert alert-danger alert-error ">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> All fields must be filled.
    </div>';
	}
	else if($_REQUEST['password'] !==$_REQUEST['password2'])
	{
		echo ' <div class="alert alert-danger alert-error ">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> Password does not match
    </div>';
	}
	else
	{
		function generateRandomString($length = 14) {
			$characters = '0123456789';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}

		$fuid = generateRandomString();
		while(true){
			$check = mysql_query("select * from Users where Fuid='$fuid'");
			$check = mysql_num_rows($check);
			if (empty($check)) {
				break;
			}
		}
		$femail = $_REQUEST['user_email'];
		$ffname = $_REQUEST['user_name'];
		$password = $_REQUEST['password'];
		$sql1 = "INSERT INTO Users (Fuid,Ffname,Femail,password) VALUES ('$fuid','$ffname','$femail','$password')";
		$result=mysql_query($sql1)
	    or exit("Sql Error".mysql_error());
		echo ' <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Success!</strong> Your Account has been created successfully. Pleaase login..
    </div>';
	}
}
?>
<?php include 'footer.php'; ?>