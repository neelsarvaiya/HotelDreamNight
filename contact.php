<?php
include_once('inc/header.php');
?>

<style>
    .custom-bg {
        background-color: var(--teal);
        border: 1px solid var(--teal);
    }

    .slide-top {
        opacity: 0;
        transform: translateY(-100%);
        animation: slideTop 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
    }

    @keyframes slideTop {
        from {
            opacity: 0;
            transform: translateY(-300%);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center slide-top">Contact Us</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
        For any questions or assistance, Dream Night Hotel is here to help. You can reach us via phone, email, or through our website’s contact form. Our dedicated team is available 24/7 to assist with reservations, or any concerns you may have. We strive to ensure a seamless experience and are eager to make your stay memorable. </p>
</div>

<?php
 $select = "SELECT * FROM `contact_details`";
 $data = mysqli_fetch_assoc(mysqli_query($conn, $select));
?>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4">
                <iframe class="w-100 rounded mb-4" height="320px"
                    src="<?= $data['iframe']  ?>"
                    loading="lazy"></iframe>
                <h5 class="h-font">Address</h5>
                <a href="https://maps.app.goo.gl/Pg78hefLGBEVynax8" target="_blank"
                    class="d-inline-block text-decoration-none text-dark mb-2">
                    <i class="bi bi-geo-alt-fill"></i> <?= $data['address']  ?>
                </a>
                <h5 class="mt-4 h-font">Call Us</h5>
                <a href="tel: +917778889991" class="d-inline-block mb-2 text-decoration-none text-dark"><i
                        class="bi bi-telephone-fill"></i> <?= $data['phone_1']  ?></a><br>
                <a href="tel: +918529636985" class="d-inline-block text-decoration-none text-dark"><i
                        class="bi bi-telephone-fill"></i> <?= $data['phone_2']  ?></a>
                <h5 class="mt-4 h-font">Email : </h5>
                <a href="mailto:" class="d-inline-block text-decoration-none text-dark">
                    <i class="bi bi-envelope-fill"></i>  <?= $data['email']  ?>
                </a>
                <h5 class="mt-4 h-font">Follow Us</h5>
                <a href="https://www.twitter.com/" class="d-inline-block text-dark fs-5 me-2 text-decoration-none">
                <i class="bi bi-twitter me-1"></i> <?= $data['twitter']  ?>  
                </a> <br>
                <a href="https://www.facebook.com/" class="d-inline-block text-dark fs-5 me-2 text-decoration-none">
                    <i class="bi bi-facebook me-1"></i> <?= $data['fb']  ?>
                </a> <br>
                <a href="https://www.instagram.com/" class="d-inline-block text-dark fs-5 me-2 text-decoration-none">
                    <i class="bi bi-instagram me-1"></i> <?= $data['insta']  ?>
                </a>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-6 px-4">
            <div class="bg-white rounded shadow p-4">
                <form id="send" method="post" action="contact.php">
                    <h5 class="h-font">Send a messages :</h5>
                    <div class="mt-3">
                        <label for="name2" class="form-label" style="font-weight: 500;">Name : </label>
                        <input type="text" name="name2" id="name2" class="form-control shadow-none" data-validation="required alpha min" data-min="2"="Enter Your Name :">
                        <div class="error" id="name2Error"></div>
                    </div>
                    <div class="mt-3">
                        <label for="email2" class="form-label">Email : </label>
                        <input type="email" name="email2" id="email2" class="form-control shadow-none" data-validation="required email" placeholder="Enter Your Email :">
                        <div class="error" id="email2Error"></div>
                    </div>
                    <div class="mt-3">
                        <label for="subject" class="form-label">Subject : </label>
                        <input type="text" name="subject" id="subject" class="form-control shadow-none" data-validation="required min max" data-min="10" data-max="50" placeholder="Enter Your Subject :">
                        <div class="error" id="subjectError"></div>
                    </div>
                    <div class="mt-3">
                        <label for="messages" class="form-label">Messages : </label>
                        <textarea class="form-control shadow-none" id="messages" name="messages" rows="7" style="resize: none" data-validation="required min max" data-max="50" data-min="15" placeholder="Enter Your Messages :"></textarea>
                        <div class="error" id="messagesError"></div>
                    </div>
                    <button type="submit" class="btn text-white custom-bg mt-3" name="send_Query">SEND</button>
                </form>

                <?php
                if (isset($_POST['send_Query'])) {
                    $name = $_POST['name2'];
                    $email = $_POST['email2'];
                    $subject = $_POST['subject'];
                    $messages = $_POST['messages'];

                    $insert = "INSERT INTO `user_query`(`name`, `email`, `subject`, `message`) VALUES ('$name','$email','$subject','$messages')";
                    if ($conn->query($insert) == "true") {
                ?>
                        <script>
                            alert('Data is inserted Successfully.');
                        </script>

                    <?php
                    } else {
                    ?>
                        <script>
                            alert('Error to insert data.');
                        </script>
                <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>

<?php
include_once('inc/footer.php');
?>