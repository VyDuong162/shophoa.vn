<?php
    include_once(__DIR__.'/../../dbconnect.php');
    $sqlSoLuongSanPham="SELECT COUNT(*) AS SoLuong
    FROM sanpham ";
    $result = mysqli_query($conn,$sqlSoLuongSanPham);
    $dataSoLuongSanPham = [];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $dataSoLuongSanPham= array(
            'SoLuong' =>$row['SoLuong']
        );
    }
    echo json_encode($dataSoLuongSanPham);
?>