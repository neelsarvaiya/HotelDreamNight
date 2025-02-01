<nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php" style="text-shadow: 4px 2px 4px rgba(0, 0, 0, 0.5);"> <img src="img/logo.png" width="110px">DreamNights</a>
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

            session_start();

            if (isset($_POST['email'])) {
                $_SESSION['email'] = $_POST['email'];
            }

            if (isset($_SESSION['email']) && $_SESSION['email'] == "kkanjariya630@rku.ac.in") {
                echo '<div class="dropdown mx-5">
  <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="img/profile.jpg" width="30px" height="30px" class="rounded-circle"> Николай 
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" href="user-profile.php"><i class="bi bi-file-earmark-person"></i> Profile</a></li>
    <li><a class="dropdown-item" href="review & rating.php"><img src="img/star.png" style="height: 25px; margin-left: -5px;"> Review & Reating</a></li>
    <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-in-left"></i> logout</a></li>
  </ul>
</div>';
            } else {
                echo '<div class="d-flex">
            <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal"
            data-bs-target="#loginModal">
              <i class="bi bi-box-arrow-right"></i> Login
            </button>
            <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal"
            data-bs-target="#registerModal">
             <i class="bi bi-person-lines-fill fs-5"></i> Register
            </button>
          </div>';
            }
            ?>
        </div>
    </div>

</nav>

<style>
    .user {
        padding: 5px 15px;
        border-radius: 5px;
        border: 1px solid;
    }

    .user a {
        color: black;
        text-decoration: none;
    }

    .user:hover {
        background-color: black;
    }

    a:hover {
        color: white;
    }
</style>

<script>
    const navLink = document.querySelectorAll('.nav-link');
    const windowPathName = window.location.pathname;

    navLink.forEach(navLink => {
        if (navLink.href.includes(windowPathName)) {
            navLink.classList.add('active');
        }
    });
</script>

<script src="script/jquery-3.7.1.js"></script>
<script src="script/jquery.validate.min.js"></script>

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
                        <input type="email" name="email" id="email" class="form-control shadow-none" shadow-none placeholder="Enter Your Email :">
                    </div>
                    <div class="mb-4">
                        <label for="password1" class="form-label">Password</label>
                        <input type="password" id="password1" name="password1" class="form-control shadow-none" shadow-none placeholder="Enter Your Password :">
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadow-none" name="login">Login</button>
                        <a href="#" class="text-secondary text-decoration-none" data-bs-toggle="modal" data-bs-target="#forgot" data-bs-dismiss="modal"> Forgot
                            Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="forgot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    </i><img src="img/forgot-password.png" class="me-2" style="height: 29px;"> Forgot Password
                </h5>

            </div>
            <form id="forgot_form" method="post">
                <div class="modal-body">
                    <div class="text mb-4 bg-info p-2 rounded-pill">
                        Note: We will be sent a link to Your email to reset your password.
                    </div>
                    <div class="mb-4">
                        <label for="reponse" class="form-label">Enter Email : </label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>

                    <div class="d-flex align-items-end justify-content-between mb-2">
                        <button type="submit" class="btn btn-success shadow" name="login">Send</button>
                        <button type="submit" class="btn btn-secondary shadow" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal" name="login">
                            cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $("#forgot_form").validate({
            rules: {
                email: {
                    required: true,
                    emailValidation: true,
                },
            },
            messages: {
                email: {
                    required: "Email is required.",
                    emailValidation: "Please enter a valid email address.",
                }
            }
        })
    });
</script>

<script>
    $(document).ready(function() {
        $.validator.addMethod("emailValidation", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
        }, "Please enter a valid email address.");

        $.validator.addMethod("password", function(value, element) {
            const passwordPattern = /^(?=.[a-z])(?=.[A-Z])(?=.\d)(?=.[@$!%?&])[A-Za-z\d@$!%?&]{8}$/;
            return this.optional(element) || passwordPattern.test(value);
        }, "Password must be 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.");


        $("#loginform").validate({
            rules: {
                email: {
                    required: true,
                    emailValidation: true,
                },
                password1: {
                    required: true,
                    password: true
                }
            },
            messages: {
                email: {
                    required: "Email is required",
                    email: "Please enter a valid email address"
                },
                password1: {
                    required: "Please provide a password"
                }
            }
        })
    });
</script>

