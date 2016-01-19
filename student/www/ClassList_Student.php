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

$studentid_Recordset1 = "-1";
if (isset($_GET['student_id'])) {
  $studentid_Recordset1 = $_GET['student_id'];
}
mysql_select_db($database_name, $name);
$query_Recordset1 = sprintf("SELECT studentclass.studentclass_classnum, course.course_name, teacher.teacher_name, course.course_id,studentclass.studentclass_delete, studentclass.studentclass_id FROM studentclass, course, teacher WHERE studentclass.studentclass_sid= %s AND studentclass.studentclass_classnum=course.course_num AND course.course_teacher=teacher.teacher_id", GetSQLValueString($studentid_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $name) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['student_id'])) {
  $colname_Recordset2 = $_GET['student_id'];
}
mysql_select_db($database_name, $name);
$query_Recordset2 = sprintf("SELECT student_id, student_name FROM student WHERE student_id = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $name) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>課程選單</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script>
</script>
</head>

<body>

<div data-role="page" id="ClassPage">
  <div data-role="header" data-theme="b">
    <h1>課程選單</h1>
  </div>
  <div data-role="content">
  <div data-theme="b">
  	<button id="InsertClass" onClick="location.href='http://120.96.99.42/01360556/student/www/SearchClassPage_Student.php?student_id=<?php echo $_GET['student_id']; ?>'" class="ui-shadow-icon ui-btn ui-shadow ui-corner-all ui-btn-b ui-btn-icon-left">新增課程</button>
  </div>
  <div data-role="collapsible-set">
	  <?php do { if($row_Recordset1['studentclass_delete']==1){?>
      <div data-role="collapsible" data-collapsed="true" data-theme="b">
      	<h3><?php echo $row_Recordset1['course_name']?></h3>
        <div data-theme="a">
			<?php echo "課程編碼: ".$row_Recordset1['studentclass_classnum']."<br>授課老師: ".$row_Recordset1['teacher_name']."<br>"?>
            <div data-role="controlgroup" data-type="horizontal" data-theme="b">
            	<input type="button" name="button" onClick="location.href='http://120.96.99.42/01360556/student/www/QuestionPage_Student.php?student_id=<?php echo $_GET['student_id']?>&question_course=<?php echo $row_Recordset1['course_id']?>'" value="進入答題" class="ButtonType">
                
                <input type="button" name="button" onClick="location.href='http://120.96.99.42/01360556/student/www/teachMV-section.php?student_id=<?php echo $_GET['student_id']?>&question_course=<?php echo $row_Recordset1['course_id']?>'" value="教學影片" class="ButtonType">
                
                <input type="button" name="button" onClick="location.href='http://120.96.99.42/01360556/student/www/Student-class-delete.php?studentclass_id=<?php echo $row_Recordset1['studentclass_id']?>&student_id=<?php echo $_GET['student_id']?>'" value="刪除課程" class="ButtonType">
            </div>
        </div>
      </div>
      <?php }} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </div>
  
  </div>
  <div data-role="footer" data-theme="b" data-position="fixed">
    <h4><?php echo $row_Recordset2['student_name']?> 同學，您好。</h4>
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
