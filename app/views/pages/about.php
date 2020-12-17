<?php
require_once VIEWS ."inc/header.php";?>

    <h1><?php echo $data["title"] ?></h1>
    <p><?php echo $data['description'] ?></p>
    <p>Version :<?php echo APP_VERSION ?></p>

<?php require_once VIEWS ."inc/footer.php";