<?php
include_once('../mailer.php');
include_once 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($id > 0) {
        $delete = "DELETE FROM user_query WHERE id = $id";

        if (mysqli_query($conn, $delete)) {
            setcookie("success", "Deleted Successfull", time() + 3, "/");
?>
            <script>
                window.location.href = 'user-query & contact.php';
            </script>
        <?php
        } else {
            setcookie("error", "NOt Deleted Successfull", time() + 3, "/");
        ?>
            <script>
                window.location.href = 'user-query & contact.php';
            </script>
<?php
        }
    }
}
?>

<?php
include_once('inc/admin-header.php');
?>


<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> User-Queries
    </div>

    <div class="table-responsive-md table-responsive-sm" style="z-index: 1;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered text-center">
                <thead class="sticky-top">
                    <tr>
                        <th scope="col" class="bg-dark text-white">#</th>
                        <th scope="col" class="bg-dark text-white">Name</th>
                        <th scope="col" class="bg-dark text-white">Email</th>
                        <th scope="col" class="bg-dark text-white">Subject</th>
                        <th scope="col" class="bg-dark text-white">Message</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select = "SELECT * FROM user_query";
                    $res = mysqli_query($conn, $select);
                    $i = 1;
                    while ($data = mysqli_fetch_assoc($res)) {
                    ?>
                        <tr class="align-middle">
                            <td><?= $i ?></td>
                            <td><?= $data['name'] ?></td>
                            <td><?= $data['email'] ?></td>
                            <td><?= $data['subject'] ?></td>
                            <td><?= $data['message'] ?></td>
                            <td>
                                 <?php
                                    if($data['response'] == 0){
                                        ?>
                                        <a href="?user_id=<?= $data['id'] ?>" class="btn btn-success shadow-none mt-1 me-1" title="Send Message"><i class="fa-solid fa-reply-all"></i> 
                                        <?php
                                    }
                                    else {
                                        ?>
                                        <button class="btn btn-info shadow-none mt-1" title="Resolved"><i class="bi bi-check-circle"></i></button>
                                        <?php 
                                    }
                                 ?>
                                <a href="?id=<?= $data['id'] ?>" onclick="return confirm('Are you sure you want to delete this query?');" class="btn btn-danger btn-md mx-1 mt-1" title="Delete"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="response" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    <i class="bi bi-person-circle fs-3 me-2"></i> User Response
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="user_query" method="post">
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="reponse" class="form-label fw-bold">Response : </label>
                        <textarea class="form-control shadow-none" id="messages" name="msg" data-validation="required min max" data-min="10" data-max="50" rows="5"
                            style="resize: none" placeholder="Enter Your Text :"></textarea>
                        <div class="error" id="msgError"></div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadow" name="response_btn"> Send </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['response_btn'])) {
    $message = $_POST['msg'];
    $id = $_GET['user_id'];

    $select = "SELECT * FROM user_query WHERE id = $id";
    $res = mysqli_query($conn, $select);

    $data = mysqli_fetch_assoc($res);
    $name = $data['name'];
    $user_subject = $data['subject'];
    $query = $data['message'];
    $email = $data['email'];
    $subject = "Response from Admin";
    $body = "<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 25px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            border-top: 6px solid #007BFF;
        }
        h1 {
            color: #007BFF;
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
        }
        .message-box {
            background: #f1f8ff;
            padding: 15px;
            border-left: 6px solid #007BFF;
            margin: 15px 0;
            border-radius: 5px;
            font-size: 16px;
        }
        .message-box p {
            margin: 8px 0;
        }
        .highlight {
            font-weight: bold;
            color: #007BFF;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #555;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>Thank You for Contacting Us!</h1>
        <p>Dear <span class='highlight'>$name</span>,</p>
        <p>We have received your query and our support team will get back to you as soon as possible.</p>

        <div class='message-box'>
            <p><strong>📌 Your Subject:</strong> <span class='highlight'>$user_subject</span></p>
            <p><strong>📩 Your Query:</strong> $query</p>
            <p><strong>📝 Response:</strong> <span class='highlight'>$message</span></p>
        </div>

        <p>We appreciate your patience and will respond shortly.</p>

        <div class='footer'>
            <p><strong>🌟 DreamNight Hotel</strong></p>
            <p>📞 Contact Us: +1-234-567-890 | 📧 support@dreamnight.com</p>
        </div>
    </div>
</body>
</html>
";

    if (sendEmail($email, $subject, $body, "")) {
        mysqli_query($conn, "UPDATE `user_query` SET `response`= 1 WHERE `email` = '$email'");
        echo "<script> alert('Response sent successfully'); </script>";
    }
}

?>

<?php
$select = "SELECT * FROM contact_details";
$data = mysqli_fetch_assoc(mysqli_query($conn, $select));
?>

