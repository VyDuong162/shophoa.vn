<?php
    include_once(__DIR__.'/../../dbconnect.php');
    $sqlSanPhamYeuThich =<<<EOT
        SELECT sp_ten,sp_yeuthich 
        FROM sanpham
        GROUP BY sp_yeuthich
        ORDER BY sp_yeuthich DESC
        LIMIT 3
EOT;
    $result =mysqli_query($conn, $sqlSanPhamYeuThich);
    $dataSanPhamYeuThich= [];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $dataSanPhamYeuThich[]=array(
            'TenSanPham' =>$row['sp_ten'],
            'SoLuong' =>$row['sp_yeuthich']
        );
    }
    echo json_encode($dataSanPhamYeuThich);
?>