<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamNights Hotel | Profile</title>
    <?php
    require('inc/link.php');
    ?>
</head>

<body class="bg-light">

    <?php
    require('inc/header.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12 my-5 mb-4 px-4">
                <h2 class="fw-bold">PROFILE</h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">Home</a>
                    <span class="text-secondary"> > </span>
                    <a href="#" class="text-secondary text-decoration-none">Profile</a>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 px-4 mb-5 px-5">
                <div class="card mb-4 border-0 shadow rounded-3">
                    <div class="card-body">
                        <h5 class="mb-3 fw-bold">Basic Information</h5>
                        <form action="user-profile.php" method="post" id="information">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="name">Full Name : </label>
                                    <input type="text" class="form-control shadow-none" id="name" name="name" shadow-none placeholder="Enter Full Name :">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="phone">Phone number : </label>
                                    <input type="number" name="phone" id="phone" class="form-control shadow-none" shadow-none placeholder="Enter Your Phone number :">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="dob" class="form-label">Date of Birth : </label>
                                    <input type="date" id="dob" name="dob" class="form-control shadow-none">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="pin" class="form-label">Pincode number : </label>
                                    <input type="number" id="pin" name="pin" class="form-control shadow-none" placeholder="Enter Your PINCODE :">
                                </div>
                                <div class="col-md-8 mb-4">
                                    <label for="address" class="form-label">Address : </label>
                                    <textarea class="form-control shadow-none" id="address" name="address"
                                        rows="1" placeholder="Enter Your Address :"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn text-white custom-bg shadow-none">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-md-4 px-4 mb-5 px-5">
                <div class="card mb-4 border-0 shadow rounded-3">
                    <form action="user-profile.php" method="post" enctype="multipart/form-data" id="profile_pic">
                        <div class="card-body">
                            <h5 class="mb-3 fw-bold">Picture</h5>
                            <img src="img/profile.jpg" class="img-fluid mx-md-0 rounded-circle" style="height: 300px; width: 100%;"> <br>
                            <label for="pic" class="form-label">New Picture : </label>
                            <input type="file" id="pic" name="pic" class="mb-4 form-control shadow-none" shadow-none>
                            <span id="Pic_Error"></span>
                            <button type="submit" name="Pic_submit" class="btn text-white custom-bg shadow-none">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php
            if (isset($_POST['Pic_submit'])) {

                $ftype = $_FILES['pic']['type'];
                $fsize = $_FILES['pic']['size'];
                if ($ftype == "image/png" || $ftype == "image/jpg") {

                    if ($fsize <= 1024) {

                        if (!is_dir("uploads")) {
                            mkdir("uploads");
                        }

                        $fname = uniqid() . $_FILES['pic']['name'];
                        if (move_uploaded_file($_FILES['pic']['tmp_name'], "uploads/" . $fname)) {
                            echo "<script>
                            alert('File Uploaded Successfull...')
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
            
            <div class="col-md-8 px-4 mb-5 px-5">
                <div class="card mb-4 border-0 shadow rounded-3 p-2">
                    <div class="card-body">
                        <h5 class="mb-3 fw-bold">Change Password</h5>
                        <form action="user-profile.php" method="post" id="old_new_pass">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="oldpass" class="form-label">Old Password:</label>
                                    <input type="password" id="oldpass" name="oldpass" class="form-control shadow-none" placeholder="Enter old Password:">
                                </div>
                                <div class="col-md-6">
                                    <label for="newpass" class="form-label">New Password:</label>
                                    <input type="password" id="newpass" name="newpass" class="form-control shadow-none" placeholder="Enter new Password:">
                                </div>
                            </div>
                            <button type="submit" class="btn text-white custom-bg shadow-none">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require('inc/footer.php');
    ?>

</body>
<script>
    $(document).ready(function() {
        $("#profile_pic").validate({
            rules: {
                pic: {
                    required: true,
                }
            },
            messages: {
                pic: {
                    required: "Please select a profile picture.",
                }
            },
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#old_new_pass").validate({
            rules: {
                oldpass: {
                    required: true,
                    minlength: 6
                },
                newpass: {
                    required: true,
                    minlength: 6,
                }
            },
            messages: {
                oldpass: {
                    required: "Please enter your old password.",
                    minlength: "Old password must be at least 6 characters long."
                },
                newpass: {
                    required: "Please enter a new password.",
                    minlength: "New password must be at least 8 characters long.",
                    pattern: "Password must include at least one uppercase letter, one number, and one special character."
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function() {

        $.validator.addMethod("nameValidation", function(value, element) {
            return this.optional(element) || /^[A-Za-z\s]+$/.test(value);
        }, "Name can only contain letters and spaces.");

        $.validator.addMethod("phoneValidation", function(value, element) {
            const phonepattern = /^(?:\d{10})$/;
            return this.optional(element) || phonepattern.test(value);
        }, "Please Enter a valid Indian phone number.");

        $("#information").validate({
            rules: {
                name: {
                    required: true,
                    nameValidation: true,
                    maxlength: 15,
                    minlength: 2
                },
                phone: {
                    required: true,
                    phoneValidation: true
                },
                address: {
                    required: true,
                    maxlength: 40
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
                phone: {
                    required: "Phone number is required",
                    pattern: "Please enter a valid Indian phone number",
                },
                address: {
                    required: "Address is required",
                    maxlength: "Maximum lenth of Address is 40 Characters "
                },
                dob: {
                    required: "Please enter your Date Of Birth ",
                    date: "Please enter valid date"
                },
                pin: {
                    required: "Please enter your PINCODE ",
                    digits: "only",
                    minlength: "Please Enter Minimum 6 Digits",
                    maxlength: "Please Enter Maxiimum 6 Digits"
                }
            }
        })
    });
</script>

</html>