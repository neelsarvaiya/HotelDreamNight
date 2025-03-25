<?php
include_once 'Admin/connection.php';

if (isset($_GET['email1'])) {
    $email = $_GET['email1'];
    $q = "SELECT * FROM `registration` WHERE `email`='$email'";
    $result = $con->query($q);
    if ($result->num_rows > 0) {
        echo 'true';
    } else {
        echo 'false';
    }
}