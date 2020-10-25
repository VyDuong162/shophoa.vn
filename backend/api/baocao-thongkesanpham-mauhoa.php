<?php
    include_once(__DIR__.'/../../dbconnect.php');
    $sql =<<<EOT
    SELECT mh.mh_ten as Ten_MauHoa, COUNT(*) AS SoLuong
    FROM MauHoa mh
    JOIN  sanpham_has_mauhoa sp_mh ON mh.mh_id=sp_mh.mauhoa_mh_id
    GROUP BY mh.mh_id
EOT;
    $result =mysqli_query($conn, $sql);
    $data= [];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $data[]=array(
            'TenMauHoa' =>$row['Ten_MauHoa'],
            'SoLuong' =>$row['SoLuong']
        );
        
    }
    echo json_encode($data);
?>