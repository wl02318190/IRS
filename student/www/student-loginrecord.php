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

$colname_Recordset1 = "-1";
if (isset($_GET['student_id'])) {
  $colname_Recordset1 = $_GET['student_id'];
}
mysql_select_db($database_name, $name);
$query_Recordset1 = sprintf("SELECT * FROM stuedntacc WHERE studentacc_stdid = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $name) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_query('set names utf8');


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

  <?php do { ?>
     
      <?php echo "平台:".$row_Recordset1['studentacc_platform']."<br>"; ?>
     <?php echo "UUID:".$row_Recordset1['studentacc_uuid']."<br>"; ?>
  <?php echo "時間:".$row_Recordset1['studentacc_time']."<br>"; ?>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
