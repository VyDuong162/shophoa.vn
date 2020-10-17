<?php
    include_once(__DIR__.'/../../dbconnect.php');
    $sqlSoLuongChuDe = "SELECT COUNT(*) AS SoLuong FROM chude";
    $result = mysqli_query($conn, $sqlSoLuongChuDe);
    $dataSoLuongChuDe = [];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $dataSoLuongChuDe = array(
            'SoLuong' => $row['SoLuong']
        );
    }
    echo json_encode($dataSoLuongChuDe);
?>