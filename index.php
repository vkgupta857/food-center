<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Foodshala</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
    <?php include_once('includes/header.php'); ?>
    <section>
        <div class="container">
            <?php if($_GET['msg'] && $_GET['type']){ ?>
            <div class="alert alert-<?php echo $_GET['type']; ?> alert-dismissible text-center overflow-auto">
                <?php echo $_GET['msg']; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php } ?>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="alert alert-primary text-center">
                This project is submitted to fulfill the assisgnment required for web dev role as Internshala
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h5>Technology Stack</h5>
                    <ul>
                        <li>HTML/CSS/JS</li>
                        <li>Bootstrap 4.4</li>
                        <li>PHP</li>
                        <li>MySQL</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5>Requirements to run/interact properly</h5>
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php include_once('includes/footer.php'); ?>

</body>

</html>