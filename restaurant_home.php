<?php
include_once('includes/db_con.php');
if(!isset($_SESSION['rest_email'])) {
    header("location: restaurant_login.php");
}

$stmt = $con->prepare("Select * from restaurants where rest_email = ?");
$stmt->bind_param("s",$_SESSION['rest_email']);
if($stmt->execute()){
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $rest_id = $row['rest_id'];
} else {
    die("Unknown Error!");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restaurant Home - FoodCenter</title>
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
                <h5>Welcome, <?php echo $_SESSION['rest_name']; ?></h5>
                <p>
                    Mobile: <?php echo $row['rest_mobile']; ?><br>
                    Email: <?php echo $_SESSION['rest_email']; ?><br>
                    Address: <?php echo $row['rest_addr']; ?><br>
                    City: <?php echo $row['rest_city']; ?><br>
                </p>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <div class="card border-primary">
                    <div class="card-header text-primary">
                        My Items
                        <a class="btn btn-sm btn-outline-primary float-right" href="add_menu_item.php">Add item</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Item Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        $stmt = $con->prepare("Select * from menu_items where rest_id = ?");
                        $stmt->bind_param("s",$rest_id);
                        if($stmt->execute()){
                            $result = $stmt->get_result();
                            while($row = $result->fetch_assoc()){ ?>
                                <tr>
                                    <td><?php echo $row['item_name']; ?></td>
                                    <td><?php echo "Rs.".$row['item_price']; ?></td>
                                    <td><?php echo '<a href="delete_menu_item.php?item_id='.$row['item_id'].'&rest_id='.$rest_id.'" title="Delete this Item">Delete this item</a>'; ?>
                                    </td>
                                </tr>
                                <?php }
                        } else {
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
                    <div class="card-header text-primary">Orders Received</div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Item Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        $stmt2 = $con->prepare("Select * from orders o,menu_items m where o.ordered_from = ? && m.item_id = o.item_id ");
                        $stmt2->bind_param("i",$rest_id);
                        if($stmt2->execute()){
                            $result2 = $stmt2->get_result();
                            while($row2 = $result2->fetch_assoc()){ ?>
                                <tr>
                                    <td><?php echo $row2['item_name']; ?></td>
                                    <td><?php echo "Rs.".$row2['item_price']; ?></td>
                                    <td><?php echo '<a href="#" title="Delete this Item">Delete this item</a>'; ?>
                                    </td>
                                </tr>
                                <?php }
                        } else {
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