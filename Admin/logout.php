<?php
session_start();
unset($_SESSION['admin']);
?>

<script>
    window.location.href = '../index.php';
</script>