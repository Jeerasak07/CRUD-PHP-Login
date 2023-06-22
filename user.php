<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

$username = $_SESSION['username'];

$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>หน้าผู้ใช้</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h2>สวัสดี, <?php echo $row['name']; ?></h2>
    <p>ชื่อผู้ใช้ : <?php echo $row['username']; ?></p>
    <a href='formAdd.php'>เพิ่มข้อมูล</a>
    <a href="logout.php">ออกจากระบบ</a>
    <br><br>

    <?php
    // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
    $query = "SELECT * FROM employees";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
      echo "<table class='table table-striped table-hover'>";
      echo "<tr><th>ID</th><th>Name</th><th>Lastname</th><th>Email</th><th>Telephone</th><th>Action</th></tr>";

      // นับลำดับเพื่อกำหนดค่า ID ใหม่
      $count = 1;

      while ($row = mysqli_fetch_assoc($result)) {
        // อัพเดทค่า ID ใหม่ในฐานข้อมูล
        $id = $row['id'];
        $update_query = "UPDATE employees SET id = $count WHERE id = $id";
        mysqli_query($conn, $update_query);

        echo "<tr>";
        echo "<td>" . $count . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['lastname'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['tel'] . "</td>";
        echo "<td><a href='edit_employee.php?id=" . $count . "'>Edit</a></td>";
        echo "</tr>";

        $count++;
      }

      echo "</table>";
    } else {
      echo "No users found.";
    }
    ?>

  </div>
</body>
</html>