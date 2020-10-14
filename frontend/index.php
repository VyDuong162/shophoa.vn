<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../dbconnect.php');
?>
<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Hoa</title>
    <?php include_once(__DIR__ . '/layouts/styles.php'); ?>
</head>
<?php include_once(__DIR__ . '/layouts/partials/header.php'); ?>

<?php include_once(__DIR__ . '/layouts/partials/footer.php'); ?>

<body>
    <?php include_once(__DIR__ . '/layouts/scripts.php'); ?>
</body>

</html>