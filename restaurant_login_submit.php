<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    
    include_once("includes/db_con.php");

    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

    $password_hash = sha1($password);

    if( $email && $password ){
        $stmt = $con->prepare("Select rest_name, rest_email,rest_password_hash from restaurants where rest_email = ? ");
        if(!$stmt){
            header("location: restaurant_login.php?type=danger&msg=Unknown Error!");
        } else {
            $stmt->bind_param("s",$email);
            $stmt->execute();
            $result = $stmt->get_result();

            if( $result->num_rows == 0){
                header("location: restaurant_login.php?type=danger&msg=No restaurant is registered with entered Email!");
            } else {
                $row = $result->fetch_assoc();
                if( $row['rest_password_hash'] != $password_hash){
                    header("location: restaurant_login.php?type=danger&msg=Incorrect password!");
                } else {
                    session_start();
                    $_SESSION['rest_email'] = $email;
                    $_SESSION['rest_name'] = $row['rest_name'];
                    header("location: restaurant_home.php");
                }
            }
        }
    } else {
        header("location: customer_login.php?type=danger&msg=Please enter Email and Password!");
    }
    $stmt->close();
    $con->close();
}
