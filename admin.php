<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

$username = $_SESSION['username'];

if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];
  $delete_query = "DELETE FROM employees WHERE id = $delete_id";
  mysqli_query($conn, $delete_query);
  header("Location: admin.php");
  exit();
}

$query = "SELECT * FROM employees";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
  <title>ระบบผู้ดูแล</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<body>
<div class="container">
  <h2>ระบบผู้ดูแล</h2>
  <p>ยินดีต้อนรับ, <?php echo $username; ?></p>
  <table class="table table-striped table-hover">
    <tr>
      <th>ID</th>
      <th>ชื่อ</th>
      <th>นามสกุล</th>
      <th>Email</th>
      <th>เบอร์โทร</th>
      <th>แก้ไข</th>
      <th>ลบ</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['lastname']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['tel']; ?></td>
        <td><a href="edit_employee.php?id=<?php echo $row['id']; ?>">แก้ไข</a></td>
        <td><a href="delete_employee.php?delete_id=<?php echo $row['id']; ?>">ลบ</a></td>
      </tr>
    <?php } ?>
  </table>
  <a href="formAdd.php" class="button">เพิ่มข้อมูล</a>
  <a href="login.php" class="button">ออกจากระบบ</a>
    </div>
</body>

</html>
