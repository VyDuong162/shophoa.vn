<?php
    include_once(__DIR__.'/../../dbconnect.php');
    $sqlSoLuongHinhSanPham = "SELECT COUNT(*) SoLuong FROM hinhsanpham";
    $result =mysqli_query($conn, $sqlSoLuongHinhSanPham);
    $dataSoLuongHinhSanPham =[];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $dataSoLuongHinhSanPham = array(
            'SoLuong' => $row['SoLuong']
        );
    }
    echo json_encode($dataSoLuongHinhSanPham);
?>