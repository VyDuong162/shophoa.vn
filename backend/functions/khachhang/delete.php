<?php
    include_once(__DIR__.'/../../../dbconnect.php');
    $id=$_GET['idxoa'];
    $sql ="DELETE FROM khachhang WHERE kh_id=$id";
    mysqli_query($conn, $sql);
    //var_dump($sql); die();
    mysqli_close($conn);
    //header('location:index.php');
?>