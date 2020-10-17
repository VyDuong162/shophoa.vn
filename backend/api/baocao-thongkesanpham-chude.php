<?php
    include_once(__DIR__.'/../../dbconnect.php');
    $sql =<<<EOT
    SELECT cd.cd_ten as Ten_ChuDe, COUNT(*) AS SoLuong
    FROM chude cd
    JOIN  sanpham_has_chude sp_cd ON cd.cd_id=sp_cd.chude_cd_id
    GROUP BY cd.cd_id
EOT;
    $result =mysqli_query($conn, $sql);
    $data= [];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $data[]=array(
            'TenChuDe' =>$row['Ten_ChuDe'],
            'SoLuong' =>$row['SoLuong']
        );
        
    }
    echo json_encode($data);
?>