<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamNights Hotel | Contact Us </title>
    <?php
    require('inc/link.php');
    ?>
</head>

<body class="bg-light">

    <?php
    require('inc/header.php');
    ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Contact Us</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            For any questions or assistance, Dream Night Hotel is here to help. You can reach us via phone, email, or through our website’s contact form. Our dedicated team is available 24/7 to assist with reservations, or any concerns you may have. We strive to ensure a seamless experience and are eager to make your stay memorable. We look forward to hearing from you! </p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <iframe class="w-100 rounded mb-4" height="320px"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118147.82106509873!2d70.73889453087791!3d22.273466166686283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959c98ac71cdf0f%3A0x76dd15cfbe93ad3b!2sRajkot%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1734684297133!5m2!1sen!2sin"
                        loading="lazy"></iframe>
                    <h5 class="h-font">Address</h5>
                    <a href="https://maps.app.goo.gl/Pg78hefLGBEVynax8" target="_blank"
                        class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-geo-alt-fill"></i> DreamNights Hotel , Kalavad Road, Rajkot-360005
                    </a>
                    <h5 class="mt-4 h-font">Call Us</h5>
                    <a href="tel: +917778889991" class="d-inline-block mb-2 text-decoration-none text-dark"><i
                            class="bi bi-telephone-fill"></i> +917778889991</a><br>
                    <a href="tel: +917778889991" class="d-inline-block text-decoration-none text-dark"><i
                            class="bi bi-telephone-fill"></i> +917778889991</a>
                    <h5 class="mt-4 h-font">Email : </h5>
                    <a href="#" class="d-inline-block text-decoration-none text-dark">
                        <i class="bi bi-envelope-fill"></i> kkanjariya630@rku.ac.in
                    </a>
                    <h5 class="mt-4 h-font">Follow Us</h5>
                    <a href="#" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-twitter me-1"></i>
                    </a>
                    <a href="#" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-facebook me-1"></i>
                    </a>
                    <a href="#" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-instagram me-1"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 px-4">
                <div class="bg-white rounded shadow p-4">
                    <form id="send">
                        <h5 class="h-font">Send a messages :</h5>
                        <div class="mt-3">
                            <label for="name" class="form-label" style="font-weight: 500;">Name : </label>
                            <input type="text" name="name" id="name" class="form-control shadow-none" shadow-none placeholder="Enter Your Name :">
                        </div>
                        <div class="mt-3">
                            <label for="email" class="form-label">Email : </label>
                            <input type="email" name="email" id="email" class="form-control shadow-none" shadow-none placeholder="Enter Your Email :">
                        </div>
                        <div class="mt-3">
                            <label for="subject" class="form-label">Subject : </label>
                            <input type="text" name="subject" id="subject" class="form-control shadow-none" shadow-none placeholder="Enter Your Subject :">
                        </div>
                        <div class="mt-3">
                            <label for="messages" class="form-label">Messages : </label>
                            <textarea class="form-control shadow-none" id="messages" name="messages" rows="7"
                                style="resize: none" placeholder="Enter Your Messages :"></textarea>
                        </div>
                        <button type="submit" class="btn text-white custom-bg mt-3 ">SEND</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    require('inc/footer.php');
    ?>

    <script src="script/jquery-3.7.1.js"></script>
    <script src="script/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $.validator.addMethod("emailValidation", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
            }, "Please enter a valid email address.");

            $.validator.addMethod("nameValidation", function(value, element) {
                return this.optional(element) || /^[A-Za-z\s]+$/.test(value);
            }, "Name can only contain letters and spaces.");


            $("#send").validate({
                rules: {
                    email: {
                        required: true,
                        emailValidation: true,
                    },
                    name: {
                        required: true,
                        nameValidation: true,
                        maxlength: 15,
                        minlength: 2
                    },
                    subject: {
                        required: true,
                        maxlength: 20,
                        minlength: 8
                    },
                    messages: {
                        required: true,
                        minlength: 10,
                        maxlength: 50
                    }

                },
                messages: {
                    email: {
                        required: "Email is required",
                        email: "Please enter a valid email address"
                    },
                    name: {
                        required: "Name is required",
                        pattern: "Name can only contain letters and spaces",
                        minlength: "Please atlest 2 Characters"
                    },
                    subject: {
                        required: "Subject is required ",
                        maxlength: "Maximum you can enter 20 characters",
                        minlength: "Minimum length is 8 characters"
                    },
                    messages: {
                        required: "Message is required",
                        minlength: "Minimum length is 10 characters",
                        maxlength: "Maximum length is 50 characters"
                    }

                }
            })
        });
    </script>

</body>

</html>