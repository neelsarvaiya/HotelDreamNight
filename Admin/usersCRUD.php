<?php
require_once('connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $deleteQuery = "DELETE FROM `register` WHERE `id`= '$id'";

    if (mysqli_query($conn, $deleteQuery)) {
        setcookie("success", "User Deleted Successfull.", time() + 3, "/");
    } else {
        setcookie("error", "Not Deleted Successfull.", time() + 3, "/");
    }
}
?>
<script>
    window.location.href = 'users.php';
</script>