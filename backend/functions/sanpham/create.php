<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../../dbconnect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hoaxin</title>

    <?php
    include_once(__DIR__ . '/../../layouts/styles.php');
    ?>


</head>

<body class="d-flex flex-column h-100">
    <!-- Phần header -->
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>

    <!-- header -->


    <!-- Phần sidebar -->
    <div class="container-fiuld">
            <main role="main" class="col-md-10 ml-sm-auto px-4 mb-2">
                <div class="row">
                   
                        <!-- Phần sidebar -->
                        <?php
                        include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>

                        <!-- Phần sidebar -->
                    
                    <div class="col-md-12">
                    <div class="text-justify pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="text-justify">Điểu chỉnh sản phẩm</h1>
                    </div>
                    <form name="frmsanpham" id="frmsanpham" method="post" action="">
                        <div class="form-group">
                            <label for="sp_ten">Tên hoa</label>
                            <input type="text" class="form-control" id="sp_ten" name="sp_ten" placeholder="Tên Sản phẩm" value="">
                        </div>
                        <div class="form-group">
                            <label for="sp_gia">Giá hoa</label>
                            <input type="text" class="form-control" id="sp_gia" name="sp_gia" placeholder="Giá Sản phẩm" value="">
                        </div>
                        <div class="form-group">
                            <label for="sp_giacu">Giá cũ</label>
                            <input type="text" class="form-control" id="sp_giacu" name="sp_giacu" placeholder="Giá cũ Sản phẩm" value="">
                        </div>
                        <div class="form-group">
                            <label for="sp_mota_ngan">Mô tả ngắn</label>
                            <input type="text" class="form-control" id="sp_mota_ngan" name="sp_mota_ngan" placeholder="Mô tả ngắn Sản phẩm" value="">
                        </div>
                        <div class="form-group">
                            <label for="sp_mota_chitiet">Mô tả chi tiết</label>
                            <input type="text" class="form-control" id="sp_mota_chitiet" name="sp_mota_chitiet" placeholder="Mô tả chi tiết Sản phẩm" value="">
                        </div>
                        <div class="form-group">
                            <label for="sp_ngaycapnhat">Ngày cập nhật</label>
                            <input type="text" class="form-control" id="sp_ngaycapnhat" name="sp_ngaycapnhat" placeholder="Ngày cập nhật Sản phẩm" value="">
                        </div>
                        <!-- Them select cho loai san pham -->
                        <div class="form-group">
                            <label for="lsp_ma">Loại sản phẩm</label>
                            <select class="form-control" id="lsp_ma" name="lsp_ma">

                            </select>
                        </div>
                        <!-- Them select nha san xuat -->
                        <div class="form-group">
                            <label for="nsx_ma">Nhà sản xuất</label>
                            <select class="form-control" id="nsx_ma" name="nsx_ma">

                            </select>
                        </div>
                        <!-- Them select cho khuyen mai -->
                        <div class="form-group">
                            <label for="km_ma">Khuyến mãi</label>
                            <select class="form-control" id="km_ma" name="km_ma">
                                <option value="">Không áp dụng khuyến mãi</option>

                            </select>
                        </div>
                        <button class="btn btn-primary" name="btnSave">Lưu dữ liệu</button>

                    </form>


                </div>
                </div>
               
            
            </main>
        
    </div>
    <!-- sidebar -->


    <!-- Phần footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>

    <!-- footer -->



    <?php
    include_once(__DIR__ . '/../../layouts//scripts.php');
    ?>
</body>

</html>