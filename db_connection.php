<?php
$host = 'localhost';
$db = 'employees_db';
$username = 'root';
$password = '';

$conn = mysqli_connect($host, $username, $password, $db);

if (!$conn) {
  die("เกิดข้อผิดพลาดในการเชื่อมต่อกับฐานข้อมูล: " . mysqli_connect_error());
}
?>
