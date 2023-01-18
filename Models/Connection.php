<?php
// $hostName = "sql313.epizy.com";
// $userName = "epiz_33398696";
// $password = "ZtZOMClbZhS7cpZ";
// $databaseName = "epiz_33398696_sameera";


$hostName = "localhost";
$userName = "root";
$password = "";
$databaseName = "s2";

 $conn = new mysqli($hostName, $userName, $password, $databaseName);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
  echo "Success";
}
?>