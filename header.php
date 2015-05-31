<?php
ini_set('display_errors', 0);
error_reporting(0);
session_start();
require './conf/dbconfig.php';
?>

<header class="header-basic-light">
  <div class=" header-limiter">
    <nav class="navbar">
      <div class="navbar-header">
       <a href="./"> <h1 >Algorithm<span>Executor</span></h1></a>
      </div>
      <div>
      <?php if (isset($_SESSION['FBID'])): ?>
      <div class="navbar navbar-nav pull-right" id="navbar-main">
      <ul>
        <li  class=" form-control active dropdown " > <a class="dropdown-toggle" href="#"  data-toggle="dropdown" > <img height="20px" width="20px" src=<?php echo $_SESSION['image'];?>> HI <?php echo $_SESSION['USERNAME']; ?> <span class="caret"></span> </a>
          <ul class="dropdown-menu" role="menu" >
            <li><a href="profile.php"><?php echo $_SESSION['FULLNAME']; ?> <i class="fa fa-wrench"></i></a></li>
            <li><a href="myfunctions.php">Myfunctions</a></li>
            <li class="divider"></li>
            <li><a href="logout.php">Logout<i class="fa fa-power-off padding-left-ten-px red-text"></i></a></li>
          </ul>
        </li>
      </ul>
      </div>
      <?php else: ?>
      <div class="navbar navbar-nav pull-right" id="navbar-main">
        <div class="dropdown pull-right">
          <button style="height:33px; margin-top:11px;" class="btn btn-default" type="button" data-toggle="dropdown"> <span class="caret"></span></button>
          <ul class="dropdown-menu popover">
              
            <form class="signupform" action="register.php" method="post">
            <div class="form-group">
                <label for="name" class="sr-only">Name</label>
                <input id="name" class="form-control" type="text" name="name" placeholder="Name">
              </div>
              <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input id="email" class="form-control" type="email" name="email" placeholder="Email">
              </div>
              <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input id="password" class="form-control" type="password" name="password" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="password2" class="sr-only">Repeat Password</label>
                <input id="password2" class="form-control" type="password" name="password2" placeholder="Repeat Password">
              </div>
              <div class="form-group">
              <button class="btn btn-default form-control" name="signup" type="submit">Register</button>
              </div>
              <hr />
               <div class="form-group">
              <button class="btn btn-default form-control"><a  href="./conf/fbconfig.php"  >FaceBook Login</a></button>
              </div>
              </form>
          </ul>
        </div>
        <div class="navbar-form pull-right">
          <form   action="login.php" method="post">
            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <button type="submit" name="login" class="btn btn-default">Sign In</button>
          </form>
        </div>
        <?php endif ?>
      </div>
    </nav>
  </div>
</header>
