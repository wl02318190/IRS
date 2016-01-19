<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script type="text/javascript" charset="utf-8" src="cordova.js"></script>
<script src="css/MyCSS3.css"></script>
<script type="text/javascript" charset="utf-8">
document.addEventListener("deviceready", onDeviceReady, false);
var snum;
var spwd;
var sname;
var dt;
var uuid;
function OnDeviceReady(){
	snum = document.getElementById("num");
	spwd = document.getElementById("pwd");
	sname = document.getElementById("name");
	dt = document.getElementById("Regist_Platform");
	uuid = document.getElementById("Regist_UUID");
	
	if ( window.localStorage.getItem('usernum') )
			snum.value = window.localStorage.getItem('usernum');
	if ( window.localStorage.getItem('username') )
			sname.value = window.localStorage.getItem('username');
	if ( window.localStorage.getItem('userpwd') )
			spwd.value = window.localStorage.getItem('userpwd');
	if ( window.localStorage.getItem('platform') )
			dt.value = window.localStorage.getItem('platform');
	if ( window.localStorage.getItem('uuid') )
			uuid.value = window.localStorage.getItem('uuid');
}

function LoginOnClick(){
	window.localStorage.setItem('usernum', snum.value);
	window.localStorage.setItem('username', sname.value);
	window.localStorage.setItem('userpwd', spwd.value);
	window.localStorage.setItem('platform', dt.value);
	window.localStorage.setItem('uuid', uuid.value);
	
	
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
			document.getElementById("test").innerHTML = xmlhttp.responseText;
			var chk = document.getElementById("recall").innerHTML;
			document.getElementById("test").innerHTML = chk;
			if(chk == 1){
				ChangeUsnmToID(snum.value);
			}
			else{
				alert("登入失敗!請輸入正確資料!");
				//location.href="http://120.96.99.42/01360556/student/www/LoginPage_Student.php?platform="+<?php echo $_GET['platform'] ?>+"&uuid="+<?php echo $_GET['uuid'] ?>;
			}
		}
	}
		
	xmlhttp.open("GET","http://120.96.99.42/01360556/student/www/student-checklogin.php?snum="+snum.value+"&sname="+sname.value+"&spwd="+spwd.value,true);
		
	xmlhttp.send();
	
}

function ChangeUsnmToID(usnm){	//http://120.96.99.42/01360556/student/www/student-change.php?student_num=wl01360556
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
			document.getElementById("test").innerHTML = xmlhttp.responseText;
			var sID = document.getElementById("recallID").innerHTML;
			LoginRecord(sID);
			location.href = "http://120.96.99.42/01360556/student/www/ClassList_Student.php?student_id="+sID ;
		}
	}
		
	xmlhttp.open("GET","http://120.96.99.42/01360556/student/www/student-change.php?student_num="+usnm,true);
		
	xmlhttp.send();
}
function LoginRecord(id){
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
			
		}
	}
		
	xmlhttp.open("GET","http://120.96.99.42/01360556/student/www/student-loginrecord-insert.php?student_id="+id+"&platform="+dt.value+"&uuid="+uuid.value,true);
		
	xmlhttp.send();
}
</script>
</head>

<body onLoad="OnDeviceReady();">

<div data-role="page" id="Login_Student">
  <div data-role="header" data-theme="b" data-position="fixed">
    <h1>IRS學生端系統登入</h1>
  </div>
  <div data-role="content">
  <button id="RegistButton" onClick="location.href='http://120.96.99.42/01360556/student/www/Regist_Page.php?uuid=<?php echo $_GET['uuid']?>&platform=<?php echo $_GET['platform']?>'" class="ui-shadow-icon ui-btn ui-shadow ui-corner-all ui-btn-b ui-btn-icon-left">新同學按此註冊</button>
  
    <div data-role="fieldcontain">
      <label for="textinput1">帳號輸入</label>
      <input type="text" name="textinput1" id="num" value="" placeholder="請輸入您的帳號" required/>
      
      <label for="textinput2">姓名輸入</label>
      <input type="text" name="textinput2" id="name" value="" placeholder="請輸入您的姓名" required/>
      
      <label for="passwordinput">密碼輸入</label>
      <input type="password" name="passwordinput" id="pwd" value="" placeholder="請輸入您的密碼" required/>
      
      <label for="textinput4">使用裝置</label>
      <input type="text" name="textinput4" id="Regist_Platform" value="<?php echo $_GET['platform']?>" readonly/>
      
      <label for="textinput5">ＵＵＩＤ</label>
      <input type="text" name="textinput5" id="Regist_UUID" value="<?php echo $_GET['uuid']?>" readonly/>
      <div>
      <button id="LoginButton" onClick="LoginOnClick();" class="ui-shadow-icon ui-btn ui-shadow ui-corner-all ui-btn-b ui-btn-icon-left">學生登入</button>
      </div>
    </div>
    
  
  </div>
  <div data-role="footer" id="apple" data-theme="b" data-position="fixed">
    <h4><div id="test" style="display:none;"></div></h4>
  </div>
</div>
</body>
</html>
