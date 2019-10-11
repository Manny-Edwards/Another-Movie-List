<?php
$servername = "shareddb-p.hosting.stackcp.net";
$dBUsername = "aml_users-313135d7d6";
$dBPassword = "Fvo+_O?Kg('(";
$dBName = "aml_users-313135d7d6";
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
  die("Connection failed: ".mysqli_connect_error());
}
