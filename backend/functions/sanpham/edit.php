<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../../dbconnect.php');
$sp_id = $_GET['sp_id'];
$sqlSanPham = "SELECT * FROM sanpham AS a WHERE a.sp_id = {$sp_id};";
$resultSanPham = mysqli_query($conn, $sqlSanPham);
$dataSanPham = [];
while ($rowSanPham = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC)) {
    $dataSanPham = array(
        'sp_id' => $rowSanPham['sp_id'],
        'sp_ten' => $rowSanPham['sp_ten'],
        'sp_gia' => (int)$rowSanPham['sp_gia'],
        'sp_giacu' => (int)$rowSanPham['sp_giacu'],
        'sp_mota_ngan' => $rowSanPham['sp_mota_ngan'],
        'sp_mota_chitiet' => $rowSanPham['sp_mota_chitiet'],
        'sp_avt_tenfile' => $rowSanPham['sp_avt_tenfile'],
        'km' => $rowSanPham['km'],
    );
}
$sqlSanPhamLoaiSanPham = "SELECT loaihoa_lh_id FROM sanpham_has_loaihoa WHERE sanpham_sp_id = {$sp_id};";
$resultSanPhamLoaiSanPham = mysqli_query($conn, $sqlSanPhamLoaiSanPham);
$dataSanPhamLoaiSanPham = [];
while ($rowLoaiSanPham = mysqli_fetch_array($resultSanPhamLoaiSanPham, MYSQLI_ASSOC)) {
    $dataSanPhamLoaiSanPham[] = $rowLoaiSanPham['loaihoa_lh_id'];
}
$sqlSanPhamMauHoa = "SELECT mauhoa_mh_id FROM sanpham_has_mauhoa WHERE sanpham_sp_id = {$sp_id};";
$resultSanPhamMauHoa = mysqli_query($conn, $sqlSanPhamMauHoa);
$dataSanPhamMauHoa = [];
while ($rowSanPhamMauHoa = mysqli_fetch_array($resultSanPhamMauHoa, MYSQLI_ASSOC)) {
    $dataSanPhamMauHoa[] = $rowSanPhamMauHoa['mauhoa_mh_id'];
}
$sqlSanPhamChuDe = "SELECT chude_cd_id FROM sanpham_has_chude WHERE sanpham_sp_id = {$sp_id};";
$resultSanPhamChuDe = mysqli_query($conn, $sqlSanPhamChuDe);
$dataSanPhamChuDe = [];
while ($rowSanPhamChuDe = mysqli_fetch_array($resultSanPhamChuDe, MYSQLI_ASSOC)) {
    $dataSanPhamChuDe[] = $rowSanPhamChuDe['chude_cd_id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Hoa | Thêm mới sản phẩm</title>
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
                <div class="row ">
                    <div class="col-md-12 mt-3">
                        <a href="index.php"><button type="button" id="btndanhsach" class="btn btn-primary">Danh sách</button></a> <br><br>
                    </div>
                </div>
                <form name="frmsanpham" id="frmsanpham" method="post" action="" enctype="multipart/form-data">
                    <div class="row mb-5">

                        <div class="col-md-12 text-center">
                            <h1 id="frmtitle" class="h2 mb-0 text-gray-800 mb-3 shadow">Thêm mới sản phẩm</h1>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sp_gia">Tên bó hoa</label>
                                <input type="text" class="form-control" id="sp_ten" name="sp_ten" placeholder="Tên bó hoa" value="<?= $dataSanPham['sp_ten'] ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sp_giacu">Giá sản phẩm</label>
                                <input type="number" class="form-control" id="sp_giacu" name="sp_giacu" min=0 placeholder="Giá sản phẩm" value="<?= ($dataSanPham['sp_giacu'] == 0) ? $dataSanPham['sp_gia'] : $dataSanPham['sp_giacu'] ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sp_gia">Giá giảm giá</label>
                                <input type="number" class="form-control" id="sp_gia" name="sp_gia" min=0 placeholder="Giá giảm giá" value="<?= ($dataSanPham['sp_giacu'] == 0) ? $dataSanPham['sp_giacu'] : $dataSanPham['sp_gia'] ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sp_mota_ngan">Mô tả ngắn</label>
                                <textarea class="form-control" id="sp_mota_ngan" name="sp_mota_ngan" placeholder="Mô tả ngắn sản phẩm"><?= $dataSanPham['sp_mota_ngan'] ?></textarea>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sp_mota_chitiet">Mô tả chi tiết</label>
                                <textarea name="sp_mota_chitiet" id="sp_mota_chitiet" class="form-control"><?= $dataSanPham['sp_mota_chitiet'] ?></textarea>
                            </div>
                        </div>
                        <!-- Them select cho loai san pham -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Loại hoa</label>
                                <?php foreach ($dataLoaiSanPham as $loaisanpham) : ?>
                                    <div class="form-check">
                                        <?php if (is_numeric(array_search($loaisanpham['lh_id'], $dataSanPhamLoaiSanPham))) : ?>
                                            <input class="form-check-input" type="checkbox" value="<?= $loaisanpham['lh_id'] ?>" id="lh_id<?= $loaisanpham['lh_id'] ?>" name="lh_id[]" checked>
                                        <?php else : ?>
                                            <input class="form-check-input" type="checkbox" value="<?= $loaisanpham['lh_id'] ?>" id="lh_id<?= $loaisanpham['lh_id'] ?>" name="lh_id[]">
                                        <?php endif; ?>
                                        <label class="form-check-label" for="lh_id<?= $loaisanpham['lh_id'] ?>">
                                            <?= $loaisanpham['lh_ten'] ?>
                                        </label>
                                        <div id="lh_id<?= $chude['lh_id'] ?>" class="invalid-feedback">
                                            Bạn phải chọn loại hoa
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Them select Màu hoa-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Màu hoa</label>
                                <?php foreach ($dataMauHoa as $mauhoa) : ?>
                                    <div class="form-check">
                                        <?php if (is_numeric(array_search($mauhoa['mh_id'], $dataSanPhamMauHoa))) : ?>
                                            <input class="form-check-input" type="checkbox" value="<?= $mauhoa['mh_id'] ?>" id="mh_id<?= $mauhoa['mh_id'] ?>" name="mh_id[]" checked>
                                        <?php else : ?>
                                            <input class="form-check-input" type="checkbox" value="<?= $mauhoa['mh_id'] ?>" id="mh_id<?= $mauhoa['mh_id'] ?>" name="mh_id[]">
                                        <?php endif; ?>
                                        <label class="form-check-label" for="mh_id<?= $mauhoa['mh_id'] ?>">
                                            <?= $mauhoa['mh_ten'] ?>
                                        </label>
                                        <div id="mh_id<?= $chude['mh_id'] ?>" class="invalid-feedback">
                                            Bạn phải chọn màu hoa
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Them select Chủ đề -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Chủ đề</label>
                                <?php foreach ($dataChuDe as $chude) : ?>
                                    <div class="form-check">
                                        <?php if (is_numeric(array_search($chude['cd_id'], $dataSanPhamChuDe))) : ?>
                                            <input class="form-check-input" type="checkbox" value="<?= $chude['cd_id'] ?>" id="cd_id<?= $chude['cd_id'] ?>" name="cd_id[]" checked>
                                        <?php else : ?>
                                            <input class="form-check-input" type="checkbox" value="<?= $chude['cd_id'] ?>" id="cd_id<?= $chude['cd_id'] ?>" name="cd_id[]">
                                        <?php endif; ?>
                                        <label class="form-check-label" for="cd_id<?= $chude['cd_id'] ?>">
                                            <?= $chude['cd_ten'] ?>
                                        </label>
                                        <div id="cd_id<?= $chude['cd_id'] ?>" class="invalid-feedback">
                                            Bạn phải chọn chủ đề
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Them select cho khuyen mai -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="km_ma">Khuyến mãi</label>
                                <select class="form-control" id="km_id" name="km_id">
                                    <option value="">Không áp dụng khuyến mãi</option>
                                    <?php foreach ($dataKhuyenMai as $khuyenmai) : ?>
                                        <?php if ($khuyenmai['km_id'] == $dataSanPham['km']) : ?>
                                            <option value="<?= $khuyenmai['km_id'] ?>" selected><?= $khuyenmai['km_tomtat'] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $khuyenmai['km_id'] ?>"><?= $khuyenmai['km_tomtat'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row d-flex align-items-end">
                                <label for="sp_avt_tenfile" class="col-md-2">Ảnh sản phẩm</label>
                                <input type="file" name="sp_avt_tenfile" id="sp_avt_tenfile" class="form-control col-sm-10">
                                <div class="preview-img-container col-md-2">
                                <?php if(!file_exists('../../../assets/uploads/img-product/'.$dataSanPham['sp_avt_tenfile']) || empty($dataSanPham['sp_avt_tenfile'])): ?>
                                    <img src="/shophoa.vn/assets/shared/img/default.png" id="preview-img" class=" img-fluid" />
                                        <?php else: ?>
                                    <img src="/shophoa.vn/assets/uploads/img-product/<?= $dataSanPham['sp_avt_tenfile'] ?>" id="preview-img" class=" img-fluid" />
                                        <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-center mb-5">
                            <button class="btn btn-success" name="btnsave" id="btnsave">Cập nhật</button>
                        </div>
                </form>
                <?php
                if (isset($_POST['btnsave'])) {
                    $sp_ten = htmlentities($_POST['sp_ten']);
                    $sp_giacu = $_POST['sp_giacu'];
                    $sp_gia = $_POST['sp_gia'];
                    $sp_mota_ngan = htmlentities($_POST['sp_mota_ngan']);
                    $sp_mota_chitiet = htmlentities($_POST['sp_mota_chitiet']);
                    $lh_id = isset($_POST['lh_id']) ? $_POST['lh_id'] : '';
                    $mh_id = isset($_POST['mh_id']) ? $_POST['mh_id'] : '';
                    $cd_id = isset($_POST['cd_id']) ? $_POST['cd_id'] : '';
                    $km_id = $_POST['km_id'];
                    if (isset($_FILES['sp_avt_tenfile'])) {
                        $upload_dir = __DIR__ . "/../../../assets/uploads/";
                        $subdir = 'img-product/';
                        if ($_FILES['sp_avt_tenfile']['error'] > 0) {
                            $sp_avt_tenfile = $dataSanPham['sp_avt_tenfile'];
                        } else {
                            $old_file = $upload_dir . $subdir . $dataSanPham['sp_avt_tenfile'];
                            if (file_exists($old_file)) {
                                unlink($old_file);
                                $sqlXoaHinhSanPham = "DELETE FROM hinhsanpham WHERE hsp_tenfile = '{$dataSanPham['sp_avt_tenfile']}' AND sanpham_sp_id = {$sp_id};";
                                mysqli_query($conn, $sqlXoaHinhSanPham);
                            }
                            $tentaptin = date('YmdHis') . '_' . $_FILES['sp_avt_tenfile']['name'];
                            $sp_avt_tenfile = $tentaptin;
                            move_uploaded_file($_FILES['sp_avt_tenfile']['tmp_name'], $upload_dir . $subdir . $tentaptin);
                        }
                    } else {
                        $sp_avt_tenfile = $dataSanPham['sp_avt_tenfile'];
                    }
                    if (empty($sp_gia)) {
                        $sp_gia = $sp_giacu;
                        $sp_giacu = 0;
                    }
                    if (empty($km_id))
                        $km_id = "NULL";
                    $sqlThemSanPham = "UPDATE sanpham SET sp_ten=N'$sp_ten', sp_gia=$sp_gia, sp_giacu=$sp_giacu, sp_mota_ngan=N'$sp_mota_ngan', sp_mota_chitiet=N'$sp_mota_chitiet', sp_ngaycapnhat=NOW(), sp_avt_tenfile='$sp_avt_tenfile', km=$km_id WHERE sp_id = {$sp_id};";
                    mysqli_query($conn, $sqlThemSanPham);
                    if (!empty($lh_id)) {
                        foreach ($dataLoaiSanPham as $lh) {
                            $id = $lh['lh_id'];
                            $sqlXoa = "DELETE FROM sanpham_has_loaihoa WHERE sanpham_sp_id={$sp_id} AND loaihoa_lh_id={$id};";
                            mysqli_query($conn, $sqlXoa);
                        }
                        foreach ($lh_id as $id) {
                            $sqlThemLoaiHoa = "INSERT INTO sanpham_has_loaihoa (sanpham_sp_id, loaihoa_lh_id) VALUES ($sp_id, $id);";
                            mysqli_query($conn, $sqlThemLoaiHoa);
                        }
                    }
                    if (!empty($mh_id)) {
                        foreach ($dataMauHoa as $mh) {
                            $id = $mh['mh_id'];
                            $sqlXoa = "DELETE FROM sanpham_has_mauhoa WHERE sanpham_sp_id={$sp_id} AND mauhoa_mh_id={$id};";
                            mysqli_query($conn, $sqlXoa);
                        }
                        foreach ($mh_id as $id) {
                            $sqlThemMauHoa = "INSERT INTO sanpham_has_mauhoa (sanpham_sp_id, mauhoa_mh_id) VALUES ($sp_id, $id);";
                            mysqli_query($conn, $sqlThemMauHoa);
                        }
                    }
                    if (!empty($cd_id)) {
                        foreach ($dataChuDe as $cd) {
                            $id = $cd['cd_id'];
                            $sqlXoa = "DELETE FROM sanpham_has_chude WHERE sanpham_sp_id={$sp_id} AND chude_cd_id={$id};";
                            mysqli_query($conn, $sqlXoa);
                        }
                        foreach ($cd_id as $id) {
                            $sqlThemChuDe = "INSERT INTO sanpham_has_chude (sanpham_sp_id, chude_cd_id) VALUES ($sp_id, $id);";
                            mysqli_query($conn, $sqlThemChuDe);
                        }
                    }
                    $sqlThemSanPham = "INSERT INTO hinhsanpham (hsp_tenfile, sanpham_sp_id) VALUES ('$sp_avt_tenfile', $sp_id)";
                    mysqli_query($conn, $sqlThemSanPham);
                    echo '<script>location.href="edit.php?sp_id=' . $dataSanPham['sp_id'] . '"</script>';
                }
                ?>
            </main>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>
    <script src="/shophoa.vn/assets/vendor/ckeditor/ckeditor.js"></script>
    <script>
        const reader = new FileReader();
        const fileInput = document.getElementById("sp_avt_tenfile");
        const img = document.getElementById("preview-img");
        reader.onload = e => {
            img.src = e.target.result;
        }
        fileInput.addEventListener('change', e => {
            const f = e.target.files[0];
            reader.readAsDataURL(f);
        })
        $('#frmsanpham').validate({
            rules: {
                sp_ten: {
                    required: true,
                    minlength: 3,
                    maxlength: 100,
                },
                sp_giacu: {
                    required: true,
                    min: 0,
                },
                sp_mota_ngan: {
                    required: true,
                    maxlength: 300,
                },
                'lh_id[]': {
                    required: true,
                },
                'mh_id[]': {
                    required: true,
                },
                'cd_id[]': {
                    required: true,
                },
                // sp_avt_tenfile: {
                //     required: true,
                // },
            },
            messages: {
                sp_ten: {
                    required: 'Nhập tên bó hoa',
                    minlength: 'Tên bó hoa phải có tối thiểu 3 ký tự',
                    maxlength: 'Tên bó hoa phải có tối đa 100 ký tự',
                },
                sp_giacu: {
                    required: 'Nhập giá sản phẩm',
                    min: 'Giá sản phẩm phải lớn hơn 0',
                },
                sp_mota_ngan: {
                    required: 'Bạn phải nhập mô tả',
                    maxlength: 'Mô tả chỉ có tối đa 300 ký tự',
                },
                'lh_id[]': {
                    required: 'Bạn phải chọn loại hoa',
                },
                'mh_id[]': {
                    required: 'Bạn phải chọn màu hoa',
                },
                'cd_id[]': {
                    required: 'Bạn phải chọn chủ đề',
                },
            },
            errorElement: "em",
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.parent("label"));
                } else {
                    error.insertAfter(element);
                }
            },
            success: function(label, element) {},
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        });
        CKEDITOR.replace('sp_mota_chitiet');
    </script>
</body>

</html>