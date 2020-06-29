<?php
include_once('includes/db_con.php');
if(!isset($_SESSION['cust_email'])) {
    header("location: customer_login.php");
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    
    $stmt = $con->prepare("Select * from cart, customers cust where (cart.ordered_by = cust.cust_id) & (cart.id = ?) & (cust.cust_email = ? )");
    $stmt->bind_param("is",$id, $_SESSION['cust_email']);
    if($stmt->execute()){
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if( $id && $_SESSION['cust_email'] && $id == $row['id'] ){
            $stmt = $con->prepare("Insert into orders values (?,?,?,?,?)");
            $stmt->bind_param("iiiii",$id,$row['ordered_by'],$row['ordered_from'],$row['item_id'],$row['quantity']);
            
            if($stmt->execute()){
                $stmt = $con->prepare("Delete from cart where id = ?");
                $stmt->bind_param("i",$id);
                $stmt->execute();
                header("location: customer_home.php?type=success&msg=Order Placed! Enjoy the delicious food!");
            } else {
                header("location: customer_home.php?type=success&msg=Cannot place order!");
            }        
        } else {
            header("location: customer_home.php?type=danger&msg=You cannot place order for this item!");
        }
    } else{
        header("location: customer_home.php?type=danger&msg=You cannot place order for this item!");
    }
    $stmt->close();
    $con->close();
}
