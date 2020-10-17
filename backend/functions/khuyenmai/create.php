<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm khuyến mãi</title>
    <?php include_once(__DIR__.'/../../layouts/styles.php');?>
    <link rel="stylesheet" href="/shophoa.vn/assets/backend/css/style.css" type="text/css"/> 
</head>
<body>
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php');?> 
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 position-static">
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php');?>
            </div>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <h1 class="h3 mb-0 text-gray-800 mt-2">Thêm khuyến mãi</h1>
                <?php
                    include_once(__DIR__.'/../../../dbconnect.php');
                    $sql="SELECT km_id,km_ten,km_noidung,km_tungngay,km_denngay,km_anh FROM khuyenmai";
                    $result=mysqli_query($conn,$sql);
                    $dataKhuyenMai = [];
                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        $dataKhuyenMai[] = array(
                            'km_id' => $row['km_id'],
                            'km_ten' => $row['km_ten'],
                            'km_noidung' => $row['km_noidung'],
                            'km_tungngay' => $row['km_tungngay'],
                            'km_denngay' => $row['km_denngay'],
                            'km_anh' => $row['km_anh'],
                        );
                    }
                ?>
            </main>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php');?>
    <?php include_once(__DIR__.'/../../layouts/scripts.php');?>
    <script src="/shophoa.vn/assets/vendor/Chart.js/Chart.min.js"></script>
    
</body>
</html>