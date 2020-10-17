<?php
    include_once(__DIR__.'/../../dbconnect.php');
    $sql =<<<EOT
    SELECT lh.lh_ten as Ten_LoaiHoa, COUNT(*) AS SoLuong
    FROM loaihoa lh
    JOIN  sanpham_has_loaihoa sp_lh ON lh.lh_id=sp_lh.loaihoa_lh_id
    GROUP BY lh.lh_id
EOT;
    $result =mysqli_query($conn, $sql);
    $data= [];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $data[]=array(
            'TenLoaiHoa' =>$row['Ten_LoaiHoa'],
            'SoLuong' =>$row['SoLuong']
        );
        
    }
    echo json_encode($data);
?>