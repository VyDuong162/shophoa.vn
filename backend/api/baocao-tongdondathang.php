<?php
    include_once(__DIR__.'/../../dbconnect.php');
    $sqlSoLuongDonDatHang ="SELECT COUNT(*) AS SoLuong FROM dondathang";
    $result = mysqli_query($conn, $sqlSoLuongDonDatHang);
    $dataSoLuongDonDatHang = [];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $dataSoLuongDonDatHang = array(
            'SoLuong' =>$row['SoLuong']
        );
    }
    echo json_encode($dataSoLuongDonDatHang);
?>