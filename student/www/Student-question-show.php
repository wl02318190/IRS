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
<title>Untitled Document</title>
</head>

<body>




 <?php do { ?>
 <?php if($row_Recordset1['question_open']==1){ ?>
 <div id="Qid"><?php echo $row_Recordset1['question_id']?></div>
 <div id="Qnum"><?php echo $row_Recordset1['question_number']?></div>
 <div id="Qtitle"><?php echo $row_Recordset1['question_title']?></div>
 <div id="Ans1"><?php echo $row_Recordset1['question_select1']?></div>
 <div id="Ans2"><?php echo $row_Recordset1['question_select2']?></div>
 <div id="Ans3"><?php echo $row_Recordset1['question_select3']?></div>
 <div id="Ans4"><?php echo $row_Recordset1['question_select4']?></div>
 
 <?php }} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
 
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
