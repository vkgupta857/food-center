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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Customer Registration - FoodCenter</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
    <?php include('includes/header.php'); ?>
    <section class="container">
        <div class="col-md-6 offset-md-3">
        <?php if($_GET['msg'] && $_GET['type']){ ?>
            <div class="alert alert-<?php echo $_GET['type']; ?> alert-dismissible text-center overflow-auto">
                <?php echo $_GET['msg']; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php } ?>
            <div class="card">
                <div class="card-body">
                    <div class="card-title text-primary text-center">
                        <h5>Restaurant Login</h5>
                    </div>
                    <hr>
                    <form method="post" action="restaurant_login_submit.php">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" class="form-control form-control-sm" name="email" placeholder="Enter email"
                                pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" type="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" class="form-control form-control-sm" name="password"
                                placeholder="Enter password" type="password" required>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-sm" name="submit">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    Not registered? <a href="restaurant_register.php" title="Register your restaurant">Register here</a>
                </div>
            </div>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>
    <!-- JS files are included in footer-->

</body>

</html>