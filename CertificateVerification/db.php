<?php
$servername = "127.0.0.1:4001";
$username = "root";
$password = "";
$dbname = "etms_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>