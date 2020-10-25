<?php
if (session_id() === '') {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Hoa | Thêm mới loại hoa</title>
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?>
    <link rel="stylesheet" href="/shophoa.vn/assets/backend/css/style.css" type="text/css" />
</head>

<body>
    <!-- Phần loading trang web -->
    <div id="load">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 position-static">
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            </div>
            <main role="main" id="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <?php
                include_once(__DIR__ . '/../../../dbconnect.php');
                $sql = "SELECT lh_id,lh_ten FROM loaihoa";
                $result = mysqli_query($conn, $sql);
                $dataLoaiHoa = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $dataLoaiHoa[] = array(
                        'lh_id' => $row['lh_id'],
                        'lh_ten' => $row['lh_ten']
                    );
                }
                ?>
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-md-12 mt-3">
                            <a href="index.php"><button type="button" id="btndanhsach" class="btn btn-primary">Danh sách</button></a> <br><br>
                        </div>
                    </div>
                    <form name="frmthemmoi" id="frmthemmoi" action="" method="post" enctype="multipart/form-data">
                        <div class="row mb-10">
                            <div class="col-md-12 text-center">
                                <h1 id="frmtitle" class="h2 mb-0 text-gray-800 mb-3 shadow">Thêm mới loại hoa</h1>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="lh_ten">Tên loại hoa</label>
                                    <input type="text" class="form-control" id="lh_ten" name="lh_ten" placeholder="Tên loại hoa" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="lh_mota">Mô tả loại hoa</label>
                                    <textarea id="lh_mota" class="form-control" name="lh_mota" cols="30" rows="10" placeholder="Mô tả loại hoa" value="<?= $dataLoaiHoa['lh_ten'] ?>"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 text-center mb-5">
                                <button class="btn btn-success" name="btnsave" id="btnsave" type="submit">Lưu dữ liệu</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                if (isset($_POST['btnsave']) && !empty($_POST['lh_ten'])) {
                    $lh_ten = htmlentities($_POST['lh_ten']);
                    $lh_mota = htmlentities($_POST['lh_mota']);
                    // Câu lệnh INSERT
                    $sql = "INSERT INTO `loaihoa` (lh_ten,lh_mota) VALUES ('$lh_ten','$lh_mota');";
                    // print_r($sql); die;
                    // Thực thi INSERT
                    //var_dump($sql);die;
                    mysqli_query($conn, $sql);
                    //Đóng kết nối
                    mysqli_close($conn);
                    echo '<script>location.href = "index.php";</script>';
                }
                ?>
            </main>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>
    <script src="/shophoa.vn/assets/vendor/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('lh_mota');
    </script>
</body>

</html>