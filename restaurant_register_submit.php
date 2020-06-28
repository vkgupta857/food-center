<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    
    require('includes/db_con.php');

    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $mobile = filter_input(INPUT_POST, "mobile", FILTER_SANITIZE_NUMBER_INT);
    $addr = filter_input(INPUT_POST, "addr", FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_STRING);

    $password_hash = sha1($password);
    $id=""; // Auto Increment will be set by MySQL

    if($password != $password2){
        header("location: restaurant_register.php?type=danger&msg=Passwords do not match.");
    } else {

        $stmt = $con->prepare("Select rest_email,rest_name from restaurants where rest_email = ?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows)
        {
            header("location: customer_register.php?type=danger&msg=Restaurant with this Email already exist. Please use another Email.");
        }
        else
        {
            $stmt = $con->prepare("Insert into restaurants values(?,?,?,?,?,?,?)");
            $stmt->bind_param("issssss",$id,$name,$mobile,$email,$addr,$city,$password_hash) or die($con->error);
            if($stmt->execute()){
                $_SESSION['rest_email'] = $email;
                $_SESSION['rest_name'] = $name;
                header("location: restaurant_home.php?type=success&msg=Registered Sucessfully");
            } else {
                header("location: restaurant_register.php?type=danger&msg=Unknown Error. $con->error");
            }
        }
        $stmt->close();
        $con->close();
    }
}