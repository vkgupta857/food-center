<?php
include_once('includes/db_con.php');
if(isset($_GET['city'])){
    $city = filter_input(INPUT_GET, "city", FILTER_SANITIZE_STRING);
    $stmt = $con->prepare("Select * from menu_items m,restaurants r where r.rest_city = ?");
    $stmt->bind_param("s",$city);
} elseif(isset($_GET['item_name'])){
    $item_name = filter_input(INPUT_GET, "item_name", FILTER_SANITIZE_STRING);
    $stmt = $con->prepare("Select * from menu_items m,restaurants r where m.item_name = ?");
    $stmt->bind_param("s",$item_name);
} else {
    $stmt = $con->prepare("Select * from menu_items, restaurants");
}
if($stmt->execute()){
    $result = $stmt->get_result();
} else {
    die("Unknown Error!");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products - FoodCenter</title>
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
                <h4 class="text-center">Waiating some delicious food? Choose below, Order and <span
                        class="text-danger">Have a taste!</span></h4>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5>Filters</h5>
                        <a href="products.php" class="d-block">Clear filters</a>
                        <hr>
                        <b>By Menu Item</b>
                        <table class="table table-sm">
                            <tbody>
                                <?php
                        $stmt1 = $con->prepare("Select distinct(item_name) from menu_items");
                        if($stmt1->execute()){
                            $result1 = $stmt1->get_result();
                            while($row1 = $result1->fetch_assoc()){ ?>
                                <tr>
                                    <td><?php echo '<a href="products.php?item_name='.$row1['item_name'].'">'.$row1['item_name'].'</a>'; ?>
                                    </td>
                                </tr>
                                <?php }
                        }
                        ?>
                            </tbody>
                        </table>
                        <b>By Location</b>
                        <table class="table table-sm">
                            <tbody>
                                <?php
                        $stmt2 = $con->prepare("Select distinct(rest_city) from restaurants");
                        if($stmt2->execute()){
                            $result2 = $stmt2->get_result();
                            while($row2 = $result2->fetch_assoc()){ ?>
                                <tr>
                                    <td><?php echo '<a href="products.php?city='.$row2['rest_city'].'">'.$row2['rest_city'].'</a>'; ?>
                                    </td>
                                </tr>
                                <?php }
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <?php
                if($result->num_rows == 0){
                    echo "No Items :(";
                } else {
                    while($row = $result->fetch_assoc()){ ?>
                <div class="card border-primary">
                    <div class="card-header border-primary text-danger">
                        <b>
                            <?php echo $row['item_name']; ?>
                            <span class="float-right">
                                <?php echo "Rs. ".$row['item_price']; ?>
                            </span>
                        </b>
                    </div>
                    <div class="card-body">
                        <div class="float-left">
                            <p>Restaurant Name: <b><?php echo $row['rest_name'].", ".$row['rest_city']; ?></b></p>
                            <p>
                                Mobile: <?php echo $row['rest_mobile']; ?>,
                                Email: <?php echo $row['rest_email']; ?>
                            </p>
                        </div>
                        <div class="float-right">
                            <?php if(isset($_SESSION['cust_email'])){
                                $stmt3 = $con->prepare("Select cust_id from customers where cust_email = ?");
                                $stmt3->bind_param("s",$_SESSION['cust_email']);
                                if($stmt3->execute()){
                                    $result3 = $stmt3->get_result();
                                    $row3 = $result3->fetch_assoc();
                                }
                            echo '<a href="add_to_cart.php?item_id='.$row['item_id'].'&ordered_by='.$row3['cust_id'].'&quantity=1&ordered_from='.$row['rest_id'].'"
                                class="btn btn-sm btn-primary">Add to cart </a>';
                             } else { ?>
                            <a href="customer_login.php?type=primary&msg=Login to continue"
                                class="btn btn-sm btn-primary">Add to cart </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <br>
                <?php }}?>
            </div>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>
    <!-- JS files are included in footer-->

</body>

</html>