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
        <?php
//if submit is not blanked i.e. it is clicked.
if (isset($_REQUEST['signup'])) //here give the name of your button on which you would like    //to perform action.
{
// here check the submitted text box for null value by giving there name.
	if($_REQUEST['name'] == "" )
	{
	echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px"> 
		<div class="alert alert-danger alert-error ">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> Please Enter the Name.
    	</div>
		</div>
		</div>';
	}
	else if(!preg_match("/^[a-zA-Z ]*$/",$_REQUEST['name']))
	{
	echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px"> 
		<div class="alert alert-danger alert-error ">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> Please Enter the Valid name, Only charaters and white spaces are allowed.
    	</div>
		</div>
		</div>';
	}
	else if($_REQUEST['email'] == "" )
	{
	echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px"> 
		<div class="alert alert-danger alert-error ">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> Please Enter the Email.
    	</div>
		</div>
		</div>';
	}
	else if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) 
	{
  		echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px"> 
		<div class="alert alert-danger alert-error ">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong>Please enter a valid Email.
    	</div>
		</div>
		</div>'; 
	}
	else if($_REQUEST['password']=="")
	{
		echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px"> 
		<div class="alert alert-danger alert-error ">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> Please Enter the Password.
    	</div>
		</div>
		</div>';
	}
	else if($_REQUEST['password2']=="")
	{
		echo '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px"> 
		<div class="alert alert-danger alert-error ">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> Please Repeat the Password.
    	</div>
		</div>
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
		$femail = $_REQUEST['email'];
		$ffname = $_REQUEST['name'];
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
        <div class="form-group">
          <input name="name" type="text" id="name" class="form-control input-lg" placeholder="Name">
        </div>
        <div class="form-group">
          <input name="email" type="email" id="email" class="form-control input-lg" placeholder="Email">
        </div>
        <div class="form-group">
          <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
        </div>
        <div class="form-group">
          <input type="password" name="password2" id="password2" class="form-control input-lg" placeholder=" Repeat Password">
        </div>
        <hr class="colorgraph">
        <div class="row">
          <div class="col-xs-6 col-sm-6 col-md-6">
            <input type="submit" name="signup" value="Register" class="btn btn-lg btn-success btn-block">
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6"> <a href="./login.php"  class="btn btn-lg btn-info btn-block">Already have Login?</a> </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px"> <a href="./conf/fbconfig.php"  class="btn btn-lg btn-primary btn-block">Register With Facebook</a> </div>
        </div>
      </fieldset>
    </form>
  </div>
</div><?php include 'footer.php'; ?>
</body>
</html>
