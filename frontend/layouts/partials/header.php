<div class="container-fluid px-0">
    <div class="container">
        <div class="row pt-3">
            <div class="col-lg-2 col-md-6 mt-2 text-center text-md-left">
                <a href="/shophoa.vn/frontend/index.php">
                    <img src="/shophoa.vn/assets/shared/img/ShopHoa.png" class="img-fluid">
                </a>
            </div>
            <div class="col-lg-2 col-md-6 text-center mt-2 order-lg-last text-md-right">
                <a href="" class="nav-link text-danger">
                    Giỏ hàng : 0
                </a>
            </div>
            <div class="col-lg-8 col-md-12">
                <form>
                    <div class="form-group">
                        <div class="text-center" style="position: relative;">
                            <input class="form-control hoa-form-control" type="search" placeholder="tìm kiếm ..." aria-label="Search">
                            <button class="btn btn-outline-success my-btn-cir" id="btn-search" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item dropdown mx-2 dot">
                    <a class="nav-link" href="#" id="chude1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Màu hoa
                    </a>
                    <?php
                        $sqlMauHoa = "SELECT mh_id, mh_ten FROM mauhoa;";
                        $resultMauHoa = mysqli_query($conn, $sqlMauHoa);
                        $dataMauHoa = [];
                        while ($row = mysqli_fetch_array($resultMauHoa, MYSQLI_ASSOC)) {
                            $dataMauHoa[] = array(
                                'mh_id' => $row['mh_id'],
                                'mh_ten' => $row['mh_ten'],
                            );
                        }
                    ?>
                    <div class="dropdown-menu" aria-labelledby="chude1" id="subchude1">
                        <?php foreach ($dataMauHoa as $mh): ?>
                            <a class="dropdown-item" href="phanloai.php?type=mauhoa&id=<?=$mh['mh_id']?>"><?=$mh['mh_ten']?></a>
                        <?php endforeach; ?>
                    </div>
                </li>
                <li class="nav-item dropdown mx-2 dot">
                    <a class="nav-link" href="#" id="chude2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Loại hoa
                    </a>
                    <?php
                        $sqlLoaiHoa = "SELECT lh_id, lh_ten FROM loaihoa;";
                        $resultLoaiHoa = mysqli_query($conn, $sqlLoaiHoa);
                        $dataLoaiHoa = [];
                        while ($row = mysqli_fetch_array($resultLoaiHoa, MYSQLI_ASSOC)) {
                            $dataLoaiHoa[] = array(
                                'lh_id' => $row['lh_id'],
                                'lh_ten' => $row['lh_ten'],
                            );
                        }
                    ?>
                    <div class="dropdown-menu" aria-labelledby="chude2" id="subchude2">
                        <?php foreach ($dataLoaiHoa as $lh): ?>
                            <a class="dropdown-item" href="phanloai.php?type=loaihoa&id=<?=$lh['lh_id']?>"><?=$lh['lh_ten']?></a>
                        <?php endforeach; ?>
                    </div>
                </li>
                <li class="nav-item dropdown mx-2 dot">
                    <a class="nav-link" href="#" id="chude3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Chủ đề
                    </a>
                    <?php
                        $sqlChuDe = "SELECT cd_id, cd_ten FROM chude;";
                        $resultChuDe = mysqli_query($conn, $sqlChuDe);
                        $dataChuDe = [];
                        while ($row = mysqli_fetch_array($resultChuDe, MYSQLI_ASSOC)) {
                            $dataChuDe[] = array(
                                'cd_id' => $row['cd_id'],
                                'cd_ten' => $row['cd_ten'],
                            );
                        }
                    ?>
                    <div class="dropdown-menu" aria-labelledby="chude3" id="subchude3">
                        <?php foreach ($dataChuDe as $cd): ?>
                            <a class="dropdown-item" href="phanloai.php?type=chude&id=<?=$cd['cd_id']?>"><?=$cd['cd_ten']?></a>
                        <?php endforeach; ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link mx-2 dot">Đánh giá</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link mx-2 dot">Góp ý</a>
                </li>
                <li class="nav-item">
                    <a href="dangnhap.php" class="nav-link mx-2 dot">Đăng nhập</a>
                </li>
                <li class="nav-item">
                    <a href="dangky.php" class="nav-link mx-2">Đăng ký</a>
                </li>
            </ul>

        </div>
    </nav>
</div>