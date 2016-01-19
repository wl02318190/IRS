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
$query_Recordset1 = "SELECT * FROM teachmv";
$Recordset1 = mysql_query($query_Recordset1, $name) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
<div data-role="page" id="ClassPage">
  <div data-role="header" data-theme="b">
    <h1>課程選單</h1>
  </div>
  <div data-role="content">
  <div data-theme="b">
  </div>
  <div data-role="collapsible-set">
	 <?php do { ?>
     <?php  if($row_Recordset1['teachMV_course']==$_GET['question_course']&&$row_Recordset1['teachMV_section']==$_GET['section'])
	 echo $row_Recordset1['teachMV_url']?>
     <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>          
    </div>
  </div>
</div>
  </div>
  
  </div>
<div data-role="footer" data-theme="b" data-position="fixed">
  </div>
</div>
</html>
<?php
mysql_free_result($Recordset1);
?>
