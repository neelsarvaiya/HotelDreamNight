<?php
include 'inc/header.php';

?>
<?php
if (isset($_POST['otp_btn'])) {
    if (isset($_SESSION['forgot_email'])) {
        $email = $_SESSION['forgot_email'];
        $otp = $_POST['otp'];

        // Fetch the OTP from the database for the given email
        $query = "SELECT otp FROM password_token WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $db_otp = $row['otp'];
            if (!$db_otp) {
                setcookie('error', 'OTP has expired. Regenerate New OTP', time() + 5, '/');
?>
                <script>
                    window.location.href = 'forgot_password.php';
                </script>
                <?php
            }
            // Compare the OTPs
            else {
                if ($otp == $db_otp) {
                    // Redirect to new password page
                ?>
                    <script>
                        window.location.href = 'reset_password.php';
                    </script>
                <?php

                } else {
                    setcookie('error', 'Incorrect OTP', time() + 5, '/');
                ?>

                    <script>
                        a = '⚠ "Incorrect OTP!" ... Please Enter Correct OTP';
                        alert(a);
                        window.location.href = 'otp_form.php';
                    </script>
            <?php
                }
            }
        } else {
            setcookie('error', 'OTP has expired. Regenerate New OTP', time() + 5, '/');
            ?>
            <script>
                window.location.href = 'forgot_password.php';
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert('Session Expired. Please try again.');
        </script>
<?php
    }
}
?>
<div class="container py-5 col-lg-4">
    <div class="card otp-card">
        <div class="card-body p-4">
            <h2 class="text-center mb-4">Enter OTP</h2>
            <p class="text-muted text-center mb-4">Please enter the verification code sent to your email</p>

            <form method="post">
                <div class="justify-content-center mb-4 ">
                    <div class="mb-3">
                        <label for="email" class="form-label ms-1"> OTP : </label>
                        <input type="number" name="otp" id="otp" class="form-control shadow-none" placeholder="Enter OTP :" data-validation="required max min" data-max="6" data-min="6">
                        <div class="error" id="otpError"></div>
                    </div>
                </div>

                <div id="timer" class="text-danger"></div>
                <br>
                <div class="d-flex justify-content-center mb-4">
                    <button type="button" id="resend_otp" class="btn text-white w-100" style="display:none;background-color:  #dc3545;">Resend OTP
                    </button>
                </div>
                <script>
                    let timeLeft = 10; // Default timer value
                    const timerDisplay = document.getElementById('timer');
                    const resendButton = document.getElementById('resend_otp');

                    // Function to check if the user is refreshing or coming from another page
                    function isPageRefresh() {
                        return !!sessionStorage.getItem('otpTimer'); // If otpTimer exists, it's a refresh
                    }

                    // If the page is refreshed, use sessionStorage value
                    if (isPageRefresh()) {
                        timeLeft = parseInt(sessionStorage.getItem('otpTimer'), 10);
                    } else {
                        // If the user comes from another page, reset timer
                        sessionStorage.setItem('otpTimer', 10);
                        timeLeft = 10;
                    }

                    function startCountdown() {
                        resendButton.style.display = "none"; // Hide the button initially
                        timerDisplay.innerHTML = `Resend OTP in ${timeLeft} seconds`;

                        const countdown = setInterval(() => {
                            if (timeLeft <= 0) {
                                clearInterval(countdown);
                                timerDisplay.innerHTML = "You can now resend the OTP.";
                                resendButton.style.display = "inline";
                                sessionStorage.removeItem('otpTimer'); // Clear sessionStorage after timer ends
                            } else {
                                timerDisplay.innerHTML = `Resend OTP in ${timeLeft} seconds`;
                                timeLeft -= 1;
                                sessionStorage.setItem('otpTimer', timeLeft); // Update sessionStorage
                            }
                        }, 1000);
                    }

                    // Start countdown only if the timer is above 0
                    if (timeLeft > 0) {
                        startCountdown();
                    } else {
                        resendButton.style.display = "inline";
                        timerDisplay.innerHTML = "You can now resend the OTP.";
                    }

                    resendButton.onclick = function(event) {
                        event.preventDefault(); // Prevent default form submission
                        sessionStorage.setItem('otpTimer', 10); // Reset timer
                        window.location.href = 'resend_otp_forggot_password.php';
                    };
                </script>
                <input type="submit" class="btn btn-outline-danger w-100 mb-3" value="Verify OTP" name="otp_btn">
            </form>


            <div class="text-center">
                <a href="index.php" class="text-danger text-decoration-none">Back to Login</a>
            </div>

        </div>
    </div>
</div>

<script>
    function moveToNext(input, index) {
        if (input.value.length === input.maxLength) {
            if (index < 5) {
                input.parentElement.children[index + 1].focus();
            }
        }
    }
</script>

<?php include 'inc/footer.php';
?>