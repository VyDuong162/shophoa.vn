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
    <title>Shop Hoa | Giỏ hàng</title>
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
            <div class="col-md-12">
                <?php
                include_once(__DIR__ . '/../../dbconnect.php');
                $giohangdata = [];
                if (isset($_SESSION['giohangdata'])) {
                    $giohangdata = $_SESSION['giohangdata'];
                } else {
                    $giohangdata = [];
                }
                ?>
                <?php if (!empty($giohangdata)) : ?>
                    <form action="" method="post">
                        <table class="table table-striped table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        STT
                                    </th>
                                    <th colspan="2" class="text-center">
                                        Tên sản phẩm
                                    </th>
                                    <th class="text-center">
                                        Giá
                                    </th>
                                    <th class="text-center">
                                        Số lượng
                                    </th>
                                    <th class="text-center">
                                        Thành tiền
                                    </th>
                                    <th class="text-center">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $stt = 1; 
                                    $tongtien = 0;
                                ?>
                                <?php foreach ($giohangdata as $sanpham) : ?>
                                    <?php $tongtien += $sanpham['thanhtien'];?>
                                    <tr>
                                        <td class="align-middle text-center">
                                            <?= $stt++ ?>
                                        </td>
                                        <td class="align-middle" style="width: 100px;">
                                            <a href="/shophoa.vn/frontend/sanpham/chitiet.php?sp_id=<?= $sanpham['sp_id'] ?>"><img src="/shophoa.vn/assets/shared/img-product/<?= $sanpham['sp_avt_tenfile'] ?>" height="100px" width="100px" alt="<?= $sanpham['sp_ten'] ?>"></a>
                                        </td>
                                        <td class="align-middle">
                                            <a href="/shophoa.vn/frontend/sanpham/chitiet.php?sp_id=<?= $sanpham['sp_id'] ?>" class="text-dark myfont"><?= $sanpham['sp_ten'] ?></a>
                                        </td>
                                        <td class="align-middle text-right">
                                            <?= number_format($sanpham['sp_gia'], 0, ".", ",") ?> VNĐ
                                        </td>
                                        <td class="align-middle">
                                            <input type="number" name="" id="" value="<?= $sanpham['soluong'] ?>" class="form-control">
                                        </td>
                                        <td class="align-middle text-right">
                                        <?= number_format($sanpham['thanhtien'], 0, ".", ",") ?> VNĐ
                                        </td>
                                        <td class="align-middle text-canter">
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-right font-weight-bold">Tổng tiền</td>
                                    <td class="text-right"><?=number_format($tongtien, 0, ".", ",")?> VNĐ</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                    <div class="text-right">
                        <button class="btn myfont text-danger btn-add">
                            <h1>Đặt hàng</h1>
                        </button>
                    </div>
                <?php else : ?>
                    <h2>Giỏ hàng rỗng!!!</h2>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- End phần nội dung trang web -->
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>

    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
</body>

</html>