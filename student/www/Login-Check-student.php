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

mysql_select_db($database_name, $name);
$query_Recordset1 = "SELECT * FROM student";
$Recordset1 = mysql_query($query_Recordset1, $name) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php $check=0;?>
<?php do { ?>
<?php if($_GET['usnm']==$row_Recordset1['student_num']&&$_GET['pswd']==$row_Recordset1['student_pwd']&&$_GET['name']==$row_Recordset1['student_name']) $check+=1;?>
<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
<?php echo "<div id=\"usck\">".$check."</div>" ?>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
