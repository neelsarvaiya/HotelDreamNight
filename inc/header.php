
<?php

if (isset($_COOKIE['success'])) {
?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Success!</strong> <?php echo $_COOKIE['success']; ?>.
    </div>
<?php
}

if (isset($_COOKIE['error'])) {
?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>⚠ Error!</strong> <?php echo $_COOKIE['error']; ?>.
    </div>
<?php
}

if (isset($_COOKIE['userExist'])) {
?>
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Info!</strong> <?php echo $_COOKIE['userExist']; ?>.
    </div>
<?php
}

include_once('Admin/connection.php');
include_once('mailer.php');

session_start();

if (isset($_POST['pass_btn'])) {
    $enterd_pass = $_POST['oldpass'];
    $email = $_SESSION['user'];
    $select = "select * from register where `Email` = '$email'";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $select));
    if (password_verify($enterd_pass, $result['Password'])) {

        $newpass = password_hash($_POST['newpass'], PASSWORD_DEFAULT);

        $update = "UPDATE `register` SET `Password`='$newpass'";
        if (mysqli_query($conn, $update)) {
            setcookie('success', 'Password Changed Successfully.', time() + 5, '/');
        } else {
            setcookie('error', 'Password is not Changed.', time() + 5, '/');
        }
    } else {
        setcookie('error', 'Old Password is Wrong.', time() + 5, '/');
    }

?>
    <script>
        window.location.href = "user-profile.php";
    </script>
<?php
    date_default_timezone_set('Asia/Kolkata');
    $current_time = date("Y-m-d H:i:s");
    // $delete_query = "DELETE FROM password_token WHERE expires_at < '$current_time'";
    // $con->query($delete_query);
    $q = "UPDATE password_token 
