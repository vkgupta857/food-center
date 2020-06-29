<?php
include_once('includes/db_con.php');
if(!isset($_SESSION['cust_email'])) {
    header("location: customer_login.php");
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $item_id = filter_input(INPUT_GET, "item_id", FILTER_SANITIZE_NUMBER_INT);
    $ordered_by = filter_input(INPUT_GET, "ordered_by", FILTER_SANITIZE_NUMBER_INT);
    $ordered_from = filter_input(INPUT_GET, "ordered_from", FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_input(INPUT_GET, "quantity", FILTER_SANITIZE_NUMBER_INT);

    $id = "";
    if( $_SESSION['cust_email'] && $item_id && $ordered_by && $quantity && $ordered_from){
        $stmt = $con->prepare("Insert into cart values(?,?,?,?,?) ");
        $stmt->bind_param("iiiii",$id,$item_id, $ordered_by, $ordered_from,$quantity);
        if($stmt->execute()){
            header("location: customer_home.php?type=success&msg=Added to cart!");
        } else {
            header("location: customer_home.php?type=danger&msg=Cannot add item!");
        }        
    }
    $stmt->close();
    $con->close();
}
