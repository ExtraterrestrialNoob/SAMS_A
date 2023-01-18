<?php
$hostName = "sql313.epizy.com";
$userName = "epiz_33398696";
$password = "ZtZOMClbZhS7cpZ";
$databaseName = "epiz_33398696_sameera";
 $conn = new mysqli($hostName, $userName, $password, $databaseName);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>