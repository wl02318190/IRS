<!doctype html>
<html>
<head>
<meta charset="utf-8">

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<style>
.Ready{
	display:none;
}
.Show{
	visibility:visible;
}
</style>
<title>無標題文件</title>
<script>
var InsertLock = 0;
function InsertOrNot(){
	var ClassID = document.getElementById("ClassIDInput");//http://120.96.99.42/01360556/student/www/Student-class-insertcheck.php?student_id=1&num=PB3HS5NLWK
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
			document.getElementById("irecall").innerHTML=xmlhttp.responseText;
			var ck = document.getElementById("iornot").innerHTML;
			if(ck==0){
				SearchClass();
			}
			else{
				alert("您已經新增此課程!");
			}
			
		}
	}
	
	xmlhttp.open("GET","http://120.96.99.42/01360556/student/www/Student-class-insertcheck.php?student_id=<?php echo $_GET['student_id'] ?>&num="+ClassID.value,true);
	
	xmlhttp.send();
}
function SearchClass(){
	if(document.getElementById("ClassIDInput")!=""){
		var ClassID = document.getElementById("ClassIDInput");
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
				document.getElementById("recallText").innerHTML=xmlhttp.responseText;
				document.getElementById("ResponsText").innerHTML =document.getElementById("recall").innerHTML;
				var ClassINF = document.getElementById("recall").innerHTML;
				document.getElementById("recallText").innerHTML ="";
				if(document.getElementById("ResponsText").innerHTML==""){
					document.getElementById("ResponsText").innerHTML = "查無此課程代碼對應之課程!";
				}
				else{
					InsertLock = 1;
					if(confirm(ClassINF)){
						InsertClass(ClassID.value);
					}
					else{						
					}
					
				}
				
			}
		}
		
		xmlhttp.open("GET","http://120.96.99.42/01360556/student/www/Student-class-search.php?num="+ClassID.value,true);
		
		xmlhttp.send();
	}
	else{
		alert("請輸入課程代碼");
	}
}

function InsertClass(ClassID){
	var ClassIDforInsert = document.getElementById("ClassIDforInsert");
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
			document.getElementById("recallText").innerHTML=xmlhttp.responseText;
			alert("新增課程成功!");
			location.href = "http://120.96.99.42/01360556/student/www/ClassList_Student.php?student_id="+<?php echo $_GET['student_id'] ?>;
		}
	}
	
	xmlhttp.open("GET","http://120.96.99.42/01360556/student/www/Student-class-insert.php?student_id="+<?php echo $_GET['student_id'] ?>+"&course_num="+ClassID,true);
	
	xmlhttp.send();
}
</script>
</head>

<body>

<div data-role="page" id="SearchClassPage_Student">
  <div data-role="header" data-theme="b">
    <h1>課程搜尋</h1>
  </div>
  
  <div data-role="content">  	
    <div data-role="fieldcontain">
      <label for="textinput" style="text-align:center;">以課程代碼搜尋</label><br>
      <input type="text" id="ClassIDInput" name="ClassIDInput" placeholder="請輸入課程代碼" value="" required/><br>
      
      <button onClick="InsertOrNot();" class="ui-shadow-icon ui-btn ui-shadow ui-corner-all ui-btn-b ui-btn-icon-left">搜尋課程</button>
      <!--<button id="InsertButton" onClick="InsertClass();">加入課程</button>-->
     

    <!--<button id="InsertButton" onClick="InsertClass();"  class="ui-shadow-icon ui-btn ui-shadow ui-corner-all ui-btn-b ui-btn-icon-left">加入課程</button>-->
    <div id="irecall" style="display:none;"></div>
    <div id="ResponsText" style="text-align:center; display:none;">
    </div>
    
    <div id="recallText" style="display:none;"></div>
    
    </div>
  </div>
  
  <div data-role="footer" data-theme="b" data-position="fixed">
    <h4></h4>
    
  </div>
</div>
</body>
</html>
