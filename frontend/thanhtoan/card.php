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
                        <table class="table table-striped table-hover table-responsive-sm" id="tbl">
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
                                    <?php $tongtien += $sanpham['thanhtien']; ?>
                                    <tr>
                                        <td class="align-middle text-center">
                                            <?= $stt++ ?>
                                        </td>
                                        <td class="align-middle" style="width: 100px;">
                                            <a href="/shophoa.vn/frontend/sanpham/chitiet.php?sp_id=<?= $sanpham['sp_id'] ?>">
                                                <?php if (!file_exists('../../assets/uploads/img-product/' . $sanpham['sp_avt_tenfile']) || empty($sanpham['sp_avt_tenfile'])) : ?>
                                                    <img src="/shophoa.vn/assets/shared/img/default.png" height="100px" width="100px" alt="<?= $sanpham['sp_ten'] ?>">
                                                <?php else : ?>
                                                    <img src="/shophoa.vn/assets/uploads/img-product/<?= $sanpham['sp_avt_tenfile'] ?>" height="100px" width="100px" alt="<?= $sanpham['sp_ten'] ?>">
                                                <?php endif; ?>
                                            </a>
                                        </td>
                                        <td class="align-middle">

                                            <a href="/shophoa.vn/frontend/sanpham/chitiet.php?sp_id=<?= $sanpham['sp_id'] ?>" class="text-dark myfont"><?= $sanpham['sp_ten'] ?></a>
                                        </td>
                                        <td class="align-middle text-right">
                                            <?= number_format($sanpham['sp_gia'], 0, ".", ",") ?> VNĐ
                                        </td>
                                        <td class="align-middle">
                                            <input type="number" name="soluong_<?= $sanpham['sp_id'] ?>" id="soluong_<?= $sanpham['sp_id'] ?>" value="<?= $sanpham['soluong'] ?>" class="form-control">
                                        </td>
                                        <td class="align-middle text-right">
                                            <?= number_format($sanpham['thanhtien'], 0, ".", ",") ?> VNĐ
                                        </td>
                                        <td class="align-middle text-canter">
                                            <button class="btn btn-outline-success btn_update" id="update_<?= $sanpham['sp_id'] ?>" data-sp_id="<?= $sanpham['sp_id'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                            <button class="btn btn-outline-danger btn_delete" id="delete_<?= $sanpham['sp_id'] ?>" data-sp_id="<?= $sanpham['sp_id'] ?>"><i class="fa fa-trash" aria-hidden="true" ></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-right font-weight-bold">Tổng tiền</td>
                                    <td class="text-right"><?= number_format($tongtien, 0, ".", ",") ?> VNĐ</td>
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
    <script src="/shophoa.vn/assets/vendor/sweetalert/sweetalert2.js"></script>
    <script>
        $(document).ready(function() {
            function removeSanPhamVaoGioHang(id) {
                var dulieugoi = {
                    sp_id: id
                };
                $.ajax({
                    url: '/shophoa.vn/frontend/api/giohang-xoasanpham.php',
                    method: "POST",
                    dataType: 'json',
                    data: dulieugoi,
                    success: function(data) {
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: false,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: 'Không thể xử lý'
                        })
                    }
                });
            };
            $('.btn_delete').click(function(event) {
                event.preventDefault();
                var id = $(this).data('sp_id');
                removeSanPhamVaoGioHang(id);
            });

            function capnhatSanPhamTrongGioHang(id, soluong) {
                var dulieugoi = {
                    sp_id: id,
                    soluong: soluong
                };

                $.ajax({
                    url: '/shophoa.vn/frontend/api/giohang-capnhatsanpham.php',
                    method: "POST",
                    dataType: 'json',
                    data: dulieugoi,
                    success: function(data) {
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: false,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: 'Không thể xử lý'
                        })
                    }
                });
            };
            $('.btn_update').click(function(event) {
                event.preventDefault();
                var id = $(this).data('sp_id');
                var soluongmoi = $('#soluong_' + id).val();
                capnhatSanPhamTrongGioHang(id, soluongmoi);
            });
        });
    </script>
</body>

</html>