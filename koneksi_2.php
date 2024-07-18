<?php
$host = "localhost";
$user = "root";
$password = "22220323";
$database = "db_admin";

$con = mysqli_connect($host, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>
