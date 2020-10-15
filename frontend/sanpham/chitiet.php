<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../dbconnect.php');
$sp_id = $_GET['sp_id'];
$sqlSelectSanPham = "SELECT * FROM sanpham WHERE sp_id = {$sp_id};";
$resultSelectSanPham = mysqli_query($conn, $sqlSelectSanPham);
$dataSanPham;
while ($row = mysqli_fetch_array($resultSelectSanPham, MYSQLI_ASSOC)) {
    $dataSanPham = array(
        'sp_id' => $row['sp_id'],
        'sp_ten' => $row['sp_ten'],
        'sp_gia' => $row['sp_gia'],
        'sp_giacu' => $row['sp_giacu'],
        'sp_gia_formated' => number_format($row['sp_gia'], 0, ".", ","),
        'sp_giacu_formated' => number_format($row['sp_giacu'], 0, ".", ","),
        'sp_mota_ngan' => $row['sp_mota_ngan'],
        'sp_mota_chitiet' => $row['sp_mota_chitiet'],
        'sp_yeuthich' => $row['sp_yeuthich'],
        'sp_avt_tenfile' => $row['sp_avt_tenfile'],
        'sp_trangthai' => $row['sp_trangthai'],
    );
}
$sqlHinhSanPham = "SELECT * FROM hinhsanpham WHERE sanpham_sp_id = {$sp_id};";
$resultHinhSanPham = mysqli_query($conn, $sqlHinhSanPham);
$dataHinhSanPham = [];
while ($row = mysqli_fetch_array($resultHinhSanPham, MYSQLI_ASSOC)) {
    $dataHinhSanPham[] = array(
        'hasp_id' => $row['hasp_id'],
        'hsp_tenfile' => $row['hsp_tenfile'],
    );
}
$sanphamRow['danhsachhinhanh'] = $dataHinhSanPham;
$sqlDanhGiaSanPham = "SELECT a.kh_bl_noidung, a.kh_bl_ngay, a.bl_sao, b.kh_hoten FROM binhluan AS a, khachhang AS b WHERE a.khachhang_kh_id = b.kh_id AND a.sanpham_sp_id = {$sp_id} ORDER BY a.kh_bl_ngay DESC;";
$resultDanhGiaSanPham = mysqli_query($conn, $sqlDanhGiaSanPham);
$dataDanhGiaSanPham = [];
$tong = 0;
$soluong = 0;
while ($row = mysqli_fetch_array($resultDanhGiaSanPham, MYSQLI_ASSOC)) {
    $tong += $row['bl_sao'];
    $soluong++;
    $dataDanhGiaSanPham[] = array(
        'kh_bl_noidung' => $row['kh_bl_noidung'],
        'kh_bl_ngay' => $row['kh_bl_ngay'],
        'bl_sao' => $row['bl_sao'],
        'kh_hoten' => $row['kh_hoten'],
    );
}
if ($soluong != 0)
    $trungBinhDanhGia = $tong / $soluong;
else
    $trungBinhDanhGia = 0;
?>
<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Hoa | <?=$dataSanPham['sp_ten']?></title>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
    <link rel="stylesheet" href="/shophoa.vn/assets/vendor/fancybox/jquery.fancybox.min.css">
</head>

<body>
    <!-- Phần loading trang web -->
    <div id="load">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>
    <!-- Phần nội dung trang web -->
    <div class="container my-5">
        <div class="row">
            <!-- Phần ảnh sản phẩm -->
            <div class="col-md-6">
                <div class="row">
                    <?php if (!file_exists('../../assets/shared/img-product/' . $dataSanPham['sp_avt_tenfile'])) : ?>
                        <div class="col-md-9 text-center" id="anh_dai_dien">
                            <a data-fancybox="gallery" href="/shophoa.vn/assets/shared/img/default.png" data-caption="<?= $dataSanPham['sp_ten'] ?>">
                                <img src="/shophoa.vn/assets/shared/img/default.png" alt="<?= $dataSanPham['sp_ten'] ?>" class="img-fluid my-1">
                            </a>
                        </div>
                    <?php else : ?>
                        <div class="col-md-9 text-center" id="anh_dai_dien">
                            <a data-fancybox="gallery" href="/shophoa.vn/assets/shared/img-product/<?= $dataSanPham['sp_avt_tenfile'] ?>" data-caption="<?= $dataSanPham['sp_ten'] ?>">
                                <img src="/shophoa.vn/assets/shared/img-product/<?= $dataSanPham['sp_avt_tenfile'] ?>" alt="<?= $dataSanPham['sp_ten'] ?>" class="img-fluid my-1">
                            </a>
                        </div>
                        <div class="col-md-3 order-md-first" id="anh_nho">
                            <div class="row row-cols-md-1 row-cols-sm-3">
                                <?php foreach ($dataHinhSanPham as $anh) : ?>
                                    <div class="col anh" data-anhnho="/shophoa.vn/assets/shared/img-product/<?= $anh['hsp_tenfile'] ?>">
                                        <img src="/shophoa.vn/assets/shared/img-product/<?= $anh['hsp_tenfile'] ?>" alt="<?= $dataSanPham['sp_ten'] ?>" class="img-fluid my-1">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- End phần ảnh sản phẩm -->
            <div class="col-md-6">
                <h3 class="myfont"><?= $dataSanPham['sp_ten'] ?></h3>
                <p>
                    <small class="text-secondary">Mã sản phẩm : <?= $dataSanPham['sp_id'] ?></small> <br>
                    <?php if ($dataSanPham['sp_trangthai'] == 1) : ?>
                        <small class="text-secondary">Trạng thái : Còn hàng</small> <br>
                    <?php else : ?>
                        <small class="text-secondary">Trạng thái : Không còn bán</small> <br>
                    <?php endif; ?>
                </p>
                <h4>
                    <?php if ($dataSanPham['sp_giacu'] != 0) : ?>
                        <span class="text-secondary"><s><?= $dataSanPham['sp_giacu_formated'] ?></s></span>
                    <?php endif; ?>
                    <span class="text-danger"><?= $dataSanPham['sp_gia_formated'] ?> VNĐ</span>
                </h4>
                <hr>
                <h3 class="myfont">Tùy chọn</h3>
                <form action="" method="post" name="frm_muahang" id="frm_muahang">
                    <input type="hidden" name="sp_id" id="sp_id" value="<?= $dataSanPham['sp_id'] ?>">
                    <input type="hidden" name="sp_ten" id="sp_ten" value="<?= $dataSanPham['sp_ten'] ?>">
                    <input type="hidden" name="sp_gia" id="sp_gia" value="<?= $dataSanPham['sp_gia'] ?>">
                    <input type="hidden" name="sp_avt_tenfile" id="sp_avt_tenfile" value="<?= $dataSanPham['sp_avt_tenfile'] ?>">
                    <div class="form-group row">
                        <label for="num" class="col-form-label col-lg-4 col-md-5">Số lượng : </label>
                        <input type="number" name="soluong" id="soluong" min=1 value=1 class="col-lg-8 col-md-7 form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn myfont text-danger btn-add" name="btn_mua" id="btn_mua">Thêm vào giỏ hàng</button>
                    </div>
                    <h5 class="text-danger">
                        <?php for ($i = 1; $i <= floor($trungBinhDanhGia); $i++) : ?>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        <?php endfor; ?>
                        <?php for ($i = 1; $i <= ceil($trungBinhDanhGia) - floor($trungBinhDanhGia); $i++) : ?>
                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                        <?php endfor; ?>
                        <?php for ($i = 1; $i <= 5 - ceil($trungBinhDanhGia); $i++) : ?>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        <?php endfor; ?>
                    </h5>
                    <div class="form-group">
                        <b><?= $soluong ?> đánh giá</b>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active tab" id="mo_ta-tab" data-toggle="pill" href="#mo_ta" role="tab" aria-controls="mo_ta" aria-selected="true">Mô tả sản phẩm</a>
                            <a class="nav-link tab" id="chi_tiet-tab" data-toggle="pill" href="#chi_tiet" role="tab" aria-controls="chi_tiet" aria-selected="false">Chi tiết</a>
                            <a class="nav-link tab" id="nhan_xet-tab" data-toggle="pill" href="#nhan_xet" role="tab" aria-controls="nhan_xet" aria-selected="false">Đánh giá <span class="badge badge-pill badge-danger"><?= $soluong ?></span></a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="mo_ta" role="tabpanel" aria-labelledby="mo_ta-tab">
                                <?= $dataSanPham['sp_mota_ngan'] ?>
                            </div>
                            <div class="tab-pane fade" id="chi_tiet" role="tabpanel" aria-labelledby="chi_tiet-tab"><?= $dataSanPham['sp_mota_chitiet'] ?></div>
                            <div class="tab-pane fade" id="nhan_xet" role="tabpanel" aria-labelledby="nhan_xet-tab">
                                <?php if ($soluong == 0) : ?>
                                    Chưa có đánh giá
                                <?php else : ?>
                                    <?php foreach ($dataDanhGiaSanPham as $bl) : ?>
                                        <h6 class="text-danger"><?= $bl['kh_hoten'] ?>
                                            <small>
                                                <?php for ($i = 1; $i <= floor($bl['bl_sao']); $i++) : ?>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                <?php endfor; ?>
                                                <?php for ($i = 1; $i <= ceil($bl['bl_sao']) - floor($bl['bl_sao']); $i++) : ?>
                                                    <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                <?php endfor; ?>
                                                <?php for ($i = 1; $i <= 5 - ceil($bl['bl_sao']); $i++) : ?>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                <?php endfor; ?>
                                            </small>
                                        </h6>
                                        <small><?= $bl['kh_bl_ngay'] ?></small>
                                        <p><?= $bl['kh_bl_noidung'] ?></p>
                                        <hr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <h3 class="text-danger myfont">Sản phẩm liên quan</h3>
                <div class="row row-cols-md-4 row-cols-2">
                    <div class="col py-3">
                        <div class="card my-card">
                            <a href="chitiet.php">
                                <div class="my-box-card-img">
                                    <img src="/templatedoan/imgs/BoHoaCrystalPearlonweb_1024x1024@2x.jpg" alt="" class="card-img-top my-card-img img-show">
                                    <img src="/templatedoan/imgs/BoHoaCrystalPearl_d764aec2-22bb-4758-a90f-a5ade95d798c_1024x1024@2x.jpg" alt="" class="card-img-top my-card-img img-hide">
                                    <div class="text-danger danh_gia">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </a>
                            <div class="card-body px-0">
                                <a href="chitiet.php" class="card-title my-card-title font-weight-bold">
                                    Bó hoa Crystal Pearl
                                </a>
                                <h5 class="my-3">
                                    <span class="text-secondary"><s>150,000 VNĐ</s></span> <span class="text-danger">130,000 VNĐ</span>
                                </h5>
                                <button class="btn myfont text-danger btn-add">Thêm vào giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                    <div class="col py-3">
                        <div class="card my-card">
                            <a href="chitiet.php">
                                <div class="my-box-card-img">
                                    <img src="/templatedoan/imgs/BoHoaCrystalPearlonweb_1024x1024@2x.jpg" alt="" class="card-img-top my-card-img img-show">
                                    <img src="/templatedoan/imgs/BoHoaCrystalPearl_d764aec2-22bb-4758-a90f-a5ade95d798c_1024x1024@2x.jpg" alt="" class="card-img-top my-card-img img-hide">
                                    <div class="text-danger danh_gia">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </a>
                            <div class="card-body px-0">
                                <a href="chitiet.php" class="card-title my-card-title font-weight-bold">
                                    Bó hoa Crystal Pearl
                                </a>
                                <h5 class="my-3">
                                    <span class="text-secondary"><s>150,000 VNĐ</s></span> <span class="text-danger">130,000 VNĐ</span>
                                </h5>
                                <button class="btn myfont text-danger btn-add">Thêm vào giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                    <div class="col py-3">
                        <div class="card my-card">
                            <a href="chitiet.php">
                                <div class="my-box-card-img">
                                    <img src="/templatedoan/imgs/BoHoaCrystalPearlonweb_1024x1024@2x.jpg" alt="" class="card-img-top my-card-img img-show">
                                    <img src="/templatedoan/imgs/BoHoaCrystalPearl_d764aec2-22bb-4758-a90f-a5ade95d798c_1024x1024@2x.jpg" alt="" class="card-img-top my-card-img img-hide">
                                    <div class="text-danger danh_gia">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </a>
                            <div class="card-body px-0">
                                <a href="chitiet.php" class="card-title my-card-title font-weight-bold">
                                    Bó hoa Crystal Pearl
                                </a>
                                <h5 class="my-3">
                                    <span class="text-secondary"><s>150,000 VNĐ</s></span> <span class="text-danger">130,000 VNĐ</span>
                                </h5>
                                <button class="btn myfont text-danger btn-add">Thêm vào giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                    <div class="col py-3">
                        <div class="card my-card">
                            <a href="chitiet.php">
                                <div class="my-box-card-img">
                                    <img src="/templatedoan/imgs/BoHoaCrystalPearlonweb_1024x1024@2x.jpg" alt="" class="card-img-top my-card-img img-show">
                                    <img src="/templatedoan/imgs/BoHoaCrystalPearl_d764aec2-22bb-4758-a90f-a5ade95d798c_1024x1024@2x.jpg" alt="" class="card-img-top my-card-img img-hide">
                                    <div class="text-danger danh_gia">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </a>
                            <div class="card-body px-0">
                                <a href="chitiet.php" class="card-title my-card-title font-weight-bold">
                                    Bó hoa Crystal Pearl
                                </a>
                                <h5 class="my-3">
                                    <span class="text-secondary"><s>150,000 VNĐ</s></span> <span class="text-danger">130,000 VNĐ</span>
                                </h5>
                                <button class="btn myfont text-danger btn-add">Thêm vào giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End phần nội dung trang web -->
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>

    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
    <script src="/shophoa.vn/assets/vendor/fancybox/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#anh_nho a').fancybox();
            $('#anh_dai_dien a').fancybox();
            $('.anh').click(function() {
                var t = document.getElementById('anh_dai_dien');
                var a1 = $(this).data('anhnho');
                t.innerHTML = '<a data-fancybox="gallery" href="' + a1 + '" data-caption="<?= $dataSanPham['sp_ten'] ?>"><img src="' + a1 + '" alt="" class="img-fluid img-background my-1"></a>'
            });

            $('#btn_mua').click(function(event) {
                event.preventDefault();
                var dulieugui = {
                    sp_id: $('#sp_id').val(),
                    sp_ten: $('#sp_ten').val(),
                    sp_gia: $('#sp_gia').val(),
                    sp_avt_tenfile: $('#sp_avt_tenfile').val(),
                    soluong: $('#soluong').val(),
                }
                $.ajax({
                    url: '/shophoa.vn/frontend/api/giohang_themsanpham.php',
                    method: 'post',
                    dataType: 'json',
                    data: dulieugui,
                    success: function(data){
                        console.log(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        console.log(textStatus, errorThrown);
                    }
                });
            });
        });
    </script>
</body>

</html>