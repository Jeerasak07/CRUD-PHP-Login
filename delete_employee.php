<?php
require_once 'db_connection.php';

if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];
  $delete_query = "DELETE FROM employees WHERE id = $delete_id";
  mysqli_query($conn, $delete_query);
}

header("Location: admin.php");
exit();
?>