<?php
if (isset($_POST['login'])) {
}
?>

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
                <form id="registerform" action="index.php" method="post" enctype="multipart/form-data">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label" for="name">Full Name : </label>
                                <input type="text" class="form-control shadow-none" id="name" name="name" shadow-none placeholder="Enter Full Name :">
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label for="email" class="form-label">Email : </label>
                                <input type="email" id="email1" class="form-control shadow-none" name="email" shadow-none placeholder="Enter Your Email :">
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label" for="phone">Phone number : </label>
                                <input type="tel" name="phone" id="phone" class="form-control shadow-none" shadow-none placeholder="Enter Your Phone number :">
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label for="pic" class="form-label">Picture : </label>
                                <input type="file" id="pic" name="pic" class="form-control shadow-none" shadow-none>
                            </div>
                            <div class="col-md-12 p-0 mb-3">
                                <label for="address" class="form-label">Address : </label>
                                <textarea class="form-control shadow-none" id="address" name="address"
                                    rows="1" placeholder="Enter Your Address :"></textarea>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label for="pin" class="form-label">Pincode number : </label>
                                <input type="number" id="pin" name="pin" class="form-control shadow-none" placeholder="Enter Your PINCODE :">
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label for="dob" class="form-label">Date of Birth : </label>
                                <input type="date" id="dob" name="dob" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label for="password2" class="form-label">Password : </label>
                                <input type="password" id="password2" name="password2"
                                    class="form-control shadow-none" placeholder="Enter Your Password :">
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label for="password3" class="form-label">Confirm Password : </label>
                                <input type="password" id="password3" name="password3"
                                    class="form-control shadow-none" placeholder="Enter Your Confirm Password :">
                            </div>
                        </div>
                    </div>
                    <div class="text-center my-1">
                        <button type="submit" name="Pic_submit" class="btn btn-dark shadow-none">Register</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_POST['Pic_submit'])) {

    $ftype = $_FILES['pic']['type'];
    $fsize = $_FILES['pic']['size'];
    if ($ftype == "image/png" || $ftype == "image/jpg") {

        if ($fsize <= 1024 * 1024) {

            if (!is_dir("uploads")) {
                mkdir("uploads");
            }

            $fname = uniqid() . $_FILES['pic']['name'];
            if (move_uploaded_file($_FILES['pic']['tmp_name'], "uploads/" . $fname)) {
                echo "<script>
                            alert('Registration SuccessFully...');
                            window.location.href = 'index.php';
                      </script>";
            }
        } else {
?>
            <script>
                alert('File is larger than 1 KB. Please select a smaller file.')
            </script>

        <?php
        }
    } else {
        ?>
        <script>
            alert('File is not a png or jpg file')
        </script>
<?php
    }
}
?>

<script>
    $(document).ready(function() {

        $.validator.addMethod("nameValidation", function(value, element) {
            return this.optional(element) || /^[A-Za-z\s]+$/.test(value);
        }, "Name can only contain letters and spaces.");

        $.validator.addMethod("emailValidation", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
        }, "Please Enter a valid email address.");

        $.validator.addMethod("phoneValidation", function(value, element) {
            const phonepattern = /^(?:\d{10})$/;
            return this.optional(element) || phonepattern.test(value);
        }, "Please Enter a valid Indian phone number.");

        $.validator.addMethod("fileRequired", function(value, element) {
            return element.files.length > 0;
        }, "Please select a file.");

        $.validator.addMethod("password", function(value, element) {
            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&#])[A-Za-z\d@$!%?&#]{8}$/;
            return this.optional(element) || passwordPattern.test(value);
        }, "Password must be 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.");

        $("#registerform").validate({
            rules: {
                name: {
                    required: true,
                    nameValidation: true,
                    maxlength: 15,
                    minlength: 2
                },
                email: {
                    required: true,
                    emailValidation: true,
                },
                phone: {
                    required: true,
                    phoneValidation: true
                },
                address: {
                    required: true,
                    maxlength: 40
                },
                password2: {
                    required: true,
                    minlength: 8
                },
                password3: {
                    required: true,
                    equalTo: "#password2"
                },
                pic: {
                    required: true,
                    fileRequired: true
                },
                dob: {
                    required: true,
                    date: true
                },
                pin: {
                    required: true,
                    digits: true,
                    minlength: 6,
                    maxlength: 6
                }
            },
            messages: {
                name: {
                    required: "FullName is required",
                    pattern: "Name can only contain letters and spaces",
                    minlength: "Please atlest 2 Character"
                },
                email: {
                    required: "Email is required",
                    email: "Please enter a valid email address"
                },
                phone: {
                    required: "Phone number is required",
                    pattern: "Please enter a valid Indian phone number",
                },
                address: {
                    required: "Address is required",
                    maxlength: "Maximum lenth of Address is 40 Characters "
                },
                password2: {
                    required: "Please Enter Your Password",
                    minlength: "Password must be at least 8 characters long."
                },
                password3: {
                    required: "Please confirm your password.",
                    equalTo: "Passwords do not match."
                },
                pic: {
                    required: "Please select a file."
                },
                dob: {
                    required: "Please enter your Date Of Birth ",
                    date: "Please enter valid date"
                },
                pin: {
                    required: "Please enter your PINCODE ",
                    digits: "only Digit is Allowed",
                    minlength: "Please Enter Minimum 6 Digits",
                    maxlength: "Please Enter Maxiimum 6 Digits"
                }
            }
        })
    });
</script>