<?php
session_start();
if(!isset($_SESSION['cust_email'])) {
    header("location: customer_login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Home - FoodShala</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
    <?php include('includes/header.php'); ?>
    <section class="container">
        <?php if($_GET['msg'] && $_GET['type']){ ?>
        <div class="alert alert-<?php echo $_GET['type']; ?> alert-dismissible text-center overflow-auto">
            <?php echo $_GET['msg']; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <h5>Welcome, <?php echo $_SESSION['cust_name']; ?></h5>
        <p>Email: <?php echo $_SESSION['cust_email']; ?></p>
    </section>

    <?php include('includes/footer.php'); ?>
    <!-- JS files are included in footer-->

</body>

</html>