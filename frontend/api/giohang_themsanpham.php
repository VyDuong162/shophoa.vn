<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../dbconnect.php');
$sp_id = $_POST['sp_id'];
$sp_ten = $_POST['sp_ten'];
$soluong = $_POST['soluong'];
$sp_gia = $_POST['sp_gia'];
$sp_avt_tenfile = $_POST['sp_avt_tenfile'];

if (isset($_SESSION['giohangdata'])) {
    $data = $_SESSION['giohangdata'];
    $data[$sp_id] = array(
        'sp_id' => $sp_id,
        'sp_ten' => $sp_ten,
        'soluong' => $soluong,
        'sp_gia' => $sp_gia,
        'thanhtien' => ($soluong * $sp_gia),
        'sp_avt_tenfile' => $sp_avt_tenfile
    );
    $_SESSION['giohangdata'] = $data;
} else {
    $data[$sp_id] = array(
        'sp_id' => $sp_id,
        'sp_ten' => $sp_ten,
        'soluong' => $soluong,
        'sp_gia' => $sp_gia,
        'thanhtien' => ($soluong * $gia),
        'sp_avt_tenfile' => $sp_avt_tenfile
    );

    $_SESSION['giohangdata'] = $data;
}
echo json_encode($_SESSION['giohangdata']);