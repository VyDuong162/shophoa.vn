<?php
    include_once(__DIR__.'/../../../dbconnect.php');
    $loaihoa_lh_id=$_GET['loaihoa_lh_id']; 
    $sanpham_sp_id=$_GET['sanpham_sp_id']; 
    
    $sql =<<<EOT
    DELETE FROM sanpham_has_loaihoa WHERE loaihoa_lh_id=$loaihoa_lh_id AND sanpham_sp_id = $sanpham_sp_id
EOT;
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header('location:sanpham.php?lh_id='.$loaihoa_lh_id);
?>