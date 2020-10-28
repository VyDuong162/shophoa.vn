<?php
    include_once(__DIR__.'/../../../dbconnect.php');
    $id=$_GET['idxoa'];
    $sqlrow=<<<EOT
    DELETE FROM  sanpham_has_chude WHERE chude_cd_id=$id
EOT;
    mysqli_query($conn, $sqlrow);
    $sql =<<<EOT
    DELETE FROM chude WHERE cd_id=$id
EOT;
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header('location:index.php');
?>