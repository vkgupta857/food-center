<?php
include_once('includes/db_con.php');
if(!isset($_SESSION['cust_email'])) {
    header("location: customer_login.php");
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    $sql  = '';

    $stmt = $con->prepare("Select * from cart, customers cust where (cart.ordered_by = cust.cust_id) & (cart.id = ?) & (cust.cust_email = ? )");
    $stmt->bind_param("is",$id, $_SESSION['cust_email']);
    if($stmt->execute()){
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if( $id && $_SESSION['cust_email'] && $id == $row['id'] ){
            $stmt = $con->prepare("Delete from cart where id = ?");
            $stmt->bind_param("i",$id);
            if($stmt->execute()){
                header("location: customer_home.php?type=success&msg=Removed from cart!");
            } else {
                header("location: customer_home.php?type=success&msg=Cannot remove item!");
            }        
        } else {
            header("location: customer_home.php?type=danger&msg=You cannot remove this item!");
        }
    } else{
        header("location: customer_home.php?type=danger&msg=Cannot delete item");
    }
    $stmt->close();
    $con->close();
}
