<?php
    include_once(__DIR__.'/../../../dbconnect.php');
    $id=$_GET['idxoa'];
    $sqlrow=<<<EOT
    DELETE FROM  sanpham_has_loaihoa WHERE loaihoa_lh_id=$id
EOT;
    mysqli_query($conn, $sqlrow);
    $sql =<<<EOT
    DELETE FROM loaihoa WHERE lh_id=$id
EOT;
    mysqli_query($conn, $sql);
    //var_dump($sql); die();
    mysqli_close($conn);
    header('location:index.php');
?>