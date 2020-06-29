<?php
include_once('includes/db_con.php');
if(!isset($_SESSION['cust_email'])) {
    header("location: customer_login.php");
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    
    $stmt = $con->prepare("Select * from orders, customers cust where (orders.ordered_by = cust.cust_id) & (orders.order_id = ?) & (cust.cust_email = ? )");
    $stmt->bind_param("is",$id, $_SESSION['cust_email']);
    if($stmt->execute()){
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if( $id && $_SESSION['cust_email'] && $id == $row['order_id'] ){
            $stmt = $con->prepare("Delete from orders where order_id = ?");
            $stmt->bind_param("i",$id);
            if($stmt->execute()){
                header("location: customer_home.php?type=warning&msg=Order Cancelled! You missed the taste!");
            } else {
                header("location: customer_home.php?type=success&msg=Cannot cancel order!");
            }        
        } else {
            header("location: customer_home.php?type=danger&msg=You cannot cancel order for this item!");
        }
    } else{
        header("location: customer_home.php?type=danger&msg=You cannot cancel order for this item!");
    }
    $stmt->close();
    $con->close();
}
