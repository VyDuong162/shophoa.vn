<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../dbconnect.php');
$search = $_GET['search'];
$sql = "SELECT sp.sp_id, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_avt_tenfile, hsp.hsp_tenfile AS hsp_tenfile, AVG(bl.bl_sao) AS sao FROM sanpham AS sp LEFT JOIN hinhsanpham AS hsp ON hsp.sanpham_sp_id = sp.sp_id LEFT JOIN binhluan AS bl ON sp.sp_id = bl.sanpham_sp_id WHERE sp.sp_ten LIKE '%{$search}%' GROUP BY sp.sp_id;";
$result = mysqli_query($conn, $sql);
$data = [];
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $data[] = array(
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
<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Hoa | Đăng ký</title>
    <link rel="stylesheet" href="style.css">
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
    </style>
</head>

<body>
    <!-- Phần loading trang web -->
    <div id="load">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>
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
                            <img src="/shophoa.vn/assets/shared/img-km/km3.jpg" class="d-block w-100" alt="">
                            <div class="carousel-caption d-none d-md-block">
                                <h1 class="text-shadow">Chào mừng đến với SHOPHOA</h1>
                            </div>
                        </div>
                        <?php foreach ($dataKhuyenMai as $km) : ?>
                            <div class="carousel-item">
                                <img src="/shophoa.vn/assets/shared/img-km/<?= $km['km_anh'] ?>" class="d-block w-100" alt="<?= $km['km_ten'] ?>">
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
    <div class="container"><?php if (count($data) == 0) : ?>
            <h5 class="text-center p-5">Không có sản phẩm.</h5>
        <?php else : ?>
            <div class="row row-cols-lg-4 row-cols-sm-3 row-cols-1">

                <?php foreach ($data as $sp) : ?>
                    <div class="col py-3">
                        <div class="card my-card">
                            <a href="/shophoa.vn/frontend/sanpham/chitiet.php?sp_id=<?= $sp['sp_id'] ?>">
                                <div class="my-box-card-img">
                                    <!-- Ảnh đại diện -->
                                    <?php if (!file_exists('../../assets/uploads/img-product/' . $sp['sp_avt_tenfile'])) : ?>
                                        <img src="/shophoa.vn/assets/shared/img/default.png" alt="<?= $sp['sp_ten'] ?>" class="card-img-top my-card-img img-show">
                                    <?php else : ?>
                                        <img src="/shophoa.vn/assets/uploads/img-product/<?= $sp['sp_avt_tenfile'] ?>" alt="<?= $sp['sp_ten'] ?>" class="card-img-top my-card-img img-show">
                                    <?php endif; ?>
                                    <!-- Ảnh thứ 2 -->
                                    <?php if (!file_exists('../../assets/uploads/img-product/' . $sp['hsp_tenfile']) || empty($sp['hsp_tenfile'])) : ?>
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
        <?php endif; ?>
    </div>
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
</body>

</html>