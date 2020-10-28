<?php
    include_once(__DIR__ . '/../../../dbconnect.php');
    $id = $_GET['idxoa'];
    $sqlrow=<<<EOT
    UPDATE sanpham
	SET
		km=NULL
	WHERE
        km=$id; 
EOT;
    mysqli_query($conn, $sqlrow);
    $sqlSelect = "SELECT * FROM `khuyenmai` WHERE km_id=$id;";
    $resultSelect = mysqli_query($conn, $sqlSelect);
    $dataKhuyenMai = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC); 
    $upload_dir = __DIR__ . "/../../../assets/uploads/";
    $subdir = 'img-km/';
    $old_file = $upload_dir . $subdir . $dataKhuyenMai['km_anh'];
    if (file_exists($old_file)) {
        // Hàm unlink(filepath) dùng để xóa file trong PHP
        unlink($old_file);
    }
    
    $id = $_GET['idxoa'];
    $sql = "DELETE FROM `khuyenmai` WHERE km_id=" . $id;
    // 5. Thực thi câu lệnh DELETE
    $result = mysqli_query($conn, $sql);
    // 6. Đóng kết nối
    mysqli_close($conn);
    header('location:index.php');
?>