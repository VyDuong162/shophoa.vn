<?php
if (session_id() === '') {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm khuyến mãi</title>
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?>
    <link rel="stylesheet" href="/shophoa.vn/assets/backend/css/style.css" type="text/css" />
</head>

<body>
    <!-- Phần loading trang web -->
    <div id="load">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 position-static">
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            </div>
            <main role="main" id="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <?php
                include_once(__DIR__ . '/../../../dbconnect.php');
                $sql = "SELECT httt_id,httt_ten FROM hinhthucthanhtoan";
                $result = mysqli_query($conn, $sql);
                $dataHinhThucThanhToan = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $dataHinhThucThanhToan[] = array(
                        'httt_id' => $row['httt_id'],
                        'httt_ten' => $row['httt_ten']
                    );
                }
                ?>
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-md-12 mt-5">
                            <a href="index.php"><button type="button" id="btndanhsach" class="btn btn-primary">Danh sách</button></a> <br><br>
                        </div>
                    </div>
                    <form name="frmthemmoi" id="frmthemmoi" action="" method="post" enctype="multipart/form-data">
                        <div class="row mb-10">
                            <div class="col-md-12 text-center">
                                <h1 id="frmtitle" class="h3 mb-0 text-gray-800 mb-3 shadow">Thêm mới hình thức thanh toán</h1>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="httt_ten">Tên hình thức thanh toán</label>
                                    <input type="text" class="form-control" id="httt_ten" name="httt_ten" placeholder="Tên hình thức thanh toán" value="">
                                </div>
                            </div>
                            <div class="col-md-12 text-center mb-5">
                                <button class="btn btn-success" name="btnsave" id="btnsave" type="submit">Thêm</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                if (isset($_POST['btnsave'])) {
                    $httt_ten = htmlentities($_POST['httt_ten']);
                    $erorrs = [];
                    if (empty($httt_ten)) {
                        $erorrs['httt_ten'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' =>  $httt_ten,
                            'mes' => 'Tên hình thức thanh toán không được bỏ trống',
                        ];
                    } else {
                        if (strlen($httt_ten) > 50) {
                            $erorrs['httt_ten'][] = [
                                'rule' => 'maxlength',
                                'rule_value' => 50,
                                'value' => $httt_ten,
                                'mes' => 'Tên hình thức thanh toán chỉ được tối đa 50 ký tự',
                            ];
                        }
                        if (strlen($httt_ten) < 3) {
                            $erorrs['httt_ten'][] = [
                                'rule' => 'minlength',
                                'rule_value' => 3,
                                'value' => $httt_ten,
                                'mes' => 'Tên hình thức thanh toán phải tối thiểu 3 ký tự',
                            ];
                        }
                    }
                }
                ?>
                <?php if (isset($_POST['btnsave']) && (isset($erorrs) && !empty($erorrs))) : ?>
                    <div class="alert alert-warning col-md-12" role="alert">
                        <ul>
                            <?php foreach ($erorrs as $loi) : ?>
                                <?php foreach ($loi as $a) : ?>
                                    <li><?= $a['mes'] ?></li>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php
                if (isset($_POST['btnsave']) && !(isset($erorrs) && !empty($erorrs))) {
                    // Câu lệnh INSERT
                    $sql = "INSERT INTO `hinhthucthanhtoan` (httt_ten) VALUES ('$httt_ten');";
                    // print_r($sql); die;
                    // Thực thi INSERT
                    //var_dump($sql);die;
                    mysqli_query($conn, $sql);
                    //Đóng kết nối
                    mysqli_close($conn);
                    echo '<script>location.href = "index.php";</script>';
                }
                ?>
            </main>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>
    <script>
        $(document).ready(function() {
            $('#frmthemmoi').validate({
                rules: {
                    httt_ten: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                },
                messages: {
                    httt_ten: {
                        required: "Bạn phải nhập tên hình thức thanh toán",
                        minlength: "Bạn phải nhập họ tên tối thiểu 3 ký tự",
                        maxlength: "Bạn chỉ được nhập họ tên tối đa 50 ký tự",
                    },
                },
                errorElement: "em",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                success: function(label, element) {},
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });
        });
    </script>
</body>

</html>