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

                // Chuẩn bị câu truy vấn $sqlSelect, lấy dữ liệu ban đầu của record cần update
                // Lấy giá trị khóa chính được truyền theo dạng QueryString Parameter key1=value1&key2=value2...
                $sp_id = $_GET['sp_id'];
                $sqlSelect = "SELECT * FROM `sanpham` WHERE sp_id=$sp_id;";

                // Thực thi câu truy vấn SQL để lấy về dữ liệu ban đầu của record cần update
                $resultSelect = mysqli_query($conn, $sqlSelect);
                $sanphamRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC); // 1 record
                /* --- End Truy vấn dữ liệu Sản phẩm theo khóa chính --- */
                ?>
            
                <div class="col-md-12">
                    <div class="text-justify pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="text-justify">Thêm sản phẩm</h1>
                    </div>
                    <form name="frmsanpham" id="frmsanpham" method="post" action="edit.php?sp_id=<?= $sanphamRow['sp_id'] ?>">
                        <div class="form-group">
                            <label for="sp_id">Mã Sản phẩm</label>
                            <input type="text" class="form-control" id="sp_id" name="sp_id" placeholder="Mã Sản phẩm" readonly value="<?= $sanphamRow['sp_id'] ?>">
                            <small id="sp_maHelp" class="form-text text-muted">Mã Sản phẩm không được hiệu chỉnh.</small>
                        </div>
                        <div class="form-group">
                            <label for="sp_ten">Tên hoa</label>
                            <input type="text" class="form-control" id="sp_ten" name="sp_ten" placeholder="Tên hoa" value="<?= $sanphamRow['sp_ten'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="sp_gia">Giá hoa</label>
                            <input type="text" class="form-control" id="sp_gia" name="sp_gia" placeholder="Giá Sản phẩm" value="<?= $sanphamRow['sp_gia'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="sp_giacu">Giá cũ</label>
                            <input type="text" class="form-control" id="sp_giacu" name="sp_giacu" placeholder="Giá cũ Sản phẩm" value="<?= $sanphamRow['sp_giacu'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="sp_mota_ngan">Mô tả ngắn</label>
                            <input type="text" class="form-control" id="sp_mota_ngan" name="sp_mota_ngan" placeholder="Mô tả ngắn Sản phẩm" value="<?= $sanphamRow['sp_mota_ngan'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="sp_mota_chitiet">Mô tả chi tiết</label>
                            <input type="text" class="form-control" id="sp_mota_chitiet" name="sp_mota_chitiet" placeholder="Mô tả chi tiết Sản phẩm" value="<?= $sanphamRow['sp_mota_chitiet'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="sp_ngaycapnhat">Ngày cập nhật</label>
                            <input type="text" class="form-control" id="sp_ngaycapnhat" name="sp_ngaycapnhat" placeholder="Ngày cập nhật Sản phẩm" value="sp_ngaycapnhat">
                        </div>
                        
                        <!-- Them select cho loai san pham -->
                        <div class="form-group">
                            <label for="lh_id">Loại sản phẩm</label>
                            <select class="form-control" id="lh_id" name="lh_id">
                                <?php foreach ($dataLoaiSanPham as $loaisanpham) : ?>
                                    <?php if ($loaisanpham['lh_id'] == $sanphamRow['lh_id']) : ?>
                                        <option value="<?= $loaisanpham['lh_id'] ?>" selected><?= $loaisanpham['lh_ten'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $loaisanpham['lh_id'] ?>"><?= $loaisanpham['lh_ten'] ?></option>
                                    <?php endif; ?>                                
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Them select chu de -->
                        <div class="form-group">
                            <label for="cd_id">Chủ đề</label>
                            <select class="form-control" id="cd_id" name="cd_id">
                                <?php foreach ($dataChude as $chude) : ?>
                                    <?php if ($chude['cd_id'] == $sanphamRow['cd_id']) : ?>
                                        <option value="<?= $chude['cd_id'] ?>" selected><?= $chude['cd_ten'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $chude['cd_id'] ?>"><?= $chude['cd_ten'] ?></option>
                                    <?php endif; ?>             
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Them select cho khuyen mai -->
                        <div class="form-group">
                            <label for="km_id">Khuyến mãi</label>
                            <select class="form-control" id="km_id" name="km_id">
                                <option value="">Không áp dụng khuyến mãi</option>
                                <?php foreach ($dataKhuyenMai as $khuyenmai) : ?>
                                    <?php if ($khuyenmai['cd_id'] == $sanphamRow['cd_id']) : ?>
                                        <option value="<?= $khuyenmai['km_id'] ?>" selected><?= $khuyenmai['km_ten'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $khuyenmai['km_id'] ?>"><?= $khuyenmai['km_ten'] ?></option>
                                    <?php endif; ?>                                         
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
                            // Câu lệnh UPDATE
                            $sql = "UPDATE `sanpham` SET sp_ten='$ten', sp_gia=$gia, sp_giacu=$giacu, sp_mota_ngan='$motangan', sp_mota_chitiet='$motachitiet', sp_ngaycapnhat='$ngaycapnhat', lh_id=$lh_id, cd_id=$cd_id, km_id=$km_id WHERE sp_id=$sp_id;";

                            // Thực thi UPDATE
                            mysqli_query($conn, $sql);

                            // Đóng kết nối
                            mysqli_close($conn);

                            // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
                            echo "<script>location.href = 'index.php';</script>";
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