SET otp_attempts = 0 
WHERE TIMESTAMPDIFF(HOUR, last_resend, NOW()) >= 24";
    $con->query($q);
    $remove_otp = "update password_token set otp=NULL WHERE expires_at < '$current_time'";
    $con->query($remove_otp);
}
?>
<?php

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `register` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $sql);

    $data = mysqli_fetch_assoc($result);
    if ($email === $data['Email']) {
        if (password_verify($password, $data['Password'])) {
            if ($data['status'] === "active") {
                if ($data['role'] === "user") {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['profile_pic'] = $data['Profile_pic'];
                    $_SESSION['name'] = $data['Full_Name'];
                    $_SESSION['user'] = $data['Email'];
?>
                    <script>
                        window.location.href = "index.php";
                    </script>
                <?php
                    exit;
                } else {
                    $_SESSION['admin'] = $data['Email'];
                ?>
                    <script>
                        window.location.href = "Admin/dashbord.php";
                    </script>
                <?php
                    exit;
                }
            } else {
                setcookie("error", "Your Email Is Not Verifyed", time() + 3, "/");
                ?>
                <script>
                    window.location.href = "index.php";
                </script>
            <?php
                exit;
            }
        } else {
            setcookie("error", "Wrong Password", time() + 3, "/");
            ?>
            <script>
                window.location.href = "index.php";
            </script>
        <?php
            exit;
        }
    } else {
        setcookie("error", "Email Not Registered", time() + 3, "/");
        ?>
        <script>
            window.location.href = "index.php";
        </script>
<?php
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamNights Hotel</title>
    <link rel="stylesheet" href="css/common.css">
    <link href="script/bootstrap.min.css" rel="stylesheet">
    <link href="script/font.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="script/bootstrap.bundle.min.js"></script>
    <script src="script/jquery-3.7.1.js"></script>
    <script src="script/validate.js"></script>
</head>

<body class="bg-light">


    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow sticky-top">
        <div class="container-fluid">
            <?php
            $select = "SELECT * FROM settings";
            $res = mysqli_query($conn, $select);
            $row = mysqli_fetch_assoc($res);
            ?>
            <a class="navbar-brand me-5 fw-bold fs-3 h-font loader" href="index.php" style="text-shadow: 4px 2px 4px rgba(0, 0, 0, 0.5);"><?= $row['site_title'] ?></a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link me-2" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="rooms.php">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="facilities.php">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                </ul>
                <style>
                    .loader {
                        animation: spin 2s linear infinite;
                    }

                    @keyframes spin {
                        0% {
                            transform: rotate(0deg);
                        }

                        40% {
                            transform: rotate(1.9deg);
                        }

                        80% {
                            transform: rotate(-1.9deg);
                        }

                        100% {
                            transform: rotate(0deg);
                        }
                    }

                    @media screen and (max-width: 1073px) {
                        .nav-link {
                            font-size: 15px;
                            font-weight: 500;
                        }
                    }

                    @media screen and (max-width: 1055px) {
                        .nav-link {
                            font-size: 14px;
                            font-weight: 500;
                        }
                    }

                    @media screen and (max-width: 1033px) {
                        .nav-link {
                            font-size: 13px;
                            font-weight: 500;
                        }
                    }

                    @media screen and (max-width: 1011px) {
                        .nav-link {
                            font-size: 12px;
                            font-weight: 400;
                        }
                    }
                </style>
                <?php

                if (isset($_SESSION['logged_in'])) {
                ?>
                    <div class="dropdown mx-2 w-90">
                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            $email = $_SESSION['user'];
                            $select = "SELECT * FROM register WHERE Email='$email'";
                            $result = mysqli_fetch_assoc(mysqli_query($conn, $select));
                            ?>
                            <img src="img/userProfile/<?= $result['Profile_pic'] ?>" height="30px" width="30px" class="rounded-circle"> <?= $result['Full_Name'] ?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="user-profile.php"><i class="bi bi-file-earmark-person"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="history.php"><i class="bi bi-bed"></i>Bookings</a></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-in-left"></i> logout</a></li>
                        </ul>
                    </div>
                <?php
                } else {
                ?>
                    <div class="d-flex">
                        <button type="button" class="btn border-1 hobl border-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal"
                            data-bs-target="#loginModal">
                            <i class="bi bi-box-arrow-right"></i> Log in
                        </button>
                        <style>
                            .hobl:hover {
                                background-color: rgba(228, 228, 228, 0.39);
                                color: black;
                            }
                        </style>
                        <button type="button" class="btn bg-dark text-white shadow-none" data-bs-toggle="modal"
                            data-bs-target="#registerModal">
                            <i class="bi bi-person-lines-fill fs-5"></i> Sign up
                        </button>
                    </div>
                <?php
                }

                ?>
            </div>
        </div>
    </nav>

    <script>
        const navLink = document.querySelectorAll('.nav-link');
        const windowPathName = window.location.pathname;

        navLink.forEach(navLink => {
            if (navLink.href.includes(windowPathName)) {
                navLink.classList.add('active');
            }
        });
    </script>

    <!-- Login Model -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center h-font">
                        <i class="bi bi-person-plus-fill fs-3 me-2"></i> Login
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="loginform" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" id="email" class="form-control shadow-none" placeholder="Enter Your Email :" data-validation="required email">
                            <div class="error" id="emailError"></div>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control shadow-none" placeholder="Enter Your Password :" data-validation="required strongPassword">
                            <div class="error" id="passwordError"></div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow-none" name="login">Login</button>
                            <a href="#" class="text-secondary text-decoration-none" data-bs-toggle="modal" data-bs-target="#forgot" data-bs-dismiss="modal">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Forget Model -->
    <div class="modal fade" id="forgot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center h-font">
                        <img src="img/forgot-password.png" class="me-2" style="height: 29px;"> Forgot Password
                    </h5>
                </div>
                <form action="forgot_password.php" id="forgot_form" method="post">
                    <div class="modal-body">
                        <div class="text mb-4">
                            Note: We will be sent a link to Your email to reset your password.
                        </div>
                        <div class="mb-4">
                            <label for="forgot_email" class="form-label">Enter Email : </label>
                            <input type="email" name="forgot_email" id="forgot_email" class="form-control" data-validation="required email">
                            <div class="error" id="forgot_emailError"></div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mb-2">
                            <button type="submit" class="btn btn-success shadow" name="forgot_btn">Send</button>
                            <button type="submit" class="btn btn-secondary shadow" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal" name="login">
                                cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Register Model -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center h-font">
                        <i class="bi bi-person-vcard-fill fs-3 me-2"></i>
                        Register
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="badge rounded-pill bg-info text-dark mb-3 text-wrap lh-base h-font">
                        Note : Your details must match with your ID (Aadhaar card, Passport, Driving license, ect.)
                        That will be required during check-in.
                    </span>
                    <form id="registerform" action="registration.php" method="post" enctype="multipart/form-data">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label" for="name">Full Name : </label>
                                    <input type="text" class="form-control shadow-none" id="name" name="name" placeholder="Enter Full Name :" data-validation="required alpha min" data-min="2">
                                    <div class="error" id="nameError"></div>
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label for="registrationEmail" class="form-label">Email : </label>
                                    <input type="email" id="registrationEmail" class="form-control shadow-none" name="registrationEmail" placeholder="Enter Your Email :" data-validation="required email">
                                    <div class="error" id="registrationEmailError"></div>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label" for="phone">Phone number : </label>
                                    <input type="tel" name="phone" id="phone" class="form-control shadow-none" placeholder="Enter Your Phone number :" data-validation="required numeric min max" data-max="10" data-min="10">
                                    <div class="error" id="phoneError"></div>
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label for="pic" class="form-label">Picture : </label>
                                    <input type="file" id="pic" name="pic" class="form-control shadow-none" data-validation="required file file1">
                                    <div class="error" id="picError"></div>
                                </div>
                                <div class="col-md-12 p-0 mb-3">
                                    <label for="address" class="form-label">Address : </label>
                                    <textarea class="form-control shadow-none" id="address" name="address"
                                        rows="1" placeholder="Enter Your Address :" data-validation="required min max" data-min="10" data-max="50"></textarea>
                                    <div class="error" id="addressError"></div>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label for="state" class="form-label">State : </label>
                                    <input type="text" name="state" id="state" class="form-control shadow-none" data-validation="required " placeholder="Enter state:">
                                    <div class="error" id="stateError"></div>
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label for="dob" class="form-label">Date of Birth : </label>
                                    <input type="date" id="dob" name="dob" class="form-control shadow-none" data-validation="required">
                                    <div class="error" id="dobError"></div>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label for="registerPassword" class="form-label">Password : </label>
                                    <input type="password" id="registerPassword" name="registerPassword"
                                        class="form-control shadow-none" placeholder="Enter Your Password :" data-validation="required strongPassword">
                                    <div class="error" id="registerPasswordError"></div>
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label for="C_password" class="form-label">Confirm Password : </label>
                                    <input type="password" id="C_password" name="C_password"
                                        class="form-control shadow-none" placeholder="Enter Your Confirm Password :" data-validation="required confirmPassword" data-password-id="registerPassword">
                                    <div class="error" id="C_passwordError"></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center my-1">
                            <button type="submit" name="register" class="btn btn-dark shadow-none">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>