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
<?php
include 'header.php';
if (isset($_SESSION['FBID']))
{
 header("Location: index.php");
 die();
}
?>
<div class="container">
  <div class="col-md-4">
    <h1>Password recovery</h1>
    <form class="recovery box" action="#" id="recover-form" method="POST">
     <?php  
if (isset($_REQUEST['resetpass'])) 
{
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
	else
	{
	   $sql1= "select * from users where Femail = '".$_REQUEST['email']."'";
  	   $result=mysql_query($sql1);
       $num_rows=mysql_num_rows($result);
	   if($num_rows>0)
	   {
		   $row = mysql_fetch_row($result);
		   $pass  =  $rows['password'];//FETCHING PASS
		   $to = $rows['Femail'];
		   $from = "Algorithm Executor Team";
		   $url = "http://localhost/functions/login.php";
		   $body  =  "Dear ".$rows['name']."
		we recieved your request to recover your password.
		Go to this Url : $url;
		Detials are.
		email  : $to;
		password  : $pass;
		
		Sincerely,
		Algorithm Executor Team";
		$from = "bcsf11a001@pucit.edu.pk";
		$subject = "Algorithm Executor password recovered";
		$headers1 = "From: $from\n";
		$headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
		$headers1 .= "X-Priority: 1\r\n";
		$headers1 .= "X-MSMail-Priority: High\r\n";
		$headers1 .= "X-Mailer: Just My Server\r\n";
		$sentmail = mail ( $to, $subject, $body, $headers1 );
			if($sentmail==1)
			{
			echo '<div class="alert  alert-success ">
					  <a href="#" class="close" data-dismiss="alert">&times;</a>
					  We have sent an email having your password.</div>';
			}
			else
			{
				'<div class="alert alert-danger alert-error ">
					  <a href="#" class="close" data-dismiss="alert">&times;</a>
					 Unable to recover your password, Please contact our team.</div>';
			}
        }
	    else
		{
			echo '<div class="alert alert-danger alert-error ">
				  <a href="#" class="close" data-dismiss="alert">&times;</a>
				  Email provided is not registered with our system.</div>';
		}
	}
}
?>
      <div class="form-group">
      <label for="email" class="sr-only">Email</label>
      <input  id="email" class="form-control" type="email" name="email" placeholder="Email">
      </div>
      <div class="form-group">
      <button class="btn" name="resetpass" type="submit" >Request Password</button>
      </div>
    </form>
  </div>
  </div>
</div>
<?php
include 'footer.php';
?>
</body>
</html>