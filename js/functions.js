$("#Submit3").click(function() {
  var form = document.getElementById("outputform");
  form.innerHTML = "";
  $("#code").prop("readonly", false);
});


$(document).ready(function() {
  $(function() {
    $(".lined").linedtextarea({selectedLine:1});
  });
  $("#Submit1").click(function() {
    try {
		store_locally();
		test();
		includes();
        makeform();
		Read_Inputs();
    } catch (e) {
      $("#code").prop("readonly", false);
      var form = document.getElementById("outputform");
      form.innerHTML = "";
      var lable = document.createElement("Lable");
      var text = document.createTextNode("Errors");
      lable.appendChild(text);
      form.appendChild(lable);
      form.appendChild(document.createElement("br"));
      form.appendChild(document.createElement("br"));
      span = document.createElement("span");
      span.appendChild(document.createTextNode(e.name));
      form.appendChild(span);
      form.appendChild(document.createElement("br"));
      form.appendChild(document.createTextNode(e.message));
    }
  });
});

function store_locally()
{
	debugger;
	var div_functions=document.getElementById("includes").childNodes;
	var function_id=[];
	for(var i=0; i <div_functions.length ; i++)
	{
		function_id.push(div_functions[i].childNodes[1].textContent.split(":")[0]);
		 
	}
	localStorage["function_ids"] = JSON.stringify(function_id);
	//--------------------------------------------------------------
	var div_tags=document.getElementById("tags").childNodes;
	var tags = [];
	for(var i=0; i <div_tags.length ; i++){
		tags.push(div_tags[i].childNodes[1].textContent);
	}
	localStorage["tags"] = JSON.stringify(tags);
	var storedNames = JSON.parse(localStorage["tags"]);
	var tags = localStorage["tags"];
	//--------------------------------------------------------------
	
	var pattern = new RegExp("[a-z]+[[0-9]*]", "g");
	//--------------------------------------------------------------
	var code  = document.getElementById("code").value;
	var parameters = code.substring(code.indexOf("(") + 1, code.indexOf(")")).split(",");
    localStorage["parameters"] = JSON.stringify(parameters);
	//--------------------------------------------------------------
	var function_name = code.substring(0, code.indexOf(")") + 1);
	localStorage["function_name"] = function_name;
	//--------------------------------------------------------------  
	localStorage["orignal_code"] = code;
	//--------------------------------------------------------------
	var prototype = code.substring(0, code.indexOf(")") + 1);
    var arrays = prototype.match(pattern);
	if(arrays != null)
	  for (var i = 0;i < arrays.length;i++) {
		prototype = prototype.replace(arrays[i], arrays[i].substring(0, arrays[i].indexOf("[")));
	  }
	localStorage["prototype"] = prototype;
	//--------------------------------------------------------------
	code = "function " + prototype + code.substring(code.indexOf(")") + 1, code.lastIndexOf("}") + 1)
	localStorage["code"] = code;
	//--------------------------------------------------------------
	  
}

function includes()
{
	debugger;
	var ids = JSON.parse(localStorage["function_ids"]);
	for(var i=0; i <ids.length ; i++)
	{
		 $.ajax({
            type: "POST",
            url: "./get_func.php",
            data: {id: ids[0]},
			success: function(data){  
				var script = document.createElement("script");
    			script.type = "text/javascript";
    			script.appendChild(document.createTextNode(data));
    			$("head").append(script);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
			}
        });
	}
}

function test()
{
	debugger;
	var code = localStorage["code"]
	eval(code);
}

