<?php require_once('../../../Connections/name.php'); ?>
<?php
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}




mysql_select_db($database_name, $name);
$query_Recordset1 = "SELECT * FROM studentans";
$Recordset1 = mysql_query($query_Recordset1, $name) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['qid'])) {
  $colname_Recordset2 = $_GET['qid'];
}
mysql_select_db($database_name, $name);
$query_Recordset2 = sprintf("SELECT * FROM question WHERE question_id = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $name) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php   
if($_GET['ans']==$row_Recordset2['question_answer']){
$updateSQL = sprintf("UPDATE studentans SET studentans_stdname=%s, studentans_qid=%s, studentans_ans=%s,studentans_ROW=%s WHERE studentans_stdname=%s AND studentans_qid=%s",
                       GetSQLValueString($_GET['student_id'], "int"),
                       GetSQLValueString($_GET['qid'], "int"),
                       GetSQLValueString($_GET['ans'], "int"),
					   1,
                       GetSQLValueString($_GET['student_id'], "int"),
                       GetSQLValueString($_GET['qid'], "int"));

  mysql_select_db($database_name, $name);
  $Result1 = mysql_query($updateSQL, $name) or die(mysql_error());
}
else {
	$updateSQL = sprintf("UPDATE studentans SET studentans_stdname=%s, studentans_qid=%s, studentans_ans=%s,studentans_ROW=%s WHERE studentans_stdname=%s AND studentans_qid=%s",
                       GetSQLValueString($_GET['student_id'], "int"),
                       GetSQLValueString($_GET['qid'], "int"),
                       GetSQLValueString($_GET['ans'], "int"),
					   0,
                       GetSQLValueString($_GET['student_id'], "int"),
                       GetSQLValueString($_GET['qid'], "int"));

  mysql_select_db($database_name, $name);
  $Result1 = mysql_query($updateSQL, $name) or die(mysql_error());
	}
?>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
