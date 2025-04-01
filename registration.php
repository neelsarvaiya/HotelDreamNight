<?php

include_once('Admin/connection.php');
include_once('mailer.php');


if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['registrationEmail'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $dob = $_POST['dob'];
    $date = date('d-m-Y');
    $fname = uniqid() . $_FILES['pic']['name'];
    $password = password_hash($_POST['registerPassword'], PASSWORD_DEFAULT);
    $token = uniqid() . time();

    $user_exist = "SELECT Email FROM `register` WHERE Email = '$email'";
    $result = mysqli_query($conn, $user_exist);


    if (mysqli_num_rows($result) > 0) {
        setcookie("userExist", "$email Email Already Exist", time() + 3, "/");
?>
        <script>
            window.location.href = 'index.php';
        </script>";
        <?php
        exit();
    }

    try {

        $insert = "INSERT INTO `register`(`Full_Name`, `Email`, `Phone_number`, `Profile_pic`, `Address`, `state`, `DOB`, `Password`,`token`) VALUES ('$name','$email','$phone','$fname ','$address','$state','$dob','$password','$token')";

        if (mysqli_query($conn, $insert)) {
            
            if (!is_dir("img/userProfile")) {
                mkdir("img/userProfile");
            }

            define("UPLOAD_SRC", $_SERVER['DOCUMENT_ROOT'] . "/HotelDreamNight/img/userProfile/");
            if (move_uploaded_file($_FILES['pic']['tmp_name'], UPLOAD_SRC . $fname)) {

                $subject = "Account Verification Link";
                $link = 'http://localhost/HotelDreamNight/verify.php?email=' . $email . '&token=' . $token;
                $body = "<div style='background-color: #f8f9fa; padding: 20px; border-radius: 5px;'>
                    <h2 style='color: #019A34; text-align: center;'>Account Verification</h2>
                    <p style='text-align: center;'>Click on the button below to verify your account</p>
                    <a href='" . $link . "' style='display: block; width: 200px; margin: 0 auto; text-align: center; background-color: #019A34; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Verify Account</a>
                </div>";
                
                if (sendEmail($email, $subject, $body, "")) {
                    setcookie('success', 'Registration Successfull. Account verification link has been sent to your email. Verify your email to login.', time() + 3, "/");
                } else {
                    setcookie('error', 'Failed to send the registration link', time() + 5);
                }
                ?>
                <script>
                    window.location.href = 'index.php';
                </script>
        <?php
                exit;
            }
        } else {
            setcookie('error', 'Registration Failed', time() + 3,"/");
            ?>
            <script>
                window.location.href = 'index.php';
            </script>
    <?php
            exit;
        }
    } catch (Exception $e) {
        setcookie("error", "Registration Failed", time() + 3, "/");
        ?>
        <script>
            window.location.href = 'index.php';
        </script>
<?php
    }
}
?>