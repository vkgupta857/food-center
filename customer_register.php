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
    <title>Customer Registration - FoodShala</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
    <?php include('includes/header.php'); ?>
    <section class="container">
        <div class="col-md-6 offset-md-3" id="contact">
            <?php if($_GET['msg'] && $_GET['type']){ ?>
            <div class="alert alert-<?php echo $_GET['type']; ?> alert-dismissible text-center overflow-auto">
                <?php echo $_GET['msg']; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php } ?>
            <div class="card">
                <div class="card-body">
                    <div class="card-title text-primary text-center">
                        <h5>Customer Registration</h5>
                    </div>
                    <hr>
                    <form method="post" action="customer_register_submit.php">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" class="form-control form-control-sm" name="name"
                                placeholder="e.g. John Smith" type="text" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input id="mobile" class="form-control form-control-sm" name="mobile"
                                placeholder="e.g. 9876543210" type="text" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" class="form-control form-control-sm" name="email"
                                placeholder="e.g. abc@example.com"
                                pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" type="email" required>
                            <small>Email will work as username at the time of login.</small>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input id="city" class="form-control form-control-sm" name="city" placeholder="e.g. Mumbai"
                                type="text" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" class="form-control form-control-sm" name="password"
                                placeholder="e.g. abc@123" type="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password2">Re-enter Password</label>
                            <input id="password2" class="form-control form-control-sm" name="password2"
                                placeholder="Enter password again" type="password" required>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-sm" name="submit">Register</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    Already a customer? <a title="Customer Login" href="customer_login.php">Login here</a>
                </div>
            </div>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>
    <!-- JS files are included in footer-->

</body>

</html>