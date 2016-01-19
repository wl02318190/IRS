<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<title>註冊畫面-學生端</title>
<script>
function onload(){
	snum = document.getElementById("num");
	sname = document.getElementById("name");
	spwd = document.getElementById("pwd");
	semail = document.getElementById("email");
}
function insert(){
	
	var xmlhttp;
	//這下面的程式碼我其實不知道他幹嘛 那個GET APPLE你自己改一下
	if(window.XMLHttpRequest)
		{
		xmlhttp = new XMLHttpRequest();
		}
	else{
		new ActiveXObject("Microsoft.XMLHTTP");
		}
	
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4&&xmlhttp.status==200)
		{
			//document.getElementById("test").innerHTML=tname.value;
		}
	}
	
	xmlhttp.open("GET","http://120.96.99.42/01360556/newxmlapk/www/Student-register-insert.php?num="+snum.value+"&name="+sname.value+"&pwd="+spwd.value+"&email="+semail.value,true);
	
	xmlhttp.send();
	
	}

</script>
</head>

<body onload="onload();">
<div data-role="page" id="page">
  <div data-role="header">
    <h1>歡迎來到註冊畫面-學生端</h1></div>
  <div data-role="content" data-ajax="false">
    <div data-role="fieldcontain">
      
        <label for="textinput">學生帳號:</label>
        <input type="text" name="num" id="num" value=""  /><br>
        <label for="textinput">學生姓名:</label>
        <input type="text" name="name" id="name" value=""  /><br>
        <label for="textinput">學生密碼:</label>
        <input type="text" name="pwd" id="pwd" value=""  /><br>
        <label for="textinput">學生E-mail:</label>
        <input type="text" name="email" id="email" value=""  /><br>
        <button id="btn" onClick="insert();">註冊</button>
        
      
    </div>
  </div>
  <div data-role="footer">
    <h4><div id="test"></div></h4>
  </div>
</div>
</body>
</html>