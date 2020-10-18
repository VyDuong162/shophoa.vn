<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../dbconnect.php');
$sp_id = $_POST['sp_id'];
if (isset($_SESSION['giohangdata'])) {
    $data = $_SESSION['giohangdata'];
    if (isset($data[$sp_id])) {
        unset($data[$sp_id]);
    }
    $_SESSION['giohangdata'] = $data;
}
echo json_encode($_SESSION['giohangdata']);
