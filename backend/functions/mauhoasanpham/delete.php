<?php
    include_once(__DIR__.'/../../../dbconnect.php');
    $id=$_GET['idxoa'];
    $sqlrow=<<<EOT
    DELETE FROM  sanpham_has_mauhoa WHERE mauhoa_mh_id=$id
EOT;
    mysqli_query($conn, $sqlrow);
    $sql =<<<EOT
    DELETE FROM mauhoa WHERE mh_id=$id
EOT;
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header('location:index.php');
?>