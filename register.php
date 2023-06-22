<?php
require_once 'db_connection.php';

if (isset($_POST['register'])) {
  $name = $_POST['name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role = $_POST['role']; // เพิ่มการรับค่า role

  $check_query = "SELECT * FROM users WHERE username = '$username'";
  $check_result = mysqli_query($conn, $check_query);

  if (mysqli_num_rows($check_result) > 0) {
    $error = "ชื่อผู้ใช้นี้มีอยู่ในระบบแล้ว";
  } else {
    $insert_query = "INSERT INTO users (name, username, password, role) VALUES ('$name', '$username', '$password', '$role')";
    $insert_result = mysqli_query($conn, $insert_query);

    if ($insert_result) {
      header("Location: login.php");
      exit();
    } else {
      $error = "เกิดข้อผิดพลาดในการลงทะเบียน";
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>ลงทะเบียน</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<body>
<div class="container">
  <h2>ลงทะเบียน</h2>
  <?php if (isset($error)) { echo $error; } ?>
  <form method="post" action="">
    <label for="name">ชื่อ:</label>
    <input type="text" name="name" id="name" required><br><br>
<label for="username">ชื่อผู้ใช้:</label>
<input type="text" name="username" id="username" required><br><br>

<label for="password">รหัสผ่าน:</label>
<input type="password" name="password" id="password" required><br><br>

<!-- เพิ่มส่วนเลือกสิทธิ์ -->
<label for="role">สิทธิ์:</label>
<select name="role" id="role">
  <option value="admin">Admin</option>
  <option value="user">User</option>
</select><br><br>

<input type="submit" name="register" value="ลงทะเบียน">
  </form><br>
<a href="login.php" class="button">เข้าสู่ระบบ</a>
</div>
</body>
</html>