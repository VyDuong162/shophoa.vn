<?php
    include_once(__DIR__.'/../../dbconnect.php');
    $sqlSoLuongKhuyenMai = "SELECT COUNT(*) AS SoLuong FROM khuyenmai";
    $result = mysqli_query($conn, $sqlSoLuongKhuyenMai);
    $dataSoLuongKhuyenMai = [];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $dataSoLuongKhuyenMai = array(
            'SoLuong' => $row['SoLuong']
        );
    }
    echo json_encode($dataSoLuongKhuyenMai);
?>