<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../dbconnect.php');
$sp_ma = $_POST['sp_id'];
$sp_ten = $_POST['sp_ten'];
$soluong = $_POST['soluong'];
$sp_gia = $_POST['sp_gia'];
$sp_avt_tenfile = $_POST['sp_avt_tenfile'];
if (isset($_SESSION['giohangdata'])) {
    $data = $_SESSION['giohangdata'];
    $data[$sp_ma] = array(
        'sp_ma' => $sp_ma,
        'sp_ten' => $sp_ten,
        'soluong' => ($soluong),
        'sp_gia' => $sp_gia,
        'thanhtien' => (($soluong) * $gia),
        'sp_avt_tenfile' => $sp_avt_tenfile
    );
    $_SESSION['giohangdata'] = $data;
} else {
    $data[$sp_ma] = array(
        'sp_ma' => $sp_ma,
        'sp_ten' => $sp_ten,
        'soluong' => $soluong,
        'sp_gia' => $sp_gia,
        'thanhtien' => ($soluong * $gia),
        'sp_avt_tenfile' => $sp_avt_tenfile
    );

    $_SESSION['giohangdata'] = $data;
}
echo json_encode($_SESSION['giohangdata']);