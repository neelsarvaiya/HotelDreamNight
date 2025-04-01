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

<?php

if (isset($_POST['save_btn'])) {
    $id = $_POST['user_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    
    if (!empty($_FILES['profile']['name'])) {
        $profile_pic = uniqid() . $_FILES['profile']['name'];
        $temp_name = $_FILES['profile']['tmp_name'];
        $profile_path = "../img/userProfile/" . $profile_pic;
        
        move_uploaded_file($temp_name, $profile_path);
        
        $update = "UPDATE `register` SET 
                Full_Name='$name', 
                Email='$email', 
                Phone_number='$phone', 
                Address='$address', 
                DOB='$dob', 
                state='$state', 
                role='$role', 
                Profile_pic='$profile_pic' 
                WHERE id='$id'";
        } else {
            $update = "UPDATE `register` SET 
                Full_Name='$name', 
                Email='$email', 
                Phone_number='$phone', 
                Address='$address', 
                DOB='$dob', 
                state='$state', 
                role='$role' 
                WHERE id='$id'";
        }
        
        $result = mysqli_query($conn, $update);
        
        if ($result) {
            setcookie("success", "User Updated Successfull.", time() + 3, "/");
        } else { 
            setcookie("error", "Error updating user details!", time() + 3, "/");
        }
    }
?>

<script>
    window.location.href = 'users.php';
</script>