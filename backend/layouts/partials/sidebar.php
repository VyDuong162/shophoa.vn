<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse ">
    <div class="sidebar-sticky pt-3 position-static">
        <?php if (isset($_SESSION['kh_tendangnhap_logged'])) : ?>
            <div class="my-2 text-center" id="avatar" style="padding-top:  1rem;">
            <?php if (empty($_SESSION['kh_tendangnhap_anh'])) : ?>
                <img src="/shophoa.vn/assets/shared/img/avatar-default.jpg" alt="<?= $_SESSION['kh_tendangnhap_name'] ?>" height="100px">
            <?php else:?>
                <img src="/shophoa.vn/assets/uploads/avatar/<?=$_SESSION['kh_tendangnhap_anh']?>" alt="<?= $_SESSION['kh_tendangnhap_name'] ?>" height="100px">
            <?php endif;?>
                <h6 class="m-0 mt-md-3"><?= $_SESSION['kh_tendangnhap_name'] ?></h6>
            </div>
        <?php else : ?>
            <h5 class="my-2">Bạn chưa đăng nhập</h5>
        <?php endif; ?>
        <ul class="nav flex-column text-md-left text-center">
            <li class="nav-item">
                <a class="nav-link active" href="/shophoa.vn/backend/dashboard.php">
                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                    Dashboard
                </a>
            </li>
            <hr class="ml-3" style="border: 0.5px solid red; width: 80%;">
            <li class="nav-item">
                <a class="nav-link" href="#khachhang" data-toggle="collapse" aria-expanded="false">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    Khách hàng
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/shophoa.vn/backend/functions/dondathang/index.php">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    Đơn đặt hàng
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/shophoa.vn/backend/functions/sanpham/index.php">
                    <i class="fa fa-cubes" aria-hidden="true"></i>
                    Sản phẩm
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/shophoa.vn/backend/functions/chudesanpham/index.php">
                    <i class="fa fa-themeisle" aria-hidden="true"></i>
                    Chủ đề sản phẩm
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/shophoa.vn/backend/functions/hinhsanpham/index.php">
                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                    Hình sản phẩm
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/shophoa.vn/backend/functions/mauhoasanpham/index.php">
                    <i class="fa fa-themeisle" aria-hidden="true"></i>
                    Màu hoa sản phẩm
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/shophoa.vn/backend/functions/loaihoasanpham/index.php">
                    <i class="fa fa-themeisle" aria-hidden="true"></i>
                    Loại hoa sản phẩm
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/shophoa.vn/backend/functions/hinhthucthanhtoan/index.php">
                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                    Hình thức thanh toán
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/shophoa.vn/backend/functions/khuyenmai/index.php">
                    <i class="fa fa-gift" aria-hidden="true"></i>
                    Khuyến mãi
                </a>
            </li>
            <hr class="ml-3" style="border: 0.5px solid red; width: 80%;">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-area-chart" aria-hidden="true"></i>
                    Biểu đồ
                </a>
            </li>
        </ul>
    </div>
</nav>