<div class="card container mt-5 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Contact Settings
        <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#contact">
            <i class="bi bi-pencil-square"></i> Edit
        </button>
    </div>
    <div class="card-body">
        <div class="row d-flex align-items-center justify-content-between">
            <div class="col-lg-6">
                <h5 class="card-title fw-bold mb-3">Address</h5>
                <p><i class="bi bi-geo-alt-fill"></i> <?= $data['address']  ?></p>

                <h5 class="card-title fw-bold mb-3">Call Us</h5>
                <p><i class="bi bi-telephone-fill"></i> <?= $data['phone_1']  ?><br>
                    <i class="bi bi-telephone-fill"></i> <?= $data['phone_2']  ?>
                </p>

                <h5 class="card-title fw-bold">E-mail</h5>
                <p><i class="bi bi-envelope-fill"></i> <?= $data['email']  ?></p>

            </div>
            <div class="col-lg-6 mt-5">
                <h5 class="fw-bold mb-3">Social link</h5>
                <p>
                    <i class="bi bi-twitter me-1"></i> <?= $data['twitter']  ?><br>
                    <i class="bi bi-facebook me-1"></i> <?= $data['fb']  ?><br>
                    <i class="bi bi-instagram  me-1"></i> <?= $data['insta']  ?>
                </p>

                <h5 class="fw-bold ">iFrame</h5>
                <p> <iframe class="w-100 img-thumbnail border-2 border-dark rounded mb-4"
                        src="<?= $data['iframe']  ?>"
                        loading="lazy">
                    </iframe>
                </p>
            </div>
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
                    <i class="bi bi-person-vcard-fill fs-3 me-2"></i> Contact
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="setting" action="User-query & Contact.php" method="post">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 p-0 mb-3">
                                <label for="address" class="form-label">Address : </label>
                                <textarea class="form-control shadow-none" id="address" data-validation="required" name="address"
                                    rows="1"><?= $data['address'] ?></textarea>
                                <div class="error" id="addressError"></div>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label" for="phone">Phone number-1 : </label>
                                <input type="number" name="phone1" id="phone1" data-validation="required" class="form-control shadow-none" value="<?= $data['phone_1'] ?>">
                                <div class="error" id="phone1Error"></div>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label" for="phone">Phone number-2 : </label>
                                <input type="number" name="phone2" id="phone2" data-validation="required" class="form-control shadow-none" value="<?= $data['phone_2'] ?>">
                                <div class="error" id="phone2Error"></div>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label" for="icon">Social Link :</label>
                                <input type="text" name="link1" id="link1" class="form-control shadow-none mb-1" data-validation="required" value="<?= $data['twitter'] ?>">
                                <div class="error" id="link1Error"></div>
                                <input type="text" name="link2" id="link2" class="form-control shadow-none mb-1" data-validation="required" value="<?= $data['fb'] ?>">
                                <div class="error" id="link2Error"></div>
                                <input type="text" name="link3" id="link3" class="form-control shadow-none mb-1" data-validation="required" value="<?= $data['insta'] ?>">
                                <div class="error" id="link3Error"></div>
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label for="email" class="form-label">Email : </label>
                                <input type="email" id="email" class="form-control shadow-none mb-3" data-validation="required email" name="email" value="<?= $data['email'] ?>">
                                <div class="error" id="emailError"></div>
                            </div>
                            <div class="col-md-12 p-0 mb-3">
                                <label for="address" class="form-label">Iframe : </label>
                                <textarea class="form-control shadow-none" data-validation="required" id="iframe" name="iframe"
                                    rows="2"><?= $data['iframe'] ?></textarea>
                                <div class="error" id="iframeError"></div>
                            </div>
                        </div>
                    </div>
                    <div class="my-1">
                        <button type="submit" class="btn btn-success shadow-none fs-5 w-100" name="contact_btn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php

if (isset($_POST['contact_btn'])) {
    $address = $_POST['address'];
    $phone1 = $_POST['phone1'];
    $phone2 = $_POST['phone2'];
    $link1 = $_POST['link1'];
    $link2 = $_POST['link2'];
    $link3 = $_POST['link3'];
    $email = $_POST['email'];
    $iframe = $_POST['iframe'];

    $sql = "UPDATE contact_details 
            SET address='$address', phone_1='$phone1', phone_2='$phone2', 
                twitter='$link1', fb='$link2', insta='$link3', 
                email='$email', iframe='$iframe'";

    if (mysqli_query($conn, $sql)) {
        setcookie("success", "Detail updated", time() + 5, "/");
    } else {
        setcookie("error", "Detail updating Failed", time() + 5, "/");
    }

?>
    <script>
        window.location.href = "User-query & Contact.php";
    </script>
<?php

    exit();
}
?>

<?php

if (isset($_GET['user_id'])) {

    echo "
    <script>
        var response  = new bootstrap.Modal(document.getElementById('response'), {
            keyboard: false
        });
        response.show();
    </script>
";
}
?>