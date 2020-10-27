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
                $sql = "SELECT mh_id,mh_ten FROM mauhoa";
                $result = mysqli_query($conn, $sql);
                $dataMauHoa = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $dataMauHoa[] = array(
                        'mh_id' => $row['mh_id'],
                        'mh_ten' => $row['mh_ten']
                    );
                }
                ?>
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-md-12 mt-3">
                            <a href="index.php"><button type="button" id="btndanhsach" class="btn btn-primary">Danh sách</button></a> <br><br>
                        </div>
                    </div>
                    <form name="frmthemmoi" id="frmthemmoi" action="" method="post" enctype="multipart/form-data">
                        <div class="row mb-10">
                            <div class="col-md-12 text-center">
                                <h1 id="frmtitle" class="h2 mb-0 text-gray-800 mb-3 shadow">Thêm mới màu hoa</h1>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="mh_ten">Tên màu hoa</label>
                                    <input type="text" class="form-control" id="mh_ten" name="mh_ten" placeholder="Tên màu hoa">
                                </div>
                            </div>
                            <div class="col-md-12 text-center mb-5">
                                <button class="btn btn-primary" name="btnsave" id="btnsave" type="submit">Lưu dữ liệu</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                if (isset($_POST['btnsave'])) {
                    $mh_ten = htmlentities($_POST['mh_ten']);
                    $erorrs = [];
                    if (empty($mh_ten)) {
                        $erorrs['mh_ten'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' =>  $mh_ten,
                            'mes' => 'Tên màu hoa không được bỏ trống',
                        ];
                    } else {
                        if (strlen($mh_ten) > 50) {
                            $erorrs['mh_ten'][] = [
                                'rule' => 'maxlength',
                                'rule_value' => 50,
                                'value' => $mh_ten,
                                'mes' => 'Tên màu hoa chỉ được tối đa 50 ký tự',
                            ];
                        }
                        if (strlen($mh_ten) < 3) {
                            $erorrs['mh_ten'][] = [
                                'rule' => 'minlength',
                                'rule_value' => 3,
                                'value' => $mh_ten,
                                'mes' => 'Tên màu hoa chứa tối thiểu 3 ký tự',
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
                    // INSERT
                    $sql = "INSERT INTO `mauhoa` (mh_ten) VALUES ('$mh_ten');";
                    mysqli_query($conn, $sql);
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
            // Kiểm tra logic phần frontend
            $('#frmthemmoi').validate({
                // Phần logic
                rules: {
                    mh_ten: {
                        required: true,
                        maxlength: 50,
                    },
                },
                // Phần thông báo
                messages: {
                    mh_ten: {
                        required: "Nhập tên dữ liệu",
                        maxlenght: "Tên chỉ có tối đa 50 ký tự",
                    },
                },
                // Phần mặc định
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