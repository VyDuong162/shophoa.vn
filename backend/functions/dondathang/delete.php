<?php
    include_once(__DIR__ . '/../../../dbconnect.php');
    $ddh_id = $_GET['idxoa'];
    $sqlDeleteChiTietDonHang = "DELETE FROM `dondathang_has_sanpham` WHERE dondathang_ddh_id=" . $ddh_id;
    $resultChiTietDonHang = mysqli_query($conn, $sqlDeleteChiTietDonHang);
    $sqlDeleteDonHang = "DELETE FROM `dondathang` WHERE ddh_id=" . $ddh_id;
    $resultDonHang = mysqli_query($conn, $sqlDeleteDonHang);
    mysqli_close($conn);
    header('location:index.php');
?>