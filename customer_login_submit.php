<?php
include_once("includes/db_con.php");
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

    $password_hash = sha1($password);

    if( $email && $password ){
        $stmt = $con->prepare("Select cust_name, cust_email,cust_password_hash from customers where cust_email = ? ");
        if(!$stmt){
            header("location: customer_login.php?type=danger&msg=Unknown Error");
        }
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();

        if( $result->num_rows == 0){
            header("location: customer_login.php?type=danger&msg=No user found with entered Email");
        }
        $row = $result->fetch_assoc();
        if( $row['cust_password_hash'] != $password_hash){
            die('<script>alert("Incorrect password");</script>');
        }
        session_start();
        $_SESSION['cust_email'] = $email;
        $_SESSION['cust_name'] = $row['cust_name'];
        header("location: customer_home.php");

    } else {
        die('<script>alert("Please enter Email and Password.");</script>');
    }
}
