<?php
    include_once(__DIR__.'/../../../dbconnect.php');
    $mauhoa_mh_id=$_GET['mauhoa_mh_id']; 
    $sanpham_sp_id=$_GET['sanpham_sp_id']; 
    
    $sql =<<<EOT
    DELETE FROM sanpham_has_mauhoa WHERE mauhoa_mh_id=$mauhoa_mh_id AND sanpham_sp_id = $sanpham_sp_id
EOT;
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header('location:sanpham.php?mh_id='.$mauhoa_mh_id);
?>