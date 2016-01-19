<?php require_once('../../../Connections/name.php'); ?>
<?php
mysql_query('set names utf8');
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_Recordset1 = "-1";
if (isset($_GET['question_course'])) {
  $colname_Recordset1 = $_GET['question_course'];
}
mysql_select_db($database_name, $name);
$query_Recordset1 = sprintf("SELECT * FROM question WHERE question_course = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $name) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<style>
.Ready{
	display:none;
}
.Show{
	visibility:visible;
}
</style>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script type="text/javascript">
var StdsAns="";
function BtnAnsClick(ThisBtn){
	var QuesNum = document.getElementById("QnumDiv").innerHTML;
	var ThisDivId = "Answer";
	var ShowDivId = "Set";
	var ShowStdAnsId = "UsersAnswer";
	//回答用的變數帶入
	var QuesID = document.getElementById("QuesID").innerHTML;
	var StdID = document.getElementById("StdID").innerHTML;
	var AnsValue = ThisBtn.value;
	StdsAns = ThisBtn.innerHTML;
	document.getElementById(ThisDivId).className = "Ready";
	document.getElementById(ShowDivId).className = "Show" ;
	document.getElementById(ShowStdAnsId).innerHTML = StdsAns;
	var test = document.getElementById("test1");
	test.innerHTML = "123";
	//http://120.96.99.42/01360556/student/www/Student-question-answercheck.php?student_id=1&qid=3
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
			//判對是否有回答過了
			document.getElementById("ForCheck").innerHTML = xmlhttp.responseText;
			var ck = document.getElementById("AnsCK").innerHTML;
			document.getElementById("test1").innerHTML = ck;
			if(ck==0){
				AnsInsert(StdID,QuesID,AnsValue);
			}
			else{
				ReAnsUpdate(StdID,QuesID,AnsValue);
			}
		}
	}
		
	xmlhttp.open("GET","http://120.96.99.42/01360556/student/www/Student-question-answercheck.php?student_id="+StdID+"&qid="+QuesID,true);
		
	xmlhttp.send();	
	
}
function BtnReAns(ThisBtn){
	var QuesNum = document.getElementById("QnumDiv").innerHTML;
	var ThisDivId = "Set";
	var ShowDivId = "Answer";
	var ShowStdAnsId = "UsersAnswer";
	document.getElementById(ThisDivId).className = "Ready";
	document.getElementById(ShowDivId).className = "Show" ;
	
	
}

function AnsInsert(StdID,QuesID,AnsValue){
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
		
	xmlhttp.open("GET","http://120.96.99.42/01360556/student/www/Student-question-answer.php?student_id="+StdID+"&qid="+QuesID+"&ans="+AnsValue,true);
		
	xmlhttp.send();	
}

function ReAnsUpdate(StdID,QuesID,AnsValue){
	
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
		
	xmlhttp.open("GET","http://120.96.99.42/01360556/student/www/Student-question-upanswer.php?student_id="+StdID+"&qid="+QuesID+"&ans="+AnsValue,true);
		
	xmlhttp.send();	
}

function BodyOnLoad(){
	ForInterval();
	setInterval(ForInterval,1000);
}
//http://120.96.99.42/01360556/student/www/Student-question-showanswer-check.php?qid=2

function CheckShowAns(){
	var Qid = document.getElementById("QuesID").innerHTML;
	if(Qid!=""){
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
				document.getElementById("ForRespones").innerHTML = xmlhttp.responseText;
				var ck = document.getElementById("AnsShowChk").innerHTML;
				
				if(ck==1){
					document.getElementById("ShowQues").className = "Show ui-collapsible-set ui-group-theme-inherit ui-corner-all";
					document.getElementById("ShowAns").className = "Show";					
					document.getElementById("Answer").className = "Ready";
					document.getElementById("Set").clasName = "Ready";
					if(StdsAns!=""){
						document.getElementById("UsersLastAnswer").innerHTML = StdsAns;
					}
					else{
						document.getElementById("UsersLastAnswer").innerHTML = "無";
					}
					RightAnsShow();
				}
				else{
					document.getElementById("ShowQues").className = "Show";
					AjaxQuestion();
				}
			}
		}
			
		xmlhttp.open("GET","http://120.96.99.42/01360556/student/www/Student-question-showanswer-check.php?qid="+Qid,true);
			
		xmlhttp.send();
	}
	else{
		AjaxQuestion();
	}
}

