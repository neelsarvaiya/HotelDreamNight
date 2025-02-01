<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Settings</title>
</head>

<body>
    <?php
    require('inc/admin-header.php');
    ?>

    <div class="card container mt-5 p-4 border-2">
        <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Contact Settings
            <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#contact">
                Edit
            </button>
        </div>
        <div class="card-body">
            <div class="row d-flex align-items-center justify-content-between">
                <div class="col-lg-6">
                    <h5 class="card-title fw-bold mb-3">Address</h5>
                    <p><i class="bi bi-geo-alt-fill"></i> DreamNights Hotel , Kalavad Road, Rajkot-360005</p>

                    <h5 class="card-title fw-bold mb-3">Google map</h5>

                    <h5 class="card-title fw-bold mb-3">Phone Number</h5>
                    <p><i class="bi bi-telephone-fill"></i> +917778889991 <br> <i class="bi bi-telephone-fill"></i> +917778885191</p>

                    <h5 class="card-title fw-bold mb-3">E-mail</h5>
                    <p><i class="bi bi-envelope-fill"></i> kkanjariya630@rku.ac.in</p>

                </div>
                <div class="col-lg-6 mt-5">
                    <h5 class="fw-bold mb-3">Social link</h5>
                    <p>
                        <i class="bi bi-twitter me-1"></i> Twitter <br>
                        <i class="bi bi-facebook me-1"></i> FaceBook <br>
                        <i class="bi bi-instagram  me-1"></i> Instagram
                    </p>

                    <h5 class="fw-bold mb-3">iFrame</h5>
                    <p> <iframe class="w-100 img-thumbnail border-2 border-dark rounded mb-4"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118147.82106509873!2d70.73889453087791!3d22.273466166686283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959c98ac71cdf0f%3A0x76dd15cfbe93ad3b!2sRajkot%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1734684297133!5m2!1sen!2sin"
                            loading="lazy">
                        </iframe>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card container mt-5 p-4 border-2 mb-4">
        <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Team Management
            <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#m_team">
                Edit
            </button>
        </div>
        <div class="card-body bg-dark">
            <div class="row  d-flex align-items-center justify-content-between">
                <div class="col-lg-3 col-md-12">
                    <div class="swiper-slide bg-white text-center overflow-hidden rounded mb-sm-3 mb-md-2">
                        <img src="img/about/team1.webp" class="w-100 ">
                        <div class="d-flex align-items-center justify-content-between m-2 mx-3 m-xs-0 non">
                            <h5 class="mt-2 fw-bold">Ethan Miller</h5>
                            <button class="btn btn-danger btn-md">Delete</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="swiper-slide bg-white text-center overflow-hidden rounded mb-sm-3 mb-md-2">
                        <img src="img/about/team2.webp" class="w-100">
                        <div class="d-flex align-items-center justify-content-between m-2 mx-3 m-xs-0 non">
                            <h5 class="mt-2 fw-bold">Daniel Wilson</h5>
                            <button class="btn btn-danger btn-md">Delete</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="swiper-slide bg-white text-center overflow-hidden rounded mb-sm-3 mb-md-2">
                        <img src="img/about/team3.webp" class="w-100">
                        <div class="d-flex align-items-center justify-content-between m-2 mx-3 m-xs-0 non">
                            <h5 class="mt-2 fw-bold">Alexander Brown</h5>
                            <button class="btn btn-danger btn-md">Delete</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="swiper-slide bg-white text-center overflow-hidden rounded mb-sm-3 mb-md-2">
                        <img src="img/about/team4.webp" class="w-100">
                        <div class="d-flex align-items-center justify-content-between m-2 mx-3 m-xs-0 non">
                            <h5 class="mt-2 fw-bold">Mia Anderson</h5>
                            <button class="btn btn-danger btn-md">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="contact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center h-font">
                        <i class="bi bi-person-vcard-fill fs-3 me-2"></i>
                        Contact
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="setting">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 p-0 mb-3">
                                    <label for="address" class="form-label">Address : </label>
                                    <textarea class="form-control shadow-none" id="address" name="address"
                                        rows="2" placeholder="Enter Address :"></textarea>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label" for="phone">Phone number-1 : </label>
                                    <input type="number" name="phone1" id="phone" class="form-control shadow-none" shadow-none placeholder="Enter Phone number-1 :">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label" for="icon">Social Link :</label>
                                    <input type="text" name="icon" id="icon" class="form-control shadow-none" shadow-none placeholder="Enter Social link :">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label" for="phone">Phone number-2 : </label>
                                    <input type="number" name="phone2" id="phone2" class="form-control shadow-none" shadow-none placeholder="Enter Phone number-2 :">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label for="email" class="form-label">Email : </label>
                                    <input type="email" id="email" class="form-control shadow-none" name="email" shadow-none placeholder="Enter Email :">
                                </div>
                                <div class="col-md-12 p-0 mb-3">
                                    <label for="map" class="form-label">Map Link : </label>
                                    <textarea class="form-control shadow-none" id="map" name="map"
                                        rows="2" placeholder="Enter Map link :"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="my-1">
                            <button type="submit" class="btn btn-success shadow-none">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="m_team" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center h-font">
                        <i class="bi bi-person-circle fs-3 me-2"></i> Team
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <form id="manage_team" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label for="name">Choose Photo :</label>
                        <input type="file" name="pic" id="team" class="col-md-12 form-control"> <br>

                        <label for="name">Name :</label>
                        <input type="text" name="name" placeholder="Enater Name :" class="form-control col-md-12">
                        <div class="d-flex align-items-end justify-content-between mb-2">
                            <button type="submit" name="Pic_submit" class="btn btn-dark shadow mt-2" name="login">Add</button>
                        </div>
                    </div>
                </form>
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
            </div>
        </div>
    </div>

    <h6 class="text-center bg-dark text-white p-3 m-0 h-font">@Designed and Developed by DreamNights Hotel</h6>

    <script>
        $(document).ready(function() {

            $.validator.addMethod("nameValidation", function(value, element) {
                return this.optional(element) || /^[A-Za-z\s]+$/.test(value);
            }, "Name can only contain letters and spaces.");

            $.validator.addMethod("fileRequired", function(value, element) {
                return element.files.length > 0;
            }, "Please select a file.");

            $("#manage_team").validate({
                rules: {
                    name: {
                        required: true,
                        nameValidation: true,
                    },
                    pic: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "FullName is required",
                        pattern: "Name can only contain letters and spaces",
                    },
                    pic: {
                        required: "File is requried.",
                    },
                }
            })
        });
    </script>

    <script>
        $(document).ready(function() {

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

            $("#setting").validate({
                rules: {
                    email: {
                        required: true,
                        emailValidation: true,
                    },
                    phone1: {
                        required: true,
                        phoneValidation: true
                    },
                    phone2: {
                        required: true,
                        phoneValidation: true
                    },
                    address: {
                        required: true,
                        maxlength: 40
                    },
                    icon: {
                        required: true,
                    },
                    map: {
                        required: true,
                        minlength: 10,
                        maxlength: 50
                    },

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
                    phone1: {
                        required: "Phone number is required",
                        pattern: "Please enter a valid Indian phone number",
                    },
                    phone2: {
                        required: "Phone number is required",
                        pattern: "Please enter a valid Indian phone number",
                    },
                    address: {
                        required: "Address is required",
                        maxlength: "Maximum lenth of Address is 40 Characters "
                    },
                    icon: {
                        required: "Icon name is required.",
                    },
                    map: {
                        required: "Map link is required",
                        minlength: "Minimum length is 10.",
                        maxlength: "Maximum length is 50."
                    }
                }
            })
        });
    </script>

</body>

</html>