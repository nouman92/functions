<?php
include 'header.php';
?>
<div class="row">
  <div class="col-md-1"> </div>
  <div class="col-md-5">
    <form role="form">
      <div class="form-group">
        <label for="code">
        <h4>Psudo Code</h4>
        </label>
        <span class="form-group">
        <textarea name="code" id='code' class="lined"  style="height:400px; width:100%;" placeholder="Write Your Code Here" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off"></textarea>
        </span> </div>
      <input type="button"  id="Submit1" value="Execute" class ="btn btn-default" />
    </form>
  </div>
  <div class="col-md-4">
    <form role="form"  id="outputform">
      <label> Languages</label>
      <label>
        <input style="vertical-align:middle" type="radio" name="lang" value="C" >
        <span style="vertical-align:middle" >C</span></label>
      <label>
        <input style="vertical-align:middle" type="radio" name="lang" value="C++" >
        <span style="vertical-align:middle" >C++</span></label>
      <label>
        <input style="vertical-align:middle" type="radio" name="lang" value="JAVA" >
        <span style="vertical-align:middle" >Java</span></label>
      <label>
        <input style="vertical-align:middle" type="radio" name="lang" value="PHP" >
        <span style="vertical-align:middle" >PHP</span></label>
      <br/>
      <hr>
      <label>Tags</label>
      <input type="text" name="tag" id="tag" class="form-control" onkeydown="if (event.keyCode == 13) add_tag(this);" />
      <div id="tags" ></Div>
      <hr class='col-md-11'>
      <h4 class='col-md-11' style="padding-left:0px;">Includes</h4>
      <div id=msg></div>
      <input type="text" class="form-control" id="incude" onkeyup="ajaxFunction(this.value);"  />
      <div id="displayDiv"></div>
      <div id="includes" name="includes"></div>
      <script>
      function use_Dataset()
	  {
		  debugger;
		  document.getElementById("outputform").innerHTML='';
		  $("#outputform").append("<br/><label>Search data</label><br/><input type='text' class='form-control' id='datatag' onkeyup='ajax_tag_data(this.value);' /><br/> <div id='displayTags'></div><br/><div id='displaydata'></div>");
	  }
	  function selected_input(str)
		{
			debugger;
			var httpxml;
			try  {
			  // Firefox, Opera 8.0+, Safari
			  httpxml=new XMLHttpRequest();
			  }
			catch (e){
			  // Internet Explorer
			  try{
					httpxml=new ActiveXObject("Msxml2.XMLHTTP");
			  }
			  catch (e){
				try{
				  httpxml=new ActiveXObject("Microsoft.XMLHTTP");
				  }
				catch (e){
				  alert("Your browser does not support AJAX!");
				  return false;
				  }
				}
			}
			var url="get_inputs.php";
			str=str.options[str.selectedIndex].value.split(":")[0];
			url=url+"?id="+str;
			function dataget() 
			{
				if(httpxml.readyState==4){
					document.getElementById("displaydata").innerHTML=httpxml.responseText;
				}
			}
			httpxml.onreadystatechange=dataget;
			httpxml.open("GET",url,true);
			httpxml.send(null);
			var list=document.getElementById("displayTags");
			list.innerHTML="";
		}
      </script>
    </form>
  </div>
</div>
<?php
include 'footer.php';
?>