function RightAnsShow(){
	//http://120.96.99.42/01360556/newxmlapk/www/Question-Showanswer.php?qid=2
	var Qid = document.getElementById("QuesID").innerHTML;
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
			document.getElementById("ForRespones").innerHTML = xmlhttp.responseText;
			document.getElementById("RightAns").innerHTML = document.getElementById("RecallRAns").innerHTML;
			document.getElementById("Set").className="Ready";
		}
	}
		
	xmlhttp.open("GET","http://120.96.99.42/01360556/newxmlapk/www/Question-Showanswer.php?qid="+Qid,true);
		
	xmlhttp.send();	
}
function ForInterval(){
	var CourseID = document.getElementById("CourseID").innerHTML;
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
			document.getElementById("ForRespones").innerHTML = xmlhttp.responseText;
			var ck = document.getElementById("OpenCk").innerHTML;
			if(ck==0){
				document.getElementById("ShowQues").className = "Ready";
				document.getElementById("ShowAns").className = "Ready";
			}
			else{
				CheckShowAns();
				
			}
		}
	}
		
	xmlhttp.open("GET","http://120.96.99.42/01360556/student/www/Student-question-opencheck.php?question_course="+CourseID,true);
		
	xmlhttp.send();	
}

function AjaxQuestion(){
	if(document.getElementById("Set").className!="Show"){
		document.getElementById("Answer").className = "Show";
	}
	var ContentID = document.getElementById("contentID");
	var CourseID = document.getElementById("CourseID").innerHTML;
	//http://120.96.99.42/01360556/student/www/Student-question-show.php?question_course=1
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
			document.getElementById("ForRespones").innerHTML = xmlhttp.responseText;
			var QuesID = document.getElementById("QuesID");
			var Title = document.getElementById("QuesTitle");
			var Qtitle = document.getElementById("Qtitle").innerHTML;
			var QtitleStr = document.getElementById("QtitleStr");
			var ans01inn = document.getElementById("ans01");
			var ans02inn = document.getElementById("ans02");
			var ans03inn = document.getElementById("ans03");
			var ans04inn = document.getElementById("ans04");
			var reans = document.getElementById("reansBtn");
			var QnumDiv = document.getElementById("QnumDiv");
			
			var Qid = document.getElementById("Qid").innerHTML;
			var Qnum = document.getElementById("Qnum").innerHTML;
			var ans1 = document.getElementById("Ans1").innerHTML;
			var ans2 = document.getElementById("Ans2").innerHTML;
			var ans3 = document.getElementById("Ans3").innerHTML;
			var ans4 = document.getElementById("Ans4").innerHTML;
			//題目內容部分
			Title.innerHTML = "<a href=\"#\" class=\"ui-collapsible-heading-toggle ui-btn ui-icon-plus ui-btn-icon-left ui-btn-b\" >第"+Qnum+"題<span class=\"ui-collapsible-heading-status\"> click to expand contents</span></a>";
			QtitleStr.innerHTML = Qtitle;
			//Title.innerHTML = "<a href=\"#\" class=\"ui-collapsible-heading-toggle ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inherit\" data-theme=\"b\">"+Qnum+"."+Qtitle+"<span class=\"ui-collapsible-heading-status\"> click to expand contents</span></a>";
			//<h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed"><a href="#" class="ui-collapsible-heading-toggle ui-btn ui-icon-plus ui-btn-icon-left ui-btn-b">計算機結構<span class="ui-collapsible-heading-status"> click to expand contents</span></a></h3>
			//題號儲存
			QnumDiv.innerHTML = Qnum;
			//題目流水號
			QuesID.innerHTML = Qid;
			//選項部分
			ans01inn.innerHTML = "選項A "+ans1;
			ans02inn.innerHTML = "選項B "+ans2;
			ans03inn.innerHTML = "選項C "+ans3;
			ans04inn.innerHTML = "選項D "+ans4;
			//重新作答按鈕
			reans.value = Qnum;
		}
	}
		
	xmlhttp.open("GET","http://120.96.99.42/01360556/student/www/Student-question-show.php?question_course="+CourseID,true);
		
	xmlhttp.send();
}

