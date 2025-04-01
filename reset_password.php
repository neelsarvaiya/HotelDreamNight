<?php include 'inc/header.php'; ?>

<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <div class="container py-5">
            <div class="card reset-card">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4">Reset Password</h2>
                    <p class="text-muted text-center mb-4">Please enter your new password below.</p>

                    <form action="reset_password.php" method="post">
                        <div class="mb-4">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" placeholder="Enter new password"
                                data-validation="required strongPassword min max" data-min="8" data-max="25" name="newPassword">
                            <div class="error" id="newPasswordError"></div>
                        </div>

                        <div class="mb-4">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm new password"
                                data-validation="required confirmPassword" data-password-id="newPassword" name="confirmPassword">
                            <div class="error" id="confirmPasswordError"></div>
                        </div>

                        <button type="submit" class="btn btn-outline-danger w-100 mb-3" name="reset_pwd_btn">Update Password</button>

                        <div class="text-center">
                            <a href="index.php" class="text-danger text-decoration-none">Back to Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'inc/footer.php';
if (isset($_POST['reset_pwd_btn'])) {
    if (isset($_SESSION['forgot_email'])) {
        $email = $_SESSION['forgot_email'];
        $password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);

        // Update the user's password in the users table (assuming the table is named 'users')
        $update_query = "UPDATE register SET password = '$password' WHERE email = '$email'";
        if (mysqli_query($conn, $update_query)) {
            // Delete the token from the password_token table
            $delete_query = "DELETE FROM password_token WHERE email = '$email'";
            mysqli_query($conn, $delete_query);
            unset($_SESSION['forgot_email']);

            echo "<script>alert('Password reset successfully. Please login with your new password.');</script>";
?>

            <script>
                window.location.href = 'index.php';
            </script>
        <?php

        } else {
            setcookie('error', 'Error in resetting Password.', time() + 5, '/');
        ?>

            <script>
                window.location.href = 'forgot_password.php';
            </script>
<?php


        }
    }
}