<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// ตรวจสอบการส่งค่าข้อมูลแบบ POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // รับข้อมูลที่ผู้ใช้กรอกจากฟอร์ม
  $name = $_POST['name'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $tel = $_POST['tel'];

  // ตรวจสอบว่าข้อมูลไม่ว่างเปล่า
  if ($name && $lastname && $email && $tel) {
    // เพิ่มข้อมูลลงในฐานข้อมูล
    $query = "INSERT INTO employees (name, lastname, email, tel) VALUES ('$name', '$lastname', '$email', '$tel')";
    $result = mysqli_query($conn, $query);

    if ($result) {
      // สำเร็จในการเพิ่มข้อมูล
      echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
    } else {
      // เกิดข้อผิดพลาดในการเพิ่มข้อมูล
      echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . mysqli_error($conn);
    }
  } else {
    // กรอกข้อมูลไม่ครบถ้วน
    echo "กรุณากรอกข้อมูลให้ครบถ้วน";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>เพิ่มข้อมูล</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<body>
<div class="container">
  <h2>เพิ่มข้อมูลใหม่</h2>
  <form method="POST" action="">
    <label for="name">ชื่อ:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="lastname">นามสกุล:</label>
    <input type="text" id="lastname" name="lastname" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="tel">เบอร์โทร:</label>
    <input type="text" id="tel" name="tel" required><br><br>

    <input type="submit" value="เพิ่มข้อมูล">
  </form>
  <br><a href="user.php">กลับหน้าผู้ใช้</a>
</div>
</body>
</html>
