<?php
include('inc/header.php');
include_once('Admin/connection.php');
include_once('mailer.php');

if (isset($_POST['forgot_btn'])) {

    $select = "SELECT * FROM register WHERE email = '" . $_POST['forgot_email'] . "'";
    if ($conn->query($select)->num_rows == 0) {

        echo "<script> alert('Email is not registerd'); </script>";
?>
        <script>
            window.location.href = "index.php";
        </script>
        <?php
    } else {

        $email = $_POST['forgot_email'];

        $query = "SELECT * FROM password_token WHERE email = '$email'";
        $result = mysqli_fetch_assoc($conn->query($query));
        $otp = rand(100000, 999999);
        $body = "<html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 5px; }
                h1 { color: black; }
                .otp { font-size: 24px; font-weight: bold; color:rgb(0, 0, 0); }
                .footer { margin-top: 20px; font-size: 0.8em; color: #777; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>Forgot Your Password?</h1>
                <p>We received a request to reset your password. Here is your One-Time Password (OTP):</p>
                <p class='otp'>$otp</p>
                <p>Please enter this OTP on the website to proceed with resetting your password.</p>
                <p>If you did not request a password reset, please ignore this email.</p>
                <div class='footer'>
                    <p>This is an automated message, please do not reply to this email.</p>
                </div>
            </div>
        </body>
        </html>
        ";

        $subject = "Password Reset - OTP";
        $email_time = date("Y-m-d H:i:s");
        $expiry_time = date("Y-m-d H:i:s", strtotime('+2 minutes'));

        if ($result) {
            $attempts = $result['otp_attempts'];
            if ($attempts >= 3) {
                // Email exists, display error message and redirect to OTP form
                setcookie('error', "The maximum limit for generating OTP is reached you can generate a new OTP after 24 hours from the last OTP generated time.", time() + 5, "/");
        ?>
                <script>
                    window.location.href = "index.php";
                </script>
            <?php
            } else {
                $q = "UPDATE password_token SET otp=$otp, otp_attempts=$attempts+1, last_resend=now(), created_at = '$email_time', expires_at='$expiry_time' WHERE email='$email'";
            }
        } else {
            $attempts = 0;
            $q = "INSERT INTO  password_token  (email, otp, created_at,expires_at,otp_attempts,last_resend) VALUES ('$email', '$otp', '$email_time','$expiry_time',$attempts,now())";
        }
        if (sendEmail($email, $subject, $body, "")) {
            if ($conn->query($q)) {
                $_SESSION['forgot_email'] = $email;
                echo "<script>alert('OTP sent successfully to your email. Expierd in 2 min...');</script>";
            ?>
                <script>
                    window.location.href = "otp_form.php";
                </script>
<?php
            } else {
                echo "<script> alert('Failed to generate OTP and store it in the database'); </script>";
            }
        } else {
            echo "<script> alert('Failed to send the OTP in mail. Please try after sometime.'); </script>";
        }
    }
}
?>