<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>學生註冊</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script type="text/javascript" charset="utf-8" src="cordova.js"></script>
<style>
.Alert{
	color:#F00;
	visibility:visible;
}
.Ready{
	display:none;
}
</style>
<script type="text/javascript" charset="utf-8">
document.addEventListener("deviceready", onDeviceReady, false);
var snum;
var sname;
var spwd;
var semail;
var usnmlock;
var emaillock;
function OnDeviceReady(){
	var uuid = document.getElementById("Regist_UUID");
	var platform = document.getElementById("Regist_Platform");
	platform = device.platform;
	uuid = device.uuid;
}

function onload(){
	usnmlock = 1;
	emaillock = 1;
}

function insert(){
	var ElementLock = usnmlock+emaillock;
	if(ElementLock==0){
		snum = document.getElementById("num");
		sname = document.getElementById("name");
		spwd = document.getElementById("pwd");
		semail = document.getElementById("email");	
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
				alert("註冊成功!");
				location.href = "http://120.96.99.42/01360556/student/www/LoginPage_Student.php?uuid=<?php echo $_GET['uuid']?>&platform=<?php echo $_GET['platform']?>";
				//document.getElementById("test").innerHTML=sname.value;
			}
		}
		
		xmlhttp.open("GET","http://120.96.99.42/01360556/student/www/Student-register-insert.php?num="+snum.value+"&name="+sname.value+"&pwd="+spwd.value+"&email="+semail.value,true);
		
		xmlhttp.send();
	}
	else{
		alert("請將資料依照規定填妥!");
		if(usnmlock==1){
			alert("輸入之帳號不符合規定!");
		}
		if(emaillock==1){
			alert("輸入之信箱不符合規定!");
		}
	}
}

function UsernameCheck(){
	snum = document.getElementById("num");
	if(snum.value.length>5){
		document.getElementById("usnmchk").className = "Ready";
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
				document.getElementById("getRes").innerHTML = xmlhttp.responseText;
				var chk = document.getElementById("recall").innerHTML;
				if(chk == 0){
					usnmlock = 0;
					document.getElementById("usnmchk").className = "Ready";
				}
				else{
					document.getElementById("usnmchk").innerHTML = "帳號已遭註冊!";
					document.getElementById("usnmchk").className = "Alert";
					usnmlock = 1;
				}
				
			}
		}
		
		xmlhttp.open("GET","http://120.96.99.42/01360556/student/www/Student-register-numcheck.php?num="+snum.value,true);
		
		xmlhttp.send();
	}
	else{
		usnmlock = 1;
		document.getElementById("usnmchk").innerHTML = "帳號未達6碼!";
		document.getElementById("usnmchk").className = "Alert";
	}
}

function EmailCheck(){
	semail = document.getElementById("email").value;
	var xmlhttp;
	//這下面的程式碼我其實不知道他幹嘛 那個GET APPLE你自己改一下
	if(window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}
	else{
		new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4&&xmlhttp.status==200)
		{
			document.getElementById("getRes").innerHTML = xmlhttp.responseText;
			var chk = document.getElementById("recall").innerHTML;
			if(chk == 0){
				emaillock = 0;
				document.getElementById("emailchk").className = "Ready";
			}
			else{
				document.getElementById("emailchk").className = "Alert";
				emaillock = 1;
			}
			
		}
	}
	
	xmlhttp.open("GET","http://120.96.99.42/01360556/student/www/Student-register-emailcheck.php?email="+semail,true);
	
	xmlhttp.send();
}

function PasswordCheck(){
	spwd = document.getElementById("pwd").value;
	var pwdchk = document.getElementById("pwdchk");
	if(spwd.length<6){
		pwdchk.className = "Alert" ;
	}
	else{
		pwdchk.className = "Ready" ;
	}
}
</script>
</head>

<body onLoad="onload();">

<div data-role="page" id="RegistPage">
  <div data-role="header" data-theme="b" data-position="fixed">
    <h1>學生帳號註冊</h1>
  </div>
  <div data-role="content">
  
    <div data-role="fieldcontain">
      <div>
      <label for="textinput1">帳號輸入</label>
      <input name="textinput1" type="text" required id="num" placeholder="請輸入英文數字6~12碼" onBlur="UsernameCheck();" maxlength="12"/>
      <div id="usnmchk" class="Ready">帳號已遭註冊!!</div>
      </div>
      
      
     
      <div>
      <label for="passwordinput">密碼輸入</label>
      <input name="passwordinput" type="password" required id="pwd" placeholder="請輸入英文數字6~12碼" onBlur="PasswordCheck();" maxlength="12"/>
      <div id="pwdchk" class="Ready">密碼未達六碼!</div>
      </div>  
     
      <div>
      <label for="textinput3">信箱輸入</label>
      <input type="text" name="textinput3" id="email" value="" placeholder="請依照格式輸入信箱" onBlur="EmailCheck();" required/>
      <div id="emailchk" class="Ready">信箱已遭註冊!!</div>
      </div>
      
      <div>
      <label for="textinput2">姓名輸入</label>
      <input name="textinput2" type="text" required id="name" placeholder="請輸入中英文至多8碼" value="" maxlength="8"/>
      </div>
      
      <!--使用不到的兩個輸入框
      <div>
      <label for="textinput4">使用裝置</label>
      <input type="text" name="textinput4" id="Regist_Platform" value="" readonly/>
      </div>
      
      <div>
      <label for="textinput5">ＵＵＩＤ</label>
      <input type="text" name="textinput5" id="Regist_UUID" value="" readonly/>
      </div>
      -->
    </div>
  
  	<button id="Regist_Button" onClick="insert();" class="ui-shadow-icon ui-btn ui-shadow ui-corner-all ui-btn-b ui-btn-icon-left">帳號註冊</button>
    <button id="test_Button" onClick="UsernameCheck();" style="display:none;">測試按鈕</button>

  </div>
  <div data-role="footer" data-theme="b" data-position="fixed">
    <h4><div id="test" style="display:none;"></div></h4>
    <div id="getRes" hidden="collapse">123123</div>
  </div>
</div>
</body>
</html>
