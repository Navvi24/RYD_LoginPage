<?php
/*
$username="root"; //DB User Name
$password=""; //DB User password
$database="adhoc_management"; //Enter database name here
$servername="localhost"; //Server address
*/

$username="root"; //DB User Name
$password=""; //DB User password
$database="ryd"; //Enter database name here
$servername="localhost"; //Server address

// Create connection
$con = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (mysqli_connect_errno()) {
   die("Connection failed: " . mysqli_connect_error());
}

?>
