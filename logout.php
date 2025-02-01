<?php
     setcookie("user","", time() - 3600, "/");
     echo "<script>
     window.location.href = 'index.php';
     </script>";
     exit();
?>
