<?php
    include_once(__DIR__.'/../../dbconnect.php');
    $sanpham_sp_id = $_POST['sanpham_sp_id'];
    $khachhang_kh_id = $_POST['khachhang_kh_id'];
    $kh_bl_noidung = $_POST['kh_bl_noidung'];
    $bl_sao = $_POST['bl_sao'];
    $sql="INSERT INTO binhluan
    (kh_bl_noidung, kh_bl_ngay, khachhang_kh_id, sanpham_sp_id, bl_sao) VALUES (N'$kh_bl_noidung', NOW(), $khachhang_kh_id,$sanpham_sp_id, $bl_sao)";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header('location:/shophoa.vn/frontend/sanpham/chitiet.php?sp_id='.$sanpham_sp_id);