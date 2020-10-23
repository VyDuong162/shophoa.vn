<?php
    include_once(__DIR__.'/../../../dbconnect.php');
    $chude_cd_id=$_GET['chude_cd_id']; 
    $sanpham_sp_id=$_GET['sanpham_sp_id']; 
    
    $sql =<<<EOT
    DELETE FROM sanpham_has_chude WHERE chude_cd_id=$chude_cd_id AND sanpham_sp_id = $sanpham_sp_id
EOT;
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header('location:sanpham.php?cd_id='.$chude_cd_id);
?>