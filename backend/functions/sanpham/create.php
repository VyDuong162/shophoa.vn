<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../../dbconnect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hoaxin</title>

    <?php
    include_once(__DIR__ . '/../../layouts/styles.php');
    ?>


</head>

<body>
    <!-- header -->
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>

    <!-- end header -->


    <!-- Phần sidebar -->
    <div class="container-fiuld">
        <main role="main" class="col-md-10 ml-sm-auto px-4 mb-2">
            <div class="row">

                <!-- Phần sidebar -->
                <?php
                include_once(__DIR__ . '/../../layouts/partials/sidebar.php');
                ?>

                <!-- Phần sidebar -->
                <?php

                // Chuẩn bị câu truy vấn Loại sản phẩm
                $sqlLoaiSanPham = "select * from `loaihoa`";
                $resultLoaiSanPham = mysqli_query($conn, $sqlLoaiSanPham);
                $dataLoaiSanPham = [];
                while ($rowLoaiSanPham = mysqli_fetch_array($resultLoaiSanPham, MYSQLI_ASSOC)) {
                    $dataLoaiSanPham[] = array(
                        'lh_id' => $rowLoaiSanPham['lh_id'],
                        'lh_ten' => $rowLoaiSanPham['lh_ten'],
                        'lh_mota' => $rowLoaiSanPham['lh_mota'],
                    );
                }

                // Chuẩn bị câu truy vấn Loại sản phẩm
                $sqlChude = "select * from `chude`";
                $resultChude = mysqli_query($conn, $sqlChude);
                $dataChude = [];
                while ($rowChude = mysqli_fetch_array($resultChude, MYSQLI_ASSOC)) {
                    $dataChude[] = array(
                        'cd_id' => $rowChude['cd_id'],
                        'cd_ten' => $rowChude['cd_ten'],
                    );
                }

                /*  Truy vấn dữ liệu khuyến mãi */
                $sqlKhuyenMai = "select * from `khuyenmai`";
                $resultKhuyenMai = mysqli_query($conn, $sqlKhuyenMai);

                $dataKhuyenMai = [];
                while ($rowKhuyenMai = mysqli_fetch_array($resultKhuyenMai, MYSQLI_ASSOC)) {
                    $km_tomtat = '';
                    if (!empty($rowKhuyenMai['km_ten'])) {
                        $km_tomtat = sprintf(
                            "Khuyến mãi %s, nội dung: %s, thời gian: %s-%s",
                            $rowKhuyenMai['km_ten'],
                            $rowKhuyenMai['km_noidung'],
                            date('d/m/Y', strtotime($rowKhuyenMai['km_tungay'])),
                            date('d/m/Y', strtotime($rowKhuyenMai['km_denngay']))
                        );
                    }
                    $dataKhuyenMai[] = array(
                        'km_id' => $rowKhuyenMai['km_id'],
                        'km_tomtat' => $km_tomtat,
                    );
                }
                ?>
                <div class="col-md-12">
                    <div class="text-justify pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="text-justify">Thêm sản phẩm</h1>
                    </div>
                    <form name="frmsanpham" id="frmsanpham" method="post" action="">
                        <div class="form-group">
                            <label for="sp_ten">Tên hoa</label>
                            <input type="text" class="form-control" id="sp_ten" name="sp_ten" placeholder="Tên hoa" value="">
                        </div>
                        <div class="form-group">
                            <label for="sp_gia">Giá hoa</label>
                            <input type="text" class="form-control" id="sp_gia" name="sp_gia" placeholder="Giá Sản phẩm" value="">
                        </div>
                        <div class="form-group">
                            <label for="sp_giacu">Giá cũ</label>
                            <input type="text" class="form-control" id="sp_giacu" name="sp_giacu" placeholder="Giá cũ Sản phẩm" value="">
                        </div>
                        <div class="form-group">
                            <label for="sp_mota_ngan">Mô tả ngắn</label>
                            <input type="text" class="form-control" id="sp_mota_ngan" name="sp_mota_ngan" placeholder="Mô tả ngắn Sản phẩm" value="">
                        </div>
                        <div class="form-group">
                            <label for="sp_mota_chitiet">Mô tả chi tiết</label>
                            <input type="text" class="form-control" id="sp_mota_chitiet" name="sp_mota_chitiet" placeholder="Mô tả chi tiết Sản phẩm" value="">
                        </div>
                        <div class="form-group">
                            <label for="sp_ngaycapnhat">Ngày cập nhật</label>
                            <input type="text" class="form-control" id="sp_ngaycapnhat" name="sp_ngaycapnhat" placeholder="Ngày cập nhật Sản phẩm" value="">
                        </div>
                        
                        <!-- Them select cho loai san pham -->
                        <div class="form-group">
                            <label for="lh_id">Loại sản phẩm</label>
                            <select class="form-control" id="lh_id" name="lh_id">
                                <?php foreach ($dataLoaiSanPham as $loaisanpham) : ?>
                                    <option value="<?= $loaisanpham['lh_id'] ?>"><?= $loaisanpham['lh_ten'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Them select chu de -->
                        <div class="form-group">
                            <label for="cd_id">Chủ đề</label>
                            <select class="form-control" id="cd_id" name="cd_id">
                                <?php foreach ($dataChude as $chude) : ?>
                                    <option value="<?= $chude['cd_id'] ?>"><?= $chude['cd_ten'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Them select cho khuyen mai -->
                        <div class="form-group">
                            <label for="km_id">Khuyến mãi</label>
                            <select class="form-control" id="km_id" name="km_id">
                                <option value="">Không áp dụng khuyến mãi</option>
                                <?php foreach ($dataKhuyenMai as $khuyenmai) : ?>
                                    <option value="<?= $khuyenmai['km_id'] ?>"><?= $khuyenmai['km_tomtat'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button class="btn btn-primary" name="btnSave">Lưu dữ liệu</button>
                    </form>
                    <?php 
                         if (isset($_POST['btnSave'])) {
                            // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
                            $ten = $_POST['sp_ten'];
                            $gia = $_POST['sp_gia'];
                            $giacu = $_POST['sp_giacu'];
                            $motangan = $_POST['sp_mota_ngan'];
                            $motachitiet = $_POST['sp_mota_chitiet'];
                            $ngaycapnhat = $_POST['sp_ngaycapnhat'];
                            $lh_id = $_POST['lh_id'];
                            $cd_id = $_POST['cd_id'];
                            $km_id = (empty($_POST['km_id']) ? '' : 'NULL');
                            // Câu lệnh INSERT
                            $sql = "INSERT INTO `sanpham` (sp_ten, sp_gia, sp_giacu, sp_mota_ngan, sp_mota_chitiet, sp_ngaycapnhat, lh_id, cd_id, km_id) VALUES ('$ten', $gia, $giacu, '$motangan', '$motachitiet', $ngaycapnhat,$lh_id,$cd_id,$km_id);";
                            // Thực thi INSERT
                            var_dump($sql); die;
                            mysqli_query($conn, $sql);
                            // Đóng kết nối
                            mysqli_close($conn);
                            //echo "<script>location.href = 'index.php';</script>";

                        }
                    ?>

                </div>
            </div>
        </main>


    </div>
    <!-- sidebar -->


    <!-- Phần footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>

    <!-- footer -->



    <?php
    include_once(__DIR__ . '/../../layouts//scripts.php');
    ?>
</body>

</html>