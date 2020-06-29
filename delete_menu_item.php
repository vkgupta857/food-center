<?php
include_once('includes/db_con.php');
if(!isset($_SESSION['rest_email'])) {
    header("location: restaurant_login.php");
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $item_id = filter_input(INPUT_GET, "item_id", FILTER_SANITIZE_NUMBER_INT);
    $rest_id = filter_input(INPUT_GET, "rest_id", FILTER_SANITIZE_NUMBER_INT);

    if( $item_id && $rest_id && $_SESSION['rest_email'] ){
        $stmt = $con->prepare("Delete from menu_items where item_id = ? and rest_id = ? ");
        $stmt->bind_param("ii",$item_id, $rest_id);
        if($stmt->execute()){
            header("location: restaurant_home.php?type=success&msg=Item deleted Succesfully!");
        } else {
            echo '<script>alert("Cannot add item!");</script>';
        }        
    }
    $stmt->close();
    $con->close();
}