function makeform() {
  $("#code").prop("readonly", true);
  var code = $("#code").val();
  var pattern = new RegExp("[a-z]+[[0-9]*]");
  
  var parameters = JSON.parse(localStorage["parameters"]);
  var function_name =  localStorage["function_name"] ;
  // check for parameter null
  if (parameters.length != 0) {
    var form = document.getElementById("outputform");
    form.innerHTML = "";
    var lable = document.createElement("label");
    var text = document.createTextNode("Code Inputs");
    lable.appendChild(text);
    form.appendChild(lable);
    form.appendChild(document.createElement("br"));
    form.appendChild(document.createTextNode("To Continue Executing " + function_name + " Provide the Values of the following  arameters"));
    form.appendChild(document.createElement("br"));
    for (var i = 0;i < parameters.length;i++) {
      if (pattern.test(parameters[i])) {
		  debugger;
        var size = parseInt(parameters[i].substring(parameters[i].indexOf("[") + 1,parameters[i].indexOf("]") ));
       if(isNaN(size))
	  {
		  var lable = document.createElement("label");
          var text = document.createTextNode("Value for " + parameters[i]);
          lable.appendChild(text);
		  lable.setAttribute("for", parameters[i]);
		  $("#outputform").append(lable);
          $("#outputform").append('<form class="form-control" id="arr_' + i + '"></form>');
		  $("#arr_" + i).append('<input type="button" onclick=rmelement('+i+'); value="-"  style="width:30px;margin-left:4px;" />')
		  $("#arr_" + i).append('<input class="remove" type="button" onclick=addelement('+i+'); value="+"  style="width:30px;margin-left:4px;" />');
		  $("#arr_" + i).append('<input  type="text" style="width:30px;margin-left:4px;">');
      }else if (size > 0) {
          var lable = document.createElement("label");
          var text = document.createTextNode("Value for " + parameters[i]);
          lable.appendChild(text);
          lable.setAttribute("for", parameters[i]);
          $("#outputform").append(lable);
          $("#outputform").append('<form class="form-control" id="arr_' + i + '"></form>');
          for (var j = 0;j < size;j++) {
            $("#arr_" + i).append('<input placeholder="' + j + '" type="text" id="arr_' + i + '"style="width:30px;margin-left:4px;">');
          }
        }
	  } else {
        var lable = document.createElement("label");
        var text = document.createTextNode("value for " + parameters[i]);
        lable.appendChild(text);
        lable.setAttribute("for", parameters[i]);
        form.appendChild(lable);
        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("name", parameters[i]);
        input.setAttribute("id", parameters[i]);
        input.setAttribute("class", "form-control");
        form.appendChild(input);
      }
    }
    form.appendChild(document.createElement("br"));
    var input = document.createElement("input");
    input.setAttribute("type", "button");
    input.setAttribute("id", "Submit2");
    input.setAttribute("Value", "Proceed");
    form.appendChild(input);
    form.appendChild(document.createElement("br"));
    form.appendChild(document.createTextNode("---OR---"));
    form.appendChild(document.createElement("br"));
    var input = document.createElement("input");
    input.setAttribute("type", "button");
    input.setAttribute("id", "fetch");
	input.setAttribute("onclick", "random_data()");
    input.setAttribute("Value", "Use Random Data");
    form.appendChild(input);
	
	form.appendChild(document.createElement("br"));
    form.appendChild(document.createTextNode("---OR---"));
    form.appendChild(document.createElement("br"));
    var input = document.createElement("input");
    input.setAttribute("type", "button");
    input.setAttribute("id", "fetch");
	input.setAttribute("onclick", "use_Dataset()");
    input.setAttribute("Value", "Use From Data Set");
    form.appendChild(input);
    
  } else {
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.appendChild(document.createTextNode("function " + code));
    $("head").append(script);
    eval('display_output( "' + function_name + '" ,' + function_name + ");");
  }
}


function Read_Inputs() {
  var parameters = JSON.parse(localStorage["parameters"]);
  var in_data='';
  var fname = localStorage["function_name"];
  var function_call = fname.substring(0, fname.indexOf("(") + 1);
  var expression = "";
  try {
    $("#Submit2").click(function() {
      debugger;
	  var pattern = new RegExp("[a-z]+[[0-9]*]", "g");
	  for (var i = 0;i < parameters.length;i++) {
        if (pattern.test(parameters[i])) {
          var arr = new Array;
		  var array_elements = document.getElementById("arr_" + i).elements;
          for (var j = 0, element;element = array_elements[j++];) {
            if (element.type === "text") {
              if (element.value != "") {
                arr.push(element.value);
              } else {
                alert("Please Provide All Inputs for " + parameters[i]);
                return;
              }
            }
          }
		  in_data += "array:{"+arr+"} ;";
          expression += "var " + parameters[i].substring(0, parameters[i].indexOf("[")) + " = [" + arr + "];";
          function_call += parameters[i].substring(0, parameters[i].indexOf("[")) + ",";
        } else {
          var element = document.getElementById(parameters[i]);
          if (element.value != "") {
			in_data += element.value  +";";
            function_call += element.value + ",";
          } else {
                alert("Please Provide All Inputs for " + parameters[i]);
                return;
          }
        }
      }
      debugger;
      function_call = function_call.substring(0, function_call.lastIndexOf(",")) + ")";
      var code = localStorage["code"];
      var script = document.createElement("script");
      script.type = "text/javascript";
      script.appendChild(document.createTextNode(code));
	  expression += 'display_output( "' + localStorage["prototype"] + '" ,' + function_call + ");";
	  script.appendChild(document.createTextNode(expression));
      $("head").append(script);
	  debugger;
	   $.ajax({
            type: "POST",
            url: "./store.php",
            data: {input: in_data , code : localStorage["orignal_code"] , output: eval(function_call+";"), tags : localStorage["tags"]},
			success: function(data){  
				//alert(data);
				localStorage.clear();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
			}
        });
    });
  } catch (e) {
    $("#code").prop("readonly", false);
    var form = document.getElementById("outputform");
    form.innerHTML = "";
    var lable = document.createElement("Lable");
    var text = document.createTextNode("Errors");
    lable.appendChild(text);
    form.appendChild(lable);
    form.appendChild(document.createElement("br"));
    form.appendChild(document.createElement("br"));
    span = document.createElement("span");
    span.appendChild(document.createTextNode(e.name));
    form.appendChild(span);
    form.appendChild(document.createElement("br"));
    form.appendChild(document.createTextNode(e.message));
  }
}

function addelement(form)
{
	 $("#arr_" + form).append('<input  type="text" style="width:30px;margin-left:4px;">');
}


