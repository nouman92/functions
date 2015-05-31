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
    <form name="form_login" method="post" action="login.php" role="form">
      <fieldset>
        <h2>Please Sign In</h2>
        <hr class="colorgraph">
         <?php  //if submit is not blanked i.e. it is clicked.
if (isset($_REQUEST['login'])) //here give the name of your button on which you would like    //to perform action.
{
// here check the submitted text box for null value by giving there name.
	if($_REQUEST['email'] == "" )
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
	else
	{
	   $sql1= "select * from users where Femail= '".$_REQUEST['email']."' &&  password ='".$_REQUEST['password']."'";
  	   $result=mysql_query($sql1)
	    or 
		die ( '<div class="row">
			  <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px"> 
			  <div class="alert alert-danger alert-error ">
			  <a href="#" class="close" data-dismiss="alert">&times;</a>
			  '.mysql_error().
			  '</div></div></div>' );
       $num_rows=mysql_num_rows($result);
	   if($num_rows>0)
	   {
		   $row = mysql_fetch_row($result);
			$_SESSION['USERNAME'] = $row[2];
	        $_SESSION['FBID'] = $row[1];
            $_SESSION['FULLNAME'] = $row[2];
	        $_SESSION['EMAIL'] = $row[3];
			$_SESSION['image'] = './images/unavailable.png';
			header("Location: index.php");
        }
	    else
		{
			echo '<div class="alert alert-danger alert-error ">
				  <a href="#" class="close" data-dismiss="alert">&times;</a>
				  <strong>Error!</strong> Invalid email or password.</div>';
		}
	}
}
?>
        <div class="form-group">
          <input name="email" type="email" id="email" class="form-control input-lg" placeholder="Email">
        </div>
        <div class="form-group">
          <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
        </div>
        <div class="row">
          <div class="col-xs-6 col-sm-6 col-md-6">
            <input type="submit" name="login" value="Login" class="btn btn-lg btn-success btn-block">
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6"> 
          <a href="./register.php"  class="btn btn-lg btn-info btn-block">Register</a> 
          </div>
            <div class="col-xs-12 col-sm-12 col-md-12"><a class="btn " href="forget_password.php" >Forget Password?</a>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:20px">
           <a href="./conf/fbconfig.php"  class="btn btn-lg btn-primary btn-block">Login With Facebook</a> 
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
