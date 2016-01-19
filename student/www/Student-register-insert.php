<?php require_once('../../../Connections/name.php');
mysql_query('set names utf8');?>
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
$query_Recordset1 = "SELECT * FROM student";
$Recordset1 = mysql_query($query_Recordset1, $name) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$totalRows_number= 0;
do { if(isset($row_Recordset1['teacher_id'])==true)
						{$totalRows_number+=1;};
 } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));

  $insertSQL = sprintf("INSERT INTO student ( student_num, student_name, student_pwd, student_email) VALUES ( %s, %s, %s, %s)",
                       
                       GetSQLValueString($_GET['num'], "text"),
                       GetSQLValueString($_GET['name'], "text"),
                       GetSQLValueString($_GET['pwd'], "text"),
                       GetSQLValueString($_GET['email'], "text"));

  mysql_select_db($database_name, $name);
  $Result1 = mysql_query($insertSQL, $name) or die(mysql_error());



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
