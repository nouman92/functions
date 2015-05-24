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
    </form>
  </div>
</div>
<?php
include 'footer.php';
?>