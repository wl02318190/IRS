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

function right(){
	$updateSQL = sprintf("UPDATE studentans SET studentans_ROW=%s WHERE studentans_qid=%s",
                       1,
                    $_GET['qid']);

  mysql_select_db($database_name, $name);
  $Result1 = mysql_query($updateSQL, $name) or die(mysql_error());
	}

$colname_Recordset1 = "-1";
if (isset($_GET['qid'])) {
  $colname_Recordset1 = $_GET['qid'];
}
mysql_select_db($database_name, $name);
$query_Recordset1 = sprintf("SELECT * FROM studentans WHERE studentans_qid = %s", GetSQLValueString($colname_Recordset1, "int"));
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
<?php do {?>

<?php 
if($row_Recordset1['studentans_ans']==$row_Recordset2['question_answer']){
$updateSQL = sprintf("UPDATE studentans SET studentans_ROW=%s WHERE studentans_qid=%s AND studentans_id=%s",
                       1,
                    $_GET['qid'],
					$row_Recordset1['studentans_id']);

  mysql_select_db($database_name, $name);
  $Result1 = mysql_query($updateSQL, $name) or die(mysql_error());}

  else{
$updateSQL = sprintf("UPDATE studentans SET studentans_ROW=%s WHERE studentans_qid=%s AND studentans_id=%s",
                       0,
                    $_GET['qid'],
					$row_Recordset1['studentans_id']);

  mysql_select_db($database_name, $name);
  $Result1 = mysql_query($updateSQL, $name) or die(mysql_error());}
 
  ?>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
