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
		test();
		includes();
        makeform();
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

function includes()
{
	debugger;
	var functions=document.getElementById("includes").childNodes;
	for(var i=0; i <functions.length ; i++)
	{
		var id=functions[i].childNodes[1].textContent.split(":");
		 $.ajax({
            type: "POST",
            url: "./get_func.php",
            data: {id: id[0]},
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
	var pattern = new RegExp("[a-z]+[[0-9]*]", "g");
  
	var code = $("#code").val();
      var prototype = code.substring(0, code.indexOf(")") + 1);
      var arrays = prototype.match(pattern);
	  if(arrays != null)
		  for (var i = 0;i < arrays.length;i++) {
			prototype = prototype.replace(arrays[i], arrays[i].substring(0, arrays[i].indexOf("[")));
		  }
	  code = "function " + prototype + code.substring(code.indexOf(")") + 1, code.lastIndexOf("}") + 1);
	  eval(code);

}



function makeform() {
  $("#code").prop("readonly", true);
  var code = $("#code").val();
  var pattern = new RegExp("[a-z]+[[0-9]*]");
  var parameters = code.substring(code.indexOf("(") + 1, code.indexOf(")")).split(",");
  var function_name = code.substring(0, code.indexOf(")") + 1);
  if (parameters.length == 1 && parameters[0].replace(/^\s+/, "").replace(/\s+$/, "") === "") {
    parameters = new Array;
  }
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
    Read_Inputs(parameters);
  } else {
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.appendChild(document.createTextNode("function " + code));
    $("head").append(script);
    eval('display_output( "' + function_name + '" ,' + function_name + ");");
  }
}


function Read_Inputs(parameters) {
	var in_data='';
  var code = $("#code").val();
  var function_call = code.substring(0, code.indexOf("(") + 1);
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
			in_data += element.value  +" ;";
            function_call += element.value + ",";
          } else {
                alert("Please Provide All Inputs for " + parameters[i]);
                return;
          }
        }
      }
      debugger;
      function_call = function_call.substring(0, function_call.lastIndexOf(",")) + ")";
      var code = $("#code").val();
      var prototype = code.substring(0, code.indexOf(")") + 1);
      var arrays = prototype.match(pattern);
	  if(arrays != null)
		  for (var i = 0;i < arrays.length;i++) {
			prototype = prototype.replace(arrays[i], arrays[i].substring(0, arrays[i].indexOf("[")));
		  }
	  code = "function " + prototype + code.substring(code.indexOf(")") + 1, code.lastIndexOf("}") + 1);
      var script = document.createElement("script");
      script.type = "text/javascript";
      script.appendChild(document.createTextNode(code));
	  expression += 'display_output( "' + prototype + '" ,' + function_call + ");";
	  script.appendChild(document.createTextNode(expression));
      $("head").append(script);
	  debugger;
	   $.ajax({
            type: "POST",
            url: "./store.php",
            data: {input: in_data , code : $("#code").val() , output: eval(function_call+";")},
			success: function(data){  
				//alert("Data added to db");
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
    