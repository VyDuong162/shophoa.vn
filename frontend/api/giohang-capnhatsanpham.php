<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../dbconnect.php');
$sp_id = $_POST['sp_id'];
$soluong = $_POST['soluong'];
if (isset($_SESSION['giohangdata'])) {
    $data = $_SESSION['giohangdata'];
    $sanphamcu = $data[$sp_id];

    $data[$sp_id] = array(
        'sp_id' => $sanphamcu['sp_id'],
        'sp_ten' => $sanphamcu['sp_ten'],
        'soluong' => $soluong,
        'sp_gia' => $sanphamcu['sp_gia'],
        'thanhtien' => ($soluong * $sanphamcu['sp_gia']),
        'sp_avt_tenfile' => $sanphamcu['sp_avt_tenfile']
    );

    $_SESSION['giohangdata'] = $data;
}

echo json_encode($_SESSION['giohangdata']);
