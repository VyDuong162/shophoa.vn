<?php
if (session_id() === '') {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Hoa | Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <?php include_once(__DIR__ . '/layouts/styles.php'); ?>
</head>

<body>
    <?php include_once(__DIR__ . '/layouts/scripts.php'); ?>
</body>

</html>