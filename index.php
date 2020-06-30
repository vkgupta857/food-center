<?php 
session_start();
if(isset($_SESSION['cust_email'])){
    header("location: customer_home.php");
} elseif(isset($_SESSION['rest_email'])) {
    header("location: restaurant_home.php");
}
?>
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
            <div class="card bg-light">
                <div class="card-body text-center">
                    <h4>Do you own a restaurant? Want to grow more?</h4>
                    <ul>
                        <li>More reach to customers</li>
                        <li>One-click away from customers</li>
                    </ul>
                    <a href="restaurant_register.php" class="btn btn-primary" title="Register your restaurant">Register your restauarant</a>
                </div>
            </div>
            <br>
            <div class="card bg-light">
                <div class="card-body text-center">
                    <h4>Are you waiting for delicious food? To enjoy the taste register.</h4>
                    <ul>
                        <li>Directly contact restaurants owners</li>
                        <li>Smooth shopping process and experience</li>
                    </ul>
                    <a href="customer_register.php" class="btn btn-primary" title="Register as a customer">Register as a customer</a>
                </div>
            </div>
            <br>
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
                        <li>Create database using MySQL dump with name <code>foodshala.sql</code></li>
                        <li>A restaurant with name <code>Vicky Bakery</code> with Email <code>rest@example.com</code> and password <code>abc@123</code> has already been created.</li>
                        <li>A customer with Email <code>cust@example.com</code> and password <code>abc@123</code> has already been created.</li>
                    </ul>
                </div>
            </div>
            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5>Developed by Vinod Kumar Gupta to fulfill Assignment requirement for a role at Internshala</h5>
                </div>
            </div>
        </div>
    </section>

    <?php include_once('includes/footer.php'); ?>

</body>

</html>