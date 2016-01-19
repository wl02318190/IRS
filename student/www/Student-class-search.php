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

mysql_select_db($database_name, $name);
$query_Recordset1 = "SELECT * FROM course";
$Recordset1 = mysql_query($query_Recordset1, $name) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_name, $name);
$query_Recordset2 = "SELECT * FROM teacher";
$Recordset2 = mysql_query($query_Recordset2, $name) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_name, $name);
$query_Recordset3 = "SELECT teacher.teacher_name, course.course_name, course.course_num FROM teacher, course WHERE teacher.teacher_id=course.course_teacher";
$Recordset3 = mysql_query($query_Recordset3, $name) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>



  <?php do { ?>
		<?php if($row_Recordset3['course_num']==$_GET['num']){ ?>
        
        <div id="recall">
          科目代碼: <?php echo $row_Recordset3['course_num']?>

          科目名稱: <?php echo $row_Recordset3['course_name']?>

          教授名稱: <?php echo $row_Recordset3['teacher_name'] ?>
          
          是否新增此課程?
        </div>
        <?php } ?>
  <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>


</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
