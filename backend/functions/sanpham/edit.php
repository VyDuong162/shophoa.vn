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
    <title>Thêm khuy?n m?i</title>
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?>
    <link rel="stylesheet" href="/shophoa.vn/assets/backend/css/style.css" type="text/css" />
</head>

<body>
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 position-static">
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            </div>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <?php

                $sqlLoaiSanPham = "select * from `loaihoa`";
                $resultLoaiSanPham = mysqli_query($conn, $sqlLoaiSanPham);
                $dataLoaiSanPham = [];
                while ($rowLoaiSanPham = mysqli_fetch_array($resultLoaiSanPham, MYSQLI_ASSOC)) {
                    $dataLoaiSanPham[] = array(
                        'lh_id' => $rowLoaiSanPham['lh_id'],
                        'lh_ten' => $rowLoaiSanPham['lh_ten'],
                        /* 'lsp_mota' => $rowLoaiSanPham['lsp_mota'], */
                    );
                }


                $sqlMauHoa = "select * from `mauhoa`";
                $resultMauHoa = mysqli_query($conn, $sqlMauHoa);
                $dataMauHoa = [];
                while ($rowMauHoa = mysqli_fetch_array($resultMauHoa, MYSQLI_ASSOC)) {
                    $dataMauHoa[] = array(
                        'mh_id' => $rowMauHoa['mh_id'],
                        'mh_ten' => $rowMauHoa['mh_ten'],
                        /* 'lsp_mota' => $rowLoaiSanPham['lsp_mota'], */
                    );
                }


                $sqlChuDe = "select * from `chude`";
                $resultChuDe = mysqli_query($conn, $sqlChuDe);
                $dataChuDe = [];
                while ($rowChuDe = mysqli_fetch_array($resultChuDe, MYSQLI_ASSOC)) {
                    $dataChuDe[] = array(
                        'cd_id' => $rowChuDe['cd_id'],
                        'cd_ten' => $rowChuDe['cd_ten'],
                        /* 'lsp_mota' => $rowLoaiSanPham['lsp_mota'], */
                    );
                }




                $sqlKhuyenMai = "select * from `khuyenmai`";
                $resultKhuyenMai = mysqli_query($conn, $sqlKhuyenMai);

                $dataKhuyenMai = [];
                while ($rowKhuyenMai = mysqli_fetch_array($resultKhuyenMai, MYSQLI_ASSOC)) {
                    $km_tomtat = '';
                    if (!empty($rowKhuyenMai['km_ten'])) {
                        $km_tomtat = sprintf(
                            "Khuy?n m?i %s, n?i dung: %s, th?i gian: %s-%s",
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
                <div class="row ">
                    <div class="col-md-12 text-right mt-3">
                        <a href="index.php"><button type="button" id="btndanhsach" class="btn btn-primary">Danh sách</button></a> <br><br>
                    </div>
                </div>
                <form name="frmsanpham" id="frmsanpham" method="post" action="">
                    <div class="row mb-10">

                        <div class="col-md-12 text-center">
                            <h1 id="frmtitle" class="h2 mb-0 text-gray-800 mb-3 shadow">Thêm m?i s?n ph?m</h1>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sp_gia">Tên hoa</label>
                                <input type="text" class="form-control" id="sp_ten" name="sp_ten" placeholder="Tên hoa" value="">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sp_gia">Giá hoa</label>
                                <input type="text" class="form-control" id="sp_ten" name="sp_ten" placeholder="Giá S?n ph?m" value="">
                            </div>
                        </div>
                       
                        

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sp_giacu">Giá c?</label>
                                <input type="text" class="form-control" id="sp_giacu" name="sp_giacu" placeholder="Giá c? S?n ph?m" value="">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sp_giacu">Yêu thich</label>
                                <input type="text" class="form-control" id="sp_yeuthich" name="sp_yeuthich" placeholder="Yêu thich" value="">
                            </div>
                        </div>



                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sp_mota_ngan">Mô t? ng?n</label>
                                <input type="text" class="form-control" id="sp_mota_ngan" name="sp_mota_ngan" placeholder="Mô t? ng?n S?n ph?m" value="">
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sp_mota_chitiet">Mô t? chi ti?t</label>
                                <input type="text" class="form-control" id="sp_mota_chitiet" name="sp_mota_chitiet" placeholder="Mô t? chi ti?t S?n ph?m" value="">
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sp_ngaycapnhat">Ngày c?p nh?t</label>
                                <input type="text" class="form-control" id="sp_ngaycapnhat" name="sp_ngaycapnhat" placeholder="Ngày c?p nh?t S?n ph?m" value="">
                            </div>
                        </div>


                        <!-- Them select cho loai san pham -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="lsp_ma">Lo?i s?n ph?m</label>
                                <select class="form-control" id="lh_id" name="lh_id">
                                    <?php foreach ($dataLoaiSanPham as $loaisanpham) : ?>
                                        <option value="<?= $loaisanpham['lh_id'] ?>"><?= $loaisanpham['lh_ten'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- Them select Màu hoa-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nsx_ma">Màu hoa</label>
                                <select class="form-control" id="mh_id" name="mh_id">
                                    <?php foreach ($dataMauHoa as $mauhoa) : ?>
                                        <option value="<?= $mauhoa['mh_id'] ?>"><?= $mauhoa['mh_ten'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- Them select nha san xuat -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nsx_ma">Ch? đ?</label>
                                <select class="form-control" id="cd_id" name="cd_ten">
                                    <?php foreach ($dataChuDe as $chude) : ?>
                                        <option value="<?= $chude['cd_id'] ?>"><?= $chude['cd_ten'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- Them select cho khuyen mai -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="km_ma">Khuy?n m?i</label>
                                <select class="form-control" id="km_ma" name="km_ma">
                                    <option value="">Không áp d?ng khuy?n m?i</option>
                                    <?php foreach ($dataKhuyenMai as $khuyenmai) : ?>
                                        <option value="<?= $khuyenmai['km_id'] ?>"><?= $khuyenmai['km_tomtat'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 text-center mb-5">
                            <button class="btn btn-success" name="btnsave" id="btnsave" type="submit">Lưu d? li?u</button>
                        </div>

                </form>
        </div>
        <?php
        if (isset($_POST['btnSave'])) {
            // L?y d? li?u ngư?i dùng hi?u ch?nh g?i t? REQUEST POST
            $ten = $_POST['sp_ten'];
            $gia = $_POST['sp_gia'];
            $giacu = $_POST['sp_giacu'];
            $yeuthich = $_POST['sp_yeuthich'];
            $motangan = $_POST['sp_mota_ngan'];
            $motachitiet = $_POST['sp_mota_chitiet'];
            $ngaycapnhat = $_POST['sp_ngaycapnhat'];
            $yeuthich = $_POST['sp_yeuthich'];
            $lh_id = $_POST['lh_id'];
            $mh_id = $_POST['mh_id'];
            $cd_id = $_POST['cd_id'];
            $km_id = (empty($_POST['km_id']) ? '' : 'NULL');
            // Câu l?nh INSERT
            $sql = "UPDATE `sanpham` SET sp_ten='$ten', sp_gia=$gia,sp_yeuthich=$sp_yeuthich, sp_giacu=$giacu, sp_mota_ngan='$motangan', sp_mota_chitiet='$motachitiet', sp_ngaycapnhat='$ngaycapnhat', lh_id=$lh_id,mh_id=$mh_id, cd_id=$cd_id, km_id=$km_id WHERE sp_id=$sp_id;";

            // Th?c thi INSERT
            mysqli_query($conn, $sql);
            // Đóng k?t n?i
            mysqli_close($conn);
            // Sau khi c?p nh?t d? li?u, t? đ?ng đi?u hư?ng v? trang Danh sách
            //echo "<script>location.href = 'index.php';</script>";
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
