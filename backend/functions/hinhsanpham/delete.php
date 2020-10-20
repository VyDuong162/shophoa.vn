<?php

include_once(__DIR__ . '/../../../dbconnect.php');

$hasp_id = $_GET['hasp_id'];
$sqlSelect = "SELECT * FROM `hinhsanpham` WHERE hasp_id=$hasp_id;";

$resultSelect = mysqli_query($conn, $sqlSelect);
$hinhsanphamRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC); // 1 record

$upload_dir = __DIR__ . "/../../../assets/upload/";
$subdir = 'img-product/';
$old_file = $upload_dir . $subdir . $hinhsanphamRow['hsp_tenfile'];
if (file_exists($old_file)) {
    unlink($old_file);
}

$hasp_id = $_GET['hasp_id'];
$sql = "DELETE FROM `hinhsanpham` WHERE hasp_id=" . $hasp_id;
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
header('location:index.php');