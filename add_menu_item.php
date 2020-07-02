<?php
session_start();
if(!isset($_SESSION['rest_email'])) {
    header("location: restaurant_login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Menu Item - FoodCenter</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
    <?php include('includes/header.php'); ?>
    <section class="container">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title text-primary text-center">
                        <h5>Add Menu Item</h5>
                    </div>
                    <hr>
                    <form method="post">
                        <div class="form-group">
                            <label for="item-name">Item Name</label>
                            <input id="item-name" class="form-control form-control-sm" name="item-name"
                                placeholder="e.g. Paneer Butter Masala - Full" type="text" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price (in Rs)</label>
                            <input id="price" class="form-control form-control-sm" name="price"
                                placeholder="e.g. 120" type="number" required>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-sm" name="submit">Add Item</button>
                        </div>
                    </form>
                    <a href="restaurant_home.php" title="Go to Home"><< Go to home</a>
                </div>
            </div>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>
    <!-- JS files are included in footer-->

</body>

</html>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    
    include_once('includes/db_con.php');

    $item_name = filter_input(INPUT_POST, "item-name", FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_INT);

    if( $item_name && $price ){
        $stmt = $con->prepare("Select rest_id from restaurants where rest_email = ?");
        $stmt->bind_param("s",$_SESSION['rest_email']);
        if($stmt->execute()){
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $rest_id = $row['rest_id'];
        } else {
            echo '<script>alert("Cannot add item!");</script>';
        }

        $stmt = $con->prepare("Insert into menu_items values(?,?,?,?)");
        $stmt->bind_param("isss",$id,$rest_id,$item_name,$price);
        if($stmt->execute()){
            echo '<script>alert("Item Added!");</script>';
        } else {
            echo '<script>alert("Cannot add item!");</script>';
        }
        
    } else {
        echo '<script>alert("Please enter Item name and price!");</script>';
    }
    $stmt->close();
    $con->close();
}
