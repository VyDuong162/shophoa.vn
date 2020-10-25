<?php
// Truy v?n database
// 1. Include file c?u h?nh k?t n?i đ?n database, kh?i t?o k?t n?i $conn
include_once(__DIR__ . '/../../../dbconnect.php');
$sp_id = $_GET['sp_id'];
$sqlXoaMauHoa = "DELETE FROM sanpham_has_mauhoa WHERE sanpham_sp_id = $sp_id;";
mysqli_query($conn, $sqlXoaMauHoa);
$sqlXoaLoaiHoa = "DELETE FROM sanpham_has_loaihoa WHERE sanpham_sp_id = $sp_id";
mysqli_query($conn, $sqlXoaLoaiHoa);
$sqlXoaChuDe = "DELETE FROM sanpham_has_chude WHERE sanpham_sp_id = $sp_id";
mysqli_query($conn, $sqlXoaChuDe);
$sqlXoaHinhSan = "DELETE FROM hinhsanpham WHERE sanpham_sp_id = $sp_id";
mysqli_query($conn, $sqlXoaHinhSan);
$sqlXoaSanPham = "DELETE FROM sanpham WHERE sp_id = $sp_id";
mysqli_query($conn, $sqlXoaSanPham);
mysqli_close($conn);
header('location:index.php');
?>