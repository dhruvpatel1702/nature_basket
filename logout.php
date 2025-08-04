<?php 
session_start(); 

if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
}

if (isset($_SESSION['user_token'])) {
    unset($_SESSION['user_token']);
}

if (isset($_SESSION['user_email'])) {
    unset($_SESSION['user_email']);
}

header(header: "Location: user/form.php"); 
exit();
?>
