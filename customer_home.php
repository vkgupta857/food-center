<?php
include_once('includes/db_con.php');
if(!isset($_SESSION['cust_email'])) {
    header("location: customer_login.php");
}

$stmt = $con->prepare("Select * from customers where cust_email = ?");
$stmt->bind_param("s",$_SESSION['cust_email']);
if($stmt->execute()){
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $cust_id = $row['cust_id'];
} else {
    die("Unknown Error!");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Home - FoodCenter</title>
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
        <div class="card bg-light">
            <div class="card-body">
                <h5>Welcome, <?php echo $_SESSION['cust_name']; ?></h5>
                <p>
                    Mobile: <?php echo $row['cust_mobile']; ?><br>
                    Email: <?php echo $_SESSION['cust_email']; ?><br>
                    City: <?php echo $row['cust_city']; ?><br>
                </p>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <div class="card border-primary">
                    <div class="card-header text-primary">
                        My Orders
                        <a class="btn btn-sm btn-outline-primary float-right" href="products.php">Order items</a>
                    </div>
                    <div class="card-body">
                        <?php
                        $stmt2 = $con->prepare("Select * from orders o,menu_items m where o.ordered_by = ? && m.item_id = o.item_id");
                        $stmt2->bind_param("i",$cust_id);
                        if($stmt2->execute()){
                            $result2 = $stmt2->get_result();
                            if($result2->num_rows == 0){
                                echo '<p>No orders.</p>';
                            } else { ?>

                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Item Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row2 = $result2->fetch_assoc()){ ?>
                                <tr>
                                    <td><?php echo $row2['item_name']; ?></td>
                                    <td><?php echo "Rs.".$row2['item_price']; ?></td>
                                    <td><?php echo '<a href="cancel_order.php?id='.$row2['order_id'].'" title="Delete this Item">Cancel Order</a>'; ?>
                                    </td>
                                </tr>
                                <?php }
                        }} else {
                            echo '<script>alert("Cannot add item!");</script>';
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-primary">
                    <div class="card-header text-primary">My Cart</div>
                    <div class="card-body">
                        <?php
                        $stmt3 = $con->prepare("Select * from cart c,menu_items m where c.ordered_by = ? && m.item_id = c.item_id");
                        $stmt3->bind_param("i",$cust_id);
                        if($stmt3->execute()){
                            $result3 = $stmt3->get_result();
                            if($result3->num_rows == 0){
                                echo "<p>No items in your cart.</p>";
                            } else {
                            ?>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Item Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            while($row3 = $result3->fetch_assoc()){ ?>
                                <tr>
                                    <td><?php echo $row3['item_name']; ?></td>
                                    <td><?php echo "Rs.".$row3['item_price']; ?></td>
                                    <td>
                                        <?php echo '<a class="btn btn-sm btn-primary" href="delete_from_cart.php?id='.$row3['id'].'" title="Remove from cart">Remove</a>'; ?>
                                        <?php echo '<a class="btn btn-sm btn-primary" href="place_order.php?id='.$row3['id'].'" title="Place order">Place order</a>'; ?>
                                    </td>
                                </tr>
                                <?php }
                        } } else {
                            echo '<script>alert("Cannot add item!");</script>';
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <?php include('includes/footer.php'); ?>
    <!-- JS files are included in footer-->

</body>

</html>