<?php
include_once(__DIR__ . '/dbconnect.php');
$sp_id = $_POST['sp_id'];
$sql = <<<EOT
    SELECT sp.sp_id, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_mota_ngan, sp.sp_avt_tenfile, hsp.hsp_tenfile AS hsp_tenfile,AVG(bl.bl_sao) AS sao, (
        SELECT COUNT(*)
        FROM binhluan AS a
        WHERE a.sanpham_sp_id = {$sp_id}
        GROUP BY a.sanpham_sp_id
    ) AS sobl
    FROM sanpham AS sp
    LEFT JOIN hinhsanpham AS hsp ON sp.sp_id = hsp.sanpham_sp_id
    LEFT JOIN binhluan AS bl ON sp.sp_id = bl.sanpham_sp_id
    GROUP BY sp.sp_id
    HAVING sp.sp_id = {$sp_id};
EOT;
$result = mysqli_query($conn, $sql);
$data = [];
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $data[] = array(
        'sp_id' => $row['sp_id'],
        'sp_ten' => $row['sp_ten'],
        'sp_mota_ngan' => $row['sp_mota_ngan'],
        'sp_gia' => number_format($row['sp_gia'], 0, ".", ","),
        'sp_giacu' => number_format($row['sp_giacu'], 0, ".", ","),
        'sp_avt_tenfile' => $row['sp_avt_tenfile'],
        'sao' => $row['sao'] > 0 ? $row['sao'] : 0,
        'sobl' => $row['sobl'] > 0 ? $row['sobl'] : 0,
    );
}
mysqli_close($conn);
echo json_encode($data[0]);
