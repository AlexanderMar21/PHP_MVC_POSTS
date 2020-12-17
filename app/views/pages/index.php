<?php
require_once VIEWS ."inc/header.php";?>

<div class="jumbotron jumbotron-fluid">
    <div id="home" class="container">
        <h1><?php echo $data["title"] ?></h1>
        <p class="lead">
            <?php echo $data['description'] ?>
        </p>

    </div>
</div>

<?php require_once VIEWS ."inc/footer.php";