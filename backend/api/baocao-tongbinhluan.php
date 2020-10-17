<?php
    include_once(__DIR__.'/../../dbconnect.php');
    $sqlSoLuongBinhLuan = "SELECT COUNT(*) SoLuong FROM binhluan";
    $result =mysqli_query($conn, $sqlSoLuongBinhLuan);
    $dataSoLuongBinhLuan =[];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $dataSoLuongBinhLuan = array(
            'SoLuong' => $row['SoLuong']
        );
    }
    echo json_encode($dataSoLuongBinhLuan);
?>