</script>
</head>

<body onLoad="BodyOnLoad();">
<div data-role="page" id="QuestionPage">
  <div data-role="header" data-position="fixed" data-theme="b">
    <h1>課程回答</h1>
  </div>
  <div data-role="content" id="contentID">
  	<button id="test1" style="display:none;"></button>
  	<div id="CourseID" style="display:none;"><?php echo $_GET['question_course']?></div>
    <div id="ForCheck" style="display:none;">
    </div>
  	<div id="ForRespones" style="display:none;" data-theme="b">
    </div>
    
  	<div data-role="collapsible-set" id="ShowQues" class="Ready">
    	<div data-role="collapsible" data-collapsed="true" id="ForReload" data-theme="b">
        	<h3 id="QuesTitle" data-theme="b" style="word-break:break-all; overflow:auto;">	
            </h3>
            
            <div  data-theme="a">
            
            	<div id="QuesID" style="display:none;"></div>
            	<div id="QnumDiv" style="display:none;"></div>
                <div id="QtitleStr" style="word-break:break-all; overflow:auto;"></div>
            	<div data-role="controlgroup" id="Answer" class="Show" data-type="vertical">
                <button id="ans01" onClick="BtnAnsClick(this);" value="1" class="ui-shadow-icon ui-btn ui-shadow ui-corner-all ui-btn-b ui-btn-icon-left"></button>
                <button id="ans02" onClick="BtnAnsClick(this);" value="2" class="ui-shadow-icon ui-btn ui-shadow ui-corner-all ui-btn-b ui-btn-icon-left"></button>
                <button id="ans03" onClick="BtnAnsClick(this);" value="4" class="ui-shadow-icon ui-btn ui-shadow ui-corner-all ui-btn-b ui-btn-icon-left"></button>
                <button id="ans04" onClick="BtnAnsClick(this);" value="8" class="ui-shadow-icon ui-btn ui-shadow ui-corner-all ui-btn-b ui-btn-icon-left"></button>
                </div>
                
                <div id="Set" class="Ready" style="text-align:center;">
                	您選擇的答案是:
                	<div id="UsersAnswer" style="font-weight:bold;">
                    	
                    </div>
                	<button id="reansBtn" onClick="BtnReAns(this);" value="" class="ui-shadow-icon ui-btn ui-shadow ui-corner-all ui-btn-b ui-btn-icon-left">重新作答</button>
                </div>
                
                <div id="ShowAns" class="Ready" style="text-align:center;"><br>

                	您選擇的答案是:
                	<div id="UsersLastAnswer" style="font-weight:bold;">
                    	
                    </div>
                    題目的正確答案:
                    <div id="RightAns" style="font-weight:bold;">
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    
  	<button onClick="AjaxQuestion();" style="display:none;">測試按鈕</button>
    <div id="StdID" style="display:none;"><?php echo $_GET['student_id'] ?></div>
   
  </div>
  <div data-role="footer" data-position="fixed" data-theme="b">
  	<h4>請盡速作答，以免關閉題目前未能回答。</h4>
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
