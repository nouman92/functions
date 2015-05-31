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
if (!isset($_SESSION['FBID']))
{
 header("Location: login.php");
 die();
}
?>
<br>
<form action="profile.php" method="post">
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12 lead">
                Edit profile
                <hr>
              </div>
            </div>
		<div class="row">
              <div class="col-md-4 text-center">
                <div id="img-preview-block" class="img-circle avatar avatar-original center-block" style="background-size:cover; 
                background-image:url(<?php echo $_SESSION['image'] ?>?size=120x120)"></div>
                <br>
                <span class="btn btn-link btn-file">Edit avatar <input type="file" id="upload-img"></span>
              </div>
              <div class="col-md-8">
             <?php  if (isset($_REQUEST['update']))
			 {
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
		$fuid =  $_SESSION['FBID'];
		$femail = $_REQUEST['email'];
		$ffname = $_REQUEST['name'];
		$password = $_REQUEST['password'];
		$sql1 = "update Users set Ffname='$ffname',Femail='$femail',password='$password' where Fuid='$fuid' ; ";
		$result=mysql_query($sql1)
	    or exit("Sql Error".mysql_error());
		echo ' <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Success!</strong> Your profile has been updated successfully.</div>';
		   
        $_SESSION['FULLNAME'] = $ffname;
	    $_SESSION['EMAIL'] =  $femail;
	}
}
?>
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" value="<?php echo  $_SESSION['FULLNAME'] ?>" id="name">
                </div>
                <div class="form-group">
                  <label for="name">Email</label>
                  <input type="email" class="form-control" value="<?php echo  $_SESSION['EMAIL'] ?>" id="Email" name="email">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" id="password">
                </div>
                 <button onClick="event.preventDefault();"  class="btn btn-primary "  data-toggle="modal" data-target="#password_repeat" ><i class="glyphicon glyphicon-floppy-disk"></i> Update</button>	              
                
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <hr>
                  <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#delete-user-modal">
                  Delete My account
                </button>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="password_repeat" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <p>Repeat your password?</p>
          <div class="form-group">
          <input type="password" name="password2" id="password2" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" name="update" class="btn btn-danger">ok</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <div id="delete-user-modal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <p>Are you sure you want to delete account?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" name="delete"class="btn btn-danger">Delete</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>


<?php
include 'footer.php';
?>
</body>
</html>