<?php
//include_once 'db.php';

$serverName = "iac353.encs.concordia.ca";
$dbUser = "iac353_4";
$dbPass = "aabx1191";
$dbName = "iac353_4";
$port = "3306";

//attempting to use prepared statement with OOP
//$db = new db($serverName,$dbUser,$dbPass,$dbName);


$conn = mysqli_connect($serverName,$dbUser,$dbPass,$dbName);

if(!$conn){
   die("Connection failed: ". mysqli_connect_error($conn));
}
