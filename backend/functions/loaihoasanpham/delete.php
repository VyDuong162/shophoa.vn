<?php
    include_once(__DIR__.'/../../../dbconnect.php');
    $id=$_GET['idxoa'];
    
    $sql =<<<EOT
    DELETE FROM loaihoa WHERE lh_id=$id
EOT;
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header('location:index.php');
?>