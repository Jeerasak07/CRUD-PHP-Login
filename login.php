<?php
session_start();
require_once 'db_connection.php';

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($conn, $sql);

  if ($result->num_rows > 0) {
    // เก็บข้อมูลผู้ใช้ใน session
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['role'];

    // ตรวจสอบบทบาทของผู้ใช้
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: user.php");
    }
} else {
    $error = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
}
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>เข้าสู่ระบบ</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<body>
<div class="container">
  <h2>เข้าสู่ระบบ</h2>
  <?php if (isset($error)) { echo $error; } ?>
  <form method="post" action="">
    <label for="username">ชื่อผู้ใช้:</label>
    <input type="text" name="username" id="username" required><br><br>

    <label for="password">รหัสผ่าน:</label>
    <input type="password" name="password" id="password" required><br><br>

    <input type="submit" name="login" value="เข้าสู่ระบบ">
  </form>
  <br><a href="register.php" class="button">สมัครสมาชิก</a>
</div>
</body><br>

</html>
