<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    
    require("includes/db_con.php");

    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $mobile = filter_input(INPUT_POST, "mobile", FILTER_SANITIZE_NUMBER_INT);
    $city = filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_STRING);

    $password_hash = sha1($password);
    $id=""; // Auto Increment will be set by MySQL

    if($password !== $password2){
        header("location: customer_register.php?type=danger&msg=Passwords do not match.");
    } else {

        $stmt = $con->prepare("Select cust_email from customers where cust_email = ?");
        print_r($con->error);
        $stmt->bind_param("s",$email) or die($con->error);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows) {
            header("location: customer_register.php?type=danger&msg=User with this Email already exist. Please use another Email.");
        } else {
            $stmt = $con->prepare("Insert into customers values(?,?,?,?,?,?)") or die(print_r($con->error));
            $stmt->bind_param("isssss",$id,$email,$name,$mobile,$city,$password_hash);
            if($stmt->execute()){
                $_SESSION['cust_email'] = $email;
                $_SESSION['cust_name'] = $name;
                header("location: customer_home.php?type=success&msg=Registered Sucessfully");
            } else {
                header("location: customer_register.php?type=danger&msg=Unknown Error. $con->error");
            }
        }
        $stmt->close();
        $con->close();
    }
}
