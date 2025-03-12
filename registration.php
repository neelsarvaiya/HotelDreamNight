<?php

include_once('Admin/connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require('PHPMailer\PHPMailer.php');
require('PHPMailer\SMTP.php');
require('PHPMailer\Exception.php');

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

        $insert = "INSERT INTO `register`(`Full_Name`, `Email`, `Phone_number`, `Profile_pic`, `Address`, `state`, `created_at`, `DOB`, `Password`,`token`) VALUES ('$name','$email','$phone','$fname ','$address','$state','$date','$dob','$password','$token')";

        if (mysqli_query($conn, $insert)) {
            if (!is_dir("img/userProfile")) {
                mkdir("img/userProfile");
            }

            define("UPLOAD_SRC", $_SERVER['DOCUMENT_ROOT'] . "/HotelDreamNight/img/userProfile/");
            if (move_uploaded_file($_FILES['pic']['tmp_name'], UPLOAD_SRC . $fname)) {
                $mail = new PHPMailer();
                $headers = 'X-Mailer: PHP/' . phpversion();
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

                $to = $email;
                $subject = "Account Verification Link";
                $link = 'http://localhost/HotelDreamNight/verify.php?email=' . $email . '&token=' . $token;
                $body = "<div style='background-color: #f8f9fa; padding: 20px; border-radius: 5px;'>
                    <h2 style='color: #019A34; text-align: center;'>Account Verification</h2>
                    <p style='text-align: center;'>Click on the button below to verify your account</p>
                    <a href='" . $link . "' style='display: block; width: 200px; margin: 0 auto; text-align: center; background-color: #019A34; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Verify Account</a>
                </div>";
                $mail->IsSMTP(); // telling the class to use SMTP
                $mail->SMTPDebug  = 2;                // enables SMTP debug information (for testing)
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
                $mail->Host       = 'smtp.gmail.com';      // sets GMAIL as the SMTP server
                $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
                $mail->Username   = "neelsarvaiya11@gmail.com";  // GMAIL username(from)
                $mail->Password   = "bbmu foxp xjpq cdmn";            // GMAIL password(from)
                $mail->SetFrom('neelsarvaiya11@gmail.com', 'neelsarvaiya11@gmail.com'); //from
                $mail->AddReplyTo("neelsarvaiya11@gmail.com", "$email"); //to
                $mail->Subject    = "Account Verification Link";
                $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
                $mail->MsgHTML($body);

                $mail->AddAddress($to, "neelsarvaiya11@gmail.com");
                if (!$mail->Send()) {
                    setcookie('error', 'Failed to send the registration link', time() + 5);
                } else {
                    setcookie('success', 'Registration Successfull. Account verification link has been sent to your email. Verify your email to login.', time() + 3, "/");
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