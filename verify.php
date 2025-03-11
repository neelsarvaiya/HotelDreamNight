<?php
require_once('Admin/connection.php');

if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];
    $sql = "SELECT * FROM `register` WHERE email = '$email' AND token = '$token'";
    $count = $conn->query($sql);
    $r = mysqli_fetch_assoc($count);
    if ($count->num_rows == 1) {
        if ($r['status'] == 'inactive') {
            $update = "UPDATE register SET `status` = 'active' WHERE email = '$email'";
            if ($conn->query($update)) {
                setcookie('success', 'Account Verification Successful. Now You Login', time() + 3,"/");
            } else {
                setcookie('error', 'Error in verifying email', time() + 3,"/");
            }
        } else {
            setcookie('success', 'Email already verified', time() + 3,"/");
        }
    }
} else {
    setcookie('error', 'Email not registered', time() + 3,"/");
}
?>
<script>
    window.location.href = 'index.php';
</script>
