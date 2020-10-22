<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../dbconnect.php');
?>
<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Hoa | Giới thiệu</title>
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
    <!-- Phần nội dung trang web -->
    <div class="container my-3">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3 class="myfont text-danger">Về chúng tôi</h3>
                <p>Sứ mệnh của chúng tôi là giúp bạn trao đi tâm tư và biến mọi dịp trọng đại của bạn trở nên đặc biệt hơn.</p>
                <p>Đội ngũ giàu kinh nghiệm của chúng tôi luôn đảm bảo đem đến cho bạn những bó hoa tươi nhất được gói cùng các loại nguyên vật liệu chất lượng cao. Chúng tôi cung cấp nhiều chủng loại hoa, kích thước và thiết kế khác nhau phù hợp cho bất kỳ dịp nào bạn cần.</p>
                <p>Thông qua nền tảng trực tuyến, chúng tôi mong muốn đem đến cho bạn trải nghiệm thật tiện lợi, dễ dàng và tràn đầy niềm vui.</p>
                <img src="/shophoa.vn/assets/shared/img/aboutus.jpg" alt="Về chúng tôi" width="80%">
            </div>
        </div>
    </div>
    <!-- End phần nội dung trang web -->
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>

    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
</body>

</html>