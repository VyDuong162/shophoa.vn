<?php
// Truy v?n database
// 1. Include file c?u h?nh k?t n?i đ?n database, kh?i t?o k?t n?i $conn
include_once(__DIR__ . '/../../../dbconnect.php');
$sp_id = $_GET['sp_id'];
$sqlSanpham = "DELETE FROM `sanpham` WHERE sp_id=" . $sp_id;
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
header('location:index.php');
?>