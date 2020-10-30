<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../dbconnect.php');
$km_id = $_GET['km_id'];
$sqlKhuyenMai = "SELECT * FROM khuyenmai WHERE km_id = {$km_id};";
$resultKhuyenMai = mysqli_query($conn, $sqlKhuyenMai);
$dataKhuyenMai = [];
while ($row = mysqli_fetch_array($resultKhuyenMai, MYSQLI_ASSOC)) {
    $dataKhuyenMai = array(
        'km_id' => $row['km_id'],
        'km_ten' => $row['km_ten'],
        'km_noidung' => html_entity_decode($row['km_noidung']),
        'km_tungay' => date('d/m/Y',strtotime($row['km_tungay'])),
        'km_denngay' => date('d/m/Y',strtotime($row['km_denngay'])),
        'km_anh' => $row['km_anh'],
    );
}
?>
<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Hoa | Khuyến mãi</title>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
</head>

<body>
    <!-- Phần loading trang web -->
    <div id="load">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>
    <!-- Phần banner sự kiện -->
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12">
                <?php if (file_exists('../../assets/uploads/img-km/' . $dataKhuyenMai['km_anh'])) : ?>
                    <img src="/shophoa.vn/assets/uploads/img-km/<?= $dataKhuyenMai['km_anh'] ?>" class="d-block w-100" height="500px" alt="<?= $km['km_ten'] ?>">
                <?php else : ?>
                    <img src="/shophoa.vn/assets/shared/img/default.png" class="d-block w-100" height="500px" alt="<?= $dataKhuyenMai['km_ten'] ?>">
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- End phần banner sự kiện -->
    <!-- Phần nội dung trang web -->
    <div class="container my-3">
        <div class="row">
            <div class="col-md-12">
                <h3 class="myfont text-danger text-center">Sự kiện <?= $dataKhuyenMai['km_ten'] ?></h3>
                <h5 class="text-center">(<?= $dataKhuyenMai['km_tungay'] ?> - <?= $dataKhuyenMai['km_denngay'] ?>)</h5>
                <p><?= $dataKhuyenMai['km_noidung'] ?></p>
            </div>
            <div class="col-md-12">
                <?php
                $sqlDanhSachSanPham = " SELECT sp.sp_id, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_avt_tenfile, hsp.hsp_tenfile AS hsp_tenfile,AVG(bl.bl_sao) AS sao FROM sanpham AS sp LEFT JOIN hinhsanpham AS hsp ON sp.sp_id = hsp.sanpham_sp_id LEFT JOIN binhluan AS bl ON sp.sp_id = bl.sanpham_sp_id WHERE sp.km = {$km_id} GROUP BY sp.sp_id ORDER BY sp.sp_ngaycapnhat DESC;";
                $resultDanhSachSanPham = mysqli_query($conn, $sqlDanhSachSanPham);
                $dataDanhSachSanPham = [];
                while ($row = mysqli_fetch_array($resultDanhSachSanPham, MYSQLI_ASSOC)) {
                    $dataDanhSachSanPham[] = array(
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
                <h3 class="myfont text-danger text-center">Sản phẩm</h3>
                <div class="row row-cols-lg-4 row-cols-sm-3 row-cols-1">
                    <?php foreach ($dataDanhSachSanPham as $sp) : ?>
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
            </div>
        </div>
    </div>

    <!-- End phần nội dung trang web -->
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>

    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
</body>

</html>