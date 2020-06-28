<?php
session_start();
if (!isset($_SESSION['cust_email'])) {
    header('location: customer_login.php');
}
session_destroy();
header('location: index.php?type=primary&msg=Logged out successfully.');
?>