function rmelement(form)
{
	if(!$("#arr_" + form).children().last().is(document.getElementsByClassName('remove')) )
	 	$("#arr_" + form).children().last().remove();
}


function random_data()
{
	debugger;
	var inputs=$("#outputform input[type='text']");
	for(var i=0 ; i < inputs.size() ; i++)
	{
		inputs[i].value=Math.floor((Math.random() * 10) + 1);
	}
	var arrays=$("#outputform form");
	for(var i=0 ; i < arrays.size() ; i++)
	{
			for (var j = 0, element;element = arrays[j++];) {
            if (element.type === "text") {
				element.value= Math.floor((Math.random() * 10) + 1);
				}
			}
	}
}

function display_output(function_name, result) {
  debugger;
  if (result == null) {
    result = "Empty";
  }
  var form = document.getElementById("outputform");
  form.innerHTML = "";
  var lable = document.createElement("label");
  var text = document.createTextNode("Code Output");
  lable.appendChild(text);
  form.appendChild(lable);
  form.setAttribute("class", "success");
  form.appendChild(document.createElement("br"));
  form.appendChild(document.createTextNode("The Function "));
  var span = document.createElement("span");
  span.appendChild(document.createTextNode("" + function_name));
  form.appendChild(span);
  form.appendChild(document.createTextNode(" Executed Sucessfully and value returned is "));
  span = document.createElement("span");
  span.appendChild(document.createTextNode("" + result));
  form.appendChild(span);
  form.appendChild(document.createElement("br"));
  form.appendChild(document.createElement("br"));
  var resetbtn = document.createElement("input");
  resetbtn.setAttribute("type", "submit");
  resetbtn.setAttribute("id", "Submit3");
  resetbtn.setAttribute("value", "Reset");
  form.appendChild(resetbtn);
}

function selected_fuction(e)
{
	$("#includes").append("<div class='alert alert-success' style=' padding:5px; margin:5px; float:left;'><a href='#' class='close' data-dismiss='alert'>&times;</a>"+e.options[e.selectedIndex].value+"</div>");
	var list=document.getElementById("displayDiv");
	list.innerHTML="";
}

function add_tag(e)
{
	$("#tags").append("<div class='alert alert-success' style=' padding:5px; margin:5px; float:left;'><a href='#' class='close' data-dismiss='alert'>&times;</a>"+ document.getElementById('tag').value +"</div>");
	 event.preventDefault();
}
    
	
function ajaxFunction(str)
{
var httpxml;
try
  {
  // Firefox, Opera 8.0+, Safari
  httpxml=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    httpxml=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      httpxml=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
function stateChanged() 
{
	if(httpxml.readyState==4){
		document.getElementById("displayDiv").innerHTML=httpxml.responseText;
		document.getElementById("msg").style.display='none';
	}
}
	var url="ajax-search-demock.php";
	url=url+"?txt="+str;
	url=url+"&sid="+Math.random();
	httpxml.onreadystatechange=stateChanged;
	httpxml.open("GET",url,true);
	httpxml.send(null);
	document.getElementById("msg").innerHTML="Please Wait ...";
	document.getElementById("msg").style.display='inline';
}

function ajax_tag_data(str)
{
	
var httpxml;
try
  {
  // Firefox, Opera 8.0+, Safari
  httpxml=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    httpxml=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      httpxml=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
	function datachange() 
	{
		if(httpxml.readyState==4){
			document.getElementById("displayTags").innerHTML=httpxml.responseText;
		}
	}
	var url="ajax-search-data.php";
	url=url+"?txt="+str;
	httpxml.onreadystatechange=datachange;
	httpxml.open("GET",url,true);
	httpxml.send(null)
}
function use(id)
{
	debugger;
	var variables;
	makeform();
	$.ajax({
            type: "GET",
            url: "./get_func.php",
            data: {id: id},
			success: function(data){ 
			debugger; 
				variables= data.split(';');
				var inputs=$("#outputform input[type='text']");
	var singles=[];
	var array=[];
	for(var i=0 ; i < variables.length ; i++)
	{
		if(variables[i].indexOf("array") == -1)
		{
			singles.push(variables[i]);
		}
		else
		{
			array.push(variables[i].substring(variables[i].lastIndexOf("{")+1,variables[i].lastIndexOf("}")));
		}
			
	}
	singles.pop();
	for(var i=0 ; i < inputs.size() ; i++)
	{
		try{
		inputs[i].value=singles.pop();
		}catch(e)
		{
			inputs[i].value=Math.floor((Math.random() * 10) + 1);
		}
	}
	var arrays=$("#outputform form");
	for(var i=0 ; i < arrays.size() ; i++)
	{      
		var dat=array.pop();
			for (var j = 0, element;element = arrays[j++];) {
            if (element.type === "text") {
				try{
				element.value= dat[j];
				}
				catch(e)
				{
				element.value= Math.floor((Math.random() * 10) + 1);
				}
			}
	}
	}
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
			}
        });
		 Read_Inputs();
}