<!DOCTYPE>
<html>
<head>
<title>Algorithem Executer</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Cookie'  type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/style.css" />
</head>

<body >
<?php
include 'header.php';
?>
<div style="margin-top: 30px;" class="row">
  <div class="col-md-1"> </div>
  <div class="col-md-6">
    <form role="form">
      <div class="form-group">
        <label for="code">
        <h4>Algorithm</h4>
        </label>
        <textarea name="code" id='code' class="form-control lined"  style="height:380px; width:100%;" 
        placeholder="Write Your Code Here" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off">	
        </textarea>
      </div>
      <div class="form-group">
        <input type="button" style="width:200px;" id="Submit1" name="submit1" value="Execute" class ="btn btn-default" />
        <input type="button"  value="GO" class ="btn btn-default pull-right" 
        data-toggle="modal" data-target="#convert-code-modal"/>
        <select name="language" class="form-control pull-right"  style="width:200px; ">
          <option value="" disabled selected>Convert Code</option>
          <optgroup label="Languages">
          <option value="c++">C++</option>
          <option vlause="java">JAVA</option>
          <option value="php">PHP</option>
          </optgroup>
        </select>
      </div>
    </form>
  </div>
  <div class="col-md-4">
    <form role="form"  id="outputform">
      <div class="form-group">
        <label for="include">
        <h4 >Includes</h4>
        </label>
        <div id=msg></div>
        <input type="text" class="form-control" id="include" onKeyUp="ajaxFunction(this.value);"  />
      </div>
      <div id="displayDiv"></div>
      <div id="includes" name="includes"></div>
    </form>
  </div>
</div>
<?php
include 'footer.php';
?>
<script src="js/jquery.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="js/jquery-linedtextarea.js"></script>
<script src="js/functions.js"></script>
</body>
</html>