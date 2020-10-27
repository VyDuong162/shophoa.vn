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
    <title>Shop hoa | Chỉnh sửa loại hoa</title>
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
                $id = $_GET['idupdate'];
                $sql = "SELECT lh_id,lh_ten FROM loaihoa WHERE lh_id=$id";
                $result = mysqli_query($conn, $sql);
                $dataLoaiHoa = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $dataLoaiHoa = array(
                        'lh_id' => $row['lh_id'],
                        'lh_ten' => $row['lh_ten']
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
                                <h1 id="frmtitle" class="h2 mb-0 text-gray-800 mb-3 shadow">Sửa đổi loại hoa</h1>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="lh_ten">Tên loại hoa</label>
                                    <input type="text" class="form-control" id="lh_ten" name="lh_ten" placeholder="Tên loại hoa" value="<?= $dataLoaiHoa['lh_ten'] ?>">
                                </div>
                            </div>
                            <div class="col-md-12 text-center mb-5">
                                <button class="btn btn-success" name="btnsave" id="btnsave" type="submit">Lưu dữ liệu</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                if (isset($_POST['btnsave'])) {
                    $lh_ten = htmlentities($_POST['lh_ten']);
                    $erorrs = [];
                    if (empty($lh_ten)) {
                        $erorrs['lh_ten'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' =>  $lh_ten,
                            'mes' => 'Tên loại hoa không được bỏ trống',
                        ];
                    } else {
                        if (strlen($lh_ten) > 50) {
                            $erorrs['lh_ten'][] = [
                                'rule' => 'maxlength',
                                'rule_value' => 50,
                                'value' => $lh_ten,
                                'mes' => 'Tên loại hoa chỉ được tối đa 50 ký tự',
                            ];
                        }
                        if (strlen($lh_ten) < 3) {
                            $erorrs['lh_ten'][] = [
                                'rule' => 'minlength',
                                'rule_value' => 3,
                                'value' => $lh_ten,
                                'mes' => 'Tên loại hoa chứa tối thiểu 3 ký tự',
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
                    // Câu lệnh UPDATE
                    $sql = "UPDATE `loaihoa` SET lh_ten = '$lh_ten' WHERE lh_id='$id' ;";
                    // print_r($sql); die;
                    //var_dump($sql);die;
                    mysqli_query($conn, $sql);
                    //Đóng kết nối
                    mysqli_close($conn);
                    echo '<script>location.href = "edit.php?idupdate=' . $id . '";</script>';
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
                    lh_ten: {
                        required: true,
                        maxlength: 50,
                    },
                },
                // Phần thông báo
                messages: {
                    lh_ten: {
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