<?php
// Truy vấn database
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__ . '/../../../dbconnect.php');
$sp_id = $_GET['sp_id'];
$sqlSanpham = "DELETE FROM `sanpham` WHERE sp_id=" . $sp_id;
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
header('location:index.php');
?>


