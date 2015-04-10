<?php
ini_set('display_errors', 1);
error_reporting(~0);
session_start();
require './conf/dbconfig.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Algorithem Executer</title>
<link href="css/bootstrap.css" type="text/css"  rel="stylesheet"  />
<link href="css/login.css" type="text/css" rel="stylesheet" />
<link href="css/jquery-linedtextarea.css" type="text/css" rel="stylesheet" />
<link href="css/icomoon.css" type="text/css" rel="stylesheet"/>
<link href="css/style.css" type="text/css" rel="stylesheet" />
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js" ></script>
<script src="js/jquery-linedtextarea.js"></script>
<script src="js/functions.js"></script>
<style>

</style>
</head>

<body >
<nav class="navbar navbar-default" role="navigation" >
	<div class="navbar-header" > <a href="#" class="navbar-brand"> <img class="navbar-fixed-top" src="images/Logo.png" /> </a> </div>
	<div>
		<form class="navbar-form pull-right" role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search" />
			</div>
			<button type="submit" class="btn btn-default">Search</button>
		</form>
		<ul class="nav navbar-nav pull-right">
			<?php if (isset($_SESSION['FBID'])): ?>
			<li  class=" active dropdown " > <a class="dropdown-toggle" href="#"  data-toggle="dropdown" > <img height="50px" width="50px" src=<?php echo $_SESSION['image'];?>> HI <?php echo $_SESSION['USERNAME']; ?> <span class="caret"></span> </a>
				<ul class="dropdown-menu" role="menu" >
					<li><a href="#"><?php echo $_SESSION['FULLNAME']; ?></a></li>
					<li><a href="myfunctions.php">Myfunctions</a></li>
					<li class="divider"></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
			<?php else: ?>
			<li class=" active dropdown "  >
			<a class="dropdown-toggle" href="#"  data-toggle="dropdown" >Account</a>
			<ul class="dropdown-menu" role="menu" >
				    <li class="divider"></li>
					<li><a href="./login.php">Login</a></li>
					<li class="divider"></li>
					<li><a href="./register.php">Register</a></li>
				    <li class="divider"></li>
			</ul>
			</li>
			<?php endif ?>
			<li ><a href="./">Home</a></li>
			<li ><a href="#">About</a></li>
			<li ><a href="#">Contact</a></li>
			<li ><a href="#">Help</a></li>
		</ul>
	</div>
</nav>