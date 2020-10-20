<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../dbconnect.php');
?>
<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Hoa</title>
    <?php include_once(__DIR__ . '/layouts/styles.php'); ?>
</head>

<body>
    <!-- Phần loading trang web -->
    <div id="load">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <?php include_once(__DIR__ . '/layouts/partials/header.php'); ?>
    <!-- Phần nội dung trang web -->
    <!-- Phần Carouse -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-0 m-0">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <?php
                    $sqlKhuyenMai = "SELECT * FROM khuyenmai WHERE km_denngay >= NOW();";
                    $resultKhuyenMai = mysqli_query($conn, $sqlKhuyenMai);
                    $dataKhuyenMai = [];
                    $i = 1;
                    while ($row = mysqli_fetch_array($resultKhuyenMai, MYSQLI_ASSOC)) {
                        $dataKhuyenMai[] = array(
                            'km_index' => $i++,
                            'km_id' => $row['km_id'],
                            'km_ten' => $row['km_ten'],
                            'km_noidung' => $row['km_noidung'],
                            'km_tungay' => $row['km_tungay'],
                            'km_denngay' => $row['km_denngay'],
                            'km_anh' => $row['km_anh'],
                        );
                    }
                    ?>
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <?php foreach ($dataKhuyenMai as $km) : ?>
                            <li data-target="#carouselExampleCaptions" data-slide-to="<?= $km['km_index'] ?>"></li>
                        <?php endforeach; ?>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/shophoa.vn/assets/uploads/img-km/wellcome.jpg" class="d-block w-100" alt="Shop hoa">
                            <div class="carousel-caption d-none d-md-block">
                                <h1 class="text-shadow">Chào mừng đến với SHOPHOA</h1>
                            </div>
                        </div>
                        <?php foreach ($dataKhuyenMai as $km) : ?>
                            <div class="carousel-item">
                                <?php if (file_exists('../assets/uploads/img-km/' . $km['km_anh'])) : ?>
                                    <img src="/shophoa.vn/assets/uploads/img-km/<?= $km['km_anh'] ?>" class="d-block w-100"alt="<?= $km['km_ten'] ?>">
                                <?php else : ?>
                                    <img src="/shophoa.vn/assets/uploads/img-km/default-image.jpg" class="d-block w-100"alt="<?= $km['km_ten'] ?>">
                                <?php endif; ?>
                                <div class="carousel-caption d-none d-md-block">
                                    <a class="text-white" href="/shophoa.vn/frontend/pages/sukien.php?km_id=<?= $km['km_id'] ?>">
                                        <h1 class="text-shadow"><?= $km['km_ten'] ?></h1>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End phần Carouse -->
    <!-- Phần sản phẩm -->
    <div class="container">
        <div class="row">
            <!-- Sản phẩm mới -->
            <div class="col-md-12">
                <?php
                $sqlDanhSachSanPhamMoi = " SELECT sp.sp_id, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_avt_tenfile, hsp.hsp_tenfile AS hsp_tenfile,AVG(bl.bl_sao) AS sao FROM sanpham AS sp LEFT JOIN hinhsanpham AS hsp ON sp.sp_id = hsp.sanpham_sp_id LEFT JOIN binhluan AS bl ON sp.sp_id = bl.sanpham_sp_id GROUP BY sp.sp_id ORDER BY sp.sp_ngaycapnhat DESC LIMIT 0, 4;";
                $resultDanhSachSanPhamMoi = mysqli_query($conn, $sqlDanhSachSanPhamMoi);
                $dataDanhSachSanPhamMoi = [];
                while ($row = mysqli_fetch_array($resultDanhSachSanPhamMoi, MYSQLI_ASSOC)) {
                    $dataDanhSachSanPhamMoi[] = array(
                        'sp_id' => $row['sp_id'],
                        'sp_ten' => $row['sp_ten'],
                        'sp_gia' => number_format($row['sp_gia'], 0, ".", ","),
                        'sp_giacu' => number_format($row['sp_giacu'], 0, ".", ","),
                        'sp_avt_tenfile' => $row['sp_avt_tenfile'],
                        'hsp_tenfile' => $row['hsp_tenfile'],
                        'sao' => $row['sao'] > 0 ? $row['sao'] : 0,
                    );
                }
                ?>
                <h3 class="myfont mt-3 text-center"><a href="/shophoa.vn/frontend/pages/phanloai.php?type=moi" class="text-danger">Sản phẩm mới</a></h3>
                <div class="row row-cols-lg-4 row-cols-sm-3 row-cols-1">
                    <?php foreach ($dataDanhSachSanPhamMoi as $sp) : ?>
                        <div class="col py-3">
                            <div class="card my-card">
                                <a href="/shophoa.vn/frontend/sanpham/chitiet.php?sp_id=<?= $sp['sp_id'] ?>">
                                    <div class="my-box-card-img">
                                        <!-- Ảnh đại diện -->
                                        <?php if (!file_exists('../assets/uploads/img-product/' . $sp['sp_avt_tenfile'])) : ?>
                                            <img src="/shophoa.vn/assets/shared/img/default.png" alt="<?= $sp['sp_ten'] ?>" class="card-img-top my-card-img img-show">
                                        <?php else : ?>
                                            <img src="/shophoa.vn/assets/uploads/img-product/<?= $sp['sp_avt_tenfile'] ?>" alt="<?= $sp['sp_ten'] ?>" class="card-img-top my-card-img img-show">
                                        <?php endif; ?>
                                        <!-- Ảnh thứ 2 -->
                                        <?php if (!file_exists('../assets/uploads/img-product/' . $sp['hsp_tenfile']) || empty($sp['hsp_tenfile'])) : ?>
                                            <img src="/shophoa.vn/assets/shared/img/default.png" alt="<?= $sp['sp_ten'] ?>" class="card-img-top my-card-img img-hide">
                                        <?php else : ?>
                                            <img src="/shophoa.vn/assets/uploads/img-product/<?= $sp['hsp_tenfile'] ?>" alt="<?= $sp['sp_ten'] ?>" class="card-img-top my-card-img img-hide">
                                        <?php endif; ?>
                                        <div class="text-danger danh_gia">
                                            <?php for ($i = 1; $i <= floor($sp['sao']); $i++) : ?>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            <?php endfor; ?>
                                            <?php for ($i = 1; $i <= ceil($sp['sao']) - floor($sp['sao']); $i++) : ?>
                                                <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                            <?php endfor; ?>
                                            <?php for ($i = 1; $i <= 5 - ceil($sp['sao']); $i++) : ?>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                </a>
                                <div class="card-body px-0">
                                    <a href="/shophoa.vn/frontend/sanpham/chitiet.php?sp_id=<?= $sp['sp_id'] ?>" class="card-title my-card-title font-weight-bold">
                                        <?= $sp['sp_ten'] ?>
                                    </a>
                                    <h5 class="my-3">
                                        <?php if ($sp['sp_giacu'] != "0") : ?>
                                            <span class="text-secondary"><s><?= $sp['sp_giacu'] ?></s>
                                            <?php endif; ?>
                                            </span> <span class="text-danger"><?= $sp['sp_gia'] ?> đ</span>
                                    </h5>
                                    <a href="/shophoa.vn/frontend/sanpham/chitiet.php?sp_id=<?= $sp['sp_id'] ?>" class="btn myfont text-danger btn-add btn-mua">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- End sản phẩm mới -->
            <!-- Sản phẩm yêu thích -->
            <div class="col-md-12">
                <?php
                $sqlDanhSachSanPhamYeuThich = "SELECT sp.sp_id, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_avt_tenfile, hsp.hsp_tenfile AS hsp_tenfile,AVG(bl.bl_sao) AS sao FROM sanpham AS sp LEFT JOIN hinhsanpham AS hsp ON sp.sp_id = hsp.sanpham_sp_id LEFT JOIN binhluan AS bl ON sp.sp_id = bl.sanpham_sp_id GROUP BY sp.sp_id ORDER BY sp.sp_yeuthich DESC LIMIT 0, 4;";
                $resultDanhSachSanPhamYeuThich = mysqli_query($conn, $sqlDanhSachSanPhamYeuThich);
                $dataDanhSachSanPhamYeuThich = [];
                while ($row = mysqli_fetch_array($resultDanhSachSanPhamYeuThich, MYSQLI_ASSOC)) {
                    $dataDanhSachSanPhamYeuThich[] = array(
                        'sp_id' => $row['sp_id'],
                        'sp_ten' => $row['sp_ten'],
                        'sp_gia' => number_format($row['sp_gia'], 0, ".", ","),
                        'sp_giacu' => number_format($row['sp_giacu'], 0, ".", ","),
                        'sp_avt_tenfile' => $row['sp_avt_tenfile'],
                        'hsp_tenfile' => $row['hsp_tenfile'],
                        'sao' => $row['sao'] > 0 ? $row['sao'] : 0,
                    );
                }
                ?>
                <h3 class="myfont mt-3 text-center"><a href="/shophoa.vn/frontend/pages/phanloai.php?type=yeuthich" class="text-danger">Sản phẩm yêu thích</a></h3>
                <div class="row row-cols-lg-4 row-cols-sm-3 row-cols-1">
                    <?php foreach ($dataDanhSachSanPhamYeuThich as $sp) : ?>
                        <div class="col py-3">
                            <div class="card my-card">
                                <a href="/shophoa.vn/frontend/sanpham/chitiet.php?sp_id=<?= $sp['sp_id'] ?>">
                                    <div class="my-box-card-img">
                                        <!-- Ảnh đại diện -->
                                        <?php if (!file_exists('../assets/uploads/img-product/' . $sp['sp_avt_tenfile'])) : ?>
                                            <img src="/shophoa.vn/assets/shared/img/default.png" alt="<?= $sp['sp_ten'] ?>" class="card-img-top my-card-img img-show">
                                        <?php else : ?>
                                            <img src="/shophoa.vn/assets/uploads/img-product/<?= $sp['sp_avt_tenfile'] ?>" alt="<?= $sp['sp_ten'] ?>" class="card-img-top my-card-img img-show">
                                        <?php endif; ?>
                                        <!-- Ảnh thứ 2 -->
                                        <?php if (!file_exists('../assets/uploads/img-product/' . $sp['hsp_tenfile']) || empty($sp['hsp_tenfile'])) : ?>
                                            <img src="/shophoa.vn/assets/shared/img/default.png" alt="<?= $sp['sp_ten'] ?>" class="card-img-top my-card-img img-hide">
                                        <?php else : ?>
                                            <img src="/shophoa.vn/assets/uploads/img-product/<?= $sp['hsp_tenfile'] ?>" alt="<?= $sp['sp_ten'] ?>" class="card-img-top my-card-img img-hide">
                                        <?php endif; ?>
                                        <div class="text-danger danh_gia">
                                            <?php for ($i = 1; $i <= floor($sp['sao']); $i++) : ?>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            <?php endfor; ?>
                                            <?php for ($i = 1; $i <= ceil($sp['sao']) - floor($sp['sao']); $i++) : ?>
                                                <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                            <?php endfor; ?>
                                            <?php for ($i = 1; $i <= 5 - ceil($sp['sao']); $i++) : ?>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                </a>
                                <div class="card-body px-0">
                                    <a href="/shophoa.vn/frontend/sanpham/chitiet.php?sp_id=<?= $sp['sp_id'] ?>" class="card-title my-card-title font-weight-bold">
                                        <?= $sp['sp_ten'] ?>
                                    </a>
                                    <h5 class="my-3">
                                        <?php if ($sp['sp_giacu'] != "0") : ?>
                                            <span class="text-secondary"><s><?= $sp['sp_giacu'] ?></s>
                                            <?php endif; ?>
                                            </span> <span class="text-danger"><?= $sp['sp_gia'] ?> đ</span>
                                    </h5>
                                    <a href="/shophoa.vn/frontend/sanpham/chitiet.php?sp_id=<?= $sp['sp_id'] ?>" class="btn myfont text-danger btn-add btn-mua">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- End sản phẩm yêu thích -->
            <!-- Sản phẩm giảm giá -->
            <div class="col-md-12">
                <?php
                $sqlDanhSachSanPhamGiamGia = " SELECT sp.sp_id, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_avt_tenfile, hsp.hsp_tenfile AS hsp_tenfile,AVG(bl.bl_sao) AS sao FROM sanpham AS sp LEFT JOIN hinhsanpham AS hsp ON sp.sp_id = hsp.sanpham_sp_id LEFT JOIN binhluan AS bl ON sp.sp_id = bl.sanpham_sp_id WHERE sp.sp_giacu > 0 GROUP BY sp.sp_id ORDER BY (sp.sp_giacu - sp.sp_gia) DESC LIMIT 0,4;";
                $resultDanhSachSanPhamGiamGia = mysqli_query($conn, $sqlDanhSachSanPhamGiamGia);
                $dataDanhSachSanPhamGiamGia = [];
                while ($row = mysqli_fetch_array($resultDanhSachSanPhamGiamGia, MYSQLI_ASSOC)) {
                    $dataDanhSachSanPhamGiamGia[] = array(
                        'sp_id' => $row['sp_id'],
                        'sp_ten' => $row['sp_ten'],
                        'sp_gia' => number_format($row['sp_gia'], 0, ".", ","),
                        'sp_gia_nf' => $row['sp_gia'],
                        'sp_giacu' => number_format($row['sp_giacu'], 0, ".", ","),
                        'sp_avt_tenfile' => $row['sp_avt_tenfile'],
                        'hsp_tenfile' => $row['hsp_tenfile'],
                        'sao' => $row['sao'] > 0 ? $row['sao'] : 0,
                    );
                }
                ?>
                <h3 class="myfont mt-3 text-center"><a href="/shophoa.vn/frontend/pages/phanloai.php?type=giamgia" class="text-danger">Sản phẩm giảm giá</a></h3>
                <div class="row row-cols-lg-4 row-cols-sm-3 row-cols-1">
                    <?php foreach ($dataDanhSachSanPhamGiamGia as $sp) : ?>
                        <div class="col py-3">
                            <div class="card my-card">
                                <a href="/shophoa.vn/frontend/sanpham/chitiet.php?sp_id=<?= $sp['sp_id'] ?>">
                                    <div class="my-box-card-img">
                                        <!-- Ảnh đại diện -->
                                        <?php if (!file_exists('../assets/uploads/img-product/' . $sp['sp_avt_tenfile'])) : ?>
                                            <img src="/shophoa.vn/assets/shared/img/default.png" alt="<?= $sp['sp_ten'] ?>" class="card-img-top my-card-img img-show">
                                        <?php else : ?>
                                            <img src="/shophoa.vn/assets/uploads/img-product/<?= $sp['sp_avt_tenfile'] ?>" alt="<?= $sp['sp_ten'] ?>" class="card-img-top my-card-img img-show">
                                        <?php endif; ?>
                                        <!-- Ảnh thứ 2 -->
                                        <?php if (!file_exists('../assets/uploads/img-product/' . $sp['hsp_tenfile']) || empty($sp['hsp_tenfile'])) : ?>
                                            <img src="/shophoa.vn/assets/shared/img/default.png" alt="<?= $sp['sp_ten'] ?>" class="card-img-top my-card-img img-hide">
                                        <?php else : ?>
                                            <img src="/shophoa.vn/assets/uploads/img-product/<?= $sp['hsp_tenfile'] ?>" alt="<?= $sp['sp_ten'] ?>" class="card-img-top my-card-img img-hide">
                                        <?php endif; ?>
                                        <div class="text-danger danh_gia">
                                            <?php for ($i = 1; $i <= floor($sp['sao']); $i++) : ?>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            <?php endfor; ?>
                                            <?php for ($i = 1; $i <= ceil($sp['sao']) - floor($sp['sao']); $i++) : ?>
                                                <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                            <?php endfor; ?>
                                            <?php for ($i = 1; $i <= 5 - ceil($sp['sao']); $i++) : ?>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                </a>
                                <div class="card-body px-0">
                                    <a href="/shophoa.vn/frontend/sanpham/chitiet.php?sp_id=<?= $sp['sp_id'] ?>" class="card-title my-card-title font-weight-bold">
                                        <?= $sp['sp_ten'] ?>
                                    </a>
                                    <h5 class="my-3">
                                        <?php if ($sp['sp_giacu'] != "0") : ?>
                                            <span class="text-secondary"><s><?= $sp['sp_giacu'] ?></s>
                                            <?php endif; ?>
                                            </span> <span class="text-danger"><?= $sp['sp_gia'] ?> đ</span>
                                    </h5>
                                    <a href="/shophoa.vn/frontend/sanpham/chitiet.php?sp_id=<?= $sp['sp_id'] ?>" class="btn myfont text-danger btn-add btn-mua">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- End sản phẩm giảm giá -->
        </div>
    </div>
    <!-- End phần sản phẩm -->
    <!-- End phần nội dung trang web -->
    <?php include_once(__DIR__ . '/layouts/partials/footer.php'); ?>

    <?php include_once(__DIR__ . '/layouts/scripts.php'); ?>
</body>

</html>