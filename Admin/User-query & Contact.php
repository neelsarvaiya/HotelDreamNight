<?php
include_once('inc/admin-header.php');
?>

<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> User-querys
        <a href="#" class="btn btn-danger text-light"><i class="bi bi-trash"></i> all</a>
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
                    $select = "SELECT * FROM `user_query`";
                    $res = mysqli_query($conn, $select);

                    while ($data = mysqli_fetch_assoc($res)) {
                    ?>
                        <tr>
                            <td><?= $data['id'] ?></td>
                            <td><?= $data['name'] ?></td>
                            <td><?= $data['email'] ?></td>
                            <td><?= $data['subject'] ?></td>
                            <td><?= $data['message'] ?></td>
                            <td>
                                <button type="button" class="btn btn-success shadow-none mt-1" data-bs-toggle="modal" data-bs-target="#response">
                                    <i class="fa-solid fa-reply-all"></i>
                                </button>
                                <button class="btn btn-danger btn-md mx-1 mt-1"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    <?php
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
                        <button type="submit" class="btn btn-dark shadow" name="login">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




<div class="card container mt-5 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Contact Settings
        <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#contact">
        <i class="bi bi-pencil"></i> Edit
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

                <h5 class="card-title fw-bold">E-mail</h5>
                <p><i class="bi bi-envelope-fill"></i> kkanjariya630@rku.ac.in</p>

            </div>
            <div class="col-lg-6 mt-5">
                <h5 class="fw-bold mb-3">Social link</h5>
                <p>
                    <i class="bi bi-twitter me-1"></i> Twitter <br>
                    <i class="bi bi-facebook me-1"></i> FaceBook <br>
                    <i class="bi bi-instagram  me-1"></i> Instagram
                </p>

                <h5 class="fw-bold ">iFrame</h5>
                <p> <iframe class="w-100 img-thumbnail border-2 border-dark rounded mb-4"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118147.82106509873!2d70.73889453087791!3d22.273466166686283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959c98ac71cdf0f%3A0x76dd15cfbe93ad3b!2sRajkot%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1734684297133!5m2!1sen!2sin"
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
                    <i class="bi bi-person-vcard-fill fs-3 me-2"></i>
                    Contact
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="setting" action="settingsCRUD.php" method="post">
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
                        <button type="submit" class="btn btn-success shadow-none" name="contact_btn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>