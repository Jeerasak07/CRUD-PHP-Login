<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM employees WHERE id = $id";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  if (!$row) {
    header("Location: admin.php");
    exit();
  }
} else {
  header("Location: admin.php");
  exit();
}

if (isset($_POST['update'])) {
  $name = $_POST['name'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $tel = $_POST['tel'];

  $update_query = "UPDATE employees SET name = '$name', lastname = '$lastname', email = '$email', tel = '$tel' WHERE id = $id";
  mysqli_query($conn, $update_query);

  if ($_SESSION['role'] == 'admin') {
    // เปลี่ยนเส้นทางการเปลี่ยนที่อยู่ให้เป็นหน้า admin.php สำหรับ admin
    header("Location: admin.php");
  } else {
    // เปลี่ยนเส้นทางการเปลี่ยนที่อยู่ให้เป็นหน้า user.php สำหรับ user
    header("Location: user.php");
  }
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>แก้ไขพนักงาน</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<body>
<div class="container">
  <h2>แก้ไขพนักงาน</h2>
  <form method="post" action="">
    <label for="name">ชื่อ:</label>
    <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>" required><br><br>

    <label for="lastname">นามสกุล:</label>
    <input type="text" name="lastname" id="lastname" value="<?php echo $row['lastname']; ?>" required><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo $row['email']; ?>" required><br><br>

    <label for="tel">เบอร์โทร:</label>
    <input type="tel" name="tel" id="tel" value="<?php echo $row['tel']; ?>" required><br><br>

    <input type="submit" name="update" value="บันทึกการแก้ไข">
  </form>
</div>
</body>
</html>
