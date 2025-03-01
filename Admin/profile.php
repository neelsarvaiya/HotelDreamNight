<?php
include_once('inc/admin-header.php');
?>

<style>
    .custom-bg {
        background-color: var(--teal);
        border: 1px solid var(--teal);
    }

    .custom-bg:hover {
        background-color: var(--teal_hover);
        border: var(--teal_hover);
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-12 my-5 mb-4 px-4">
            <h2 class="fw-bold">PROFILE</h2>

        </div>

        <div class="col-lg-12 col-md-12 px-4 mb-5 px-5">
            <div class="card mb-4 border-0 shadow rounded-3">
                <div class="card-body">
                    <h5 class="mb-3 fw-bold">Basic Information</h5>
                    <form action="profile.php" method="post" id="information">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="name3">Full Name : </label>
                                <input type="text" class="form-control shadow-none" id="name3" name="name3" data-validation="required alpha min" data-min="2" placeholder="Enter Full Name :">
                                <div class="error" id="name3Error"></div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="phone2">Phone number : </label>
                                <input type="number" name="phone2" id="phone2" data-validation="required min max numeric" data-min="10" data-max="10" class="form-control shadow-none" placeholder="Enter Your Phone number :">
                                <div class="error" id="phone2Error"></div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="dob1" class="form-label">Date of Birth : </label>
                                <input type="date" id="dob1" name="dob1" data-validation="required" class="form-control shadow-none">
                                <div class="error" id="dob1Error"></div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="pin" class="form-label">Pincode number : </label>
                                <input type="number" id="pin" name="pin" class="form-control shadow-none" placeholder="Enter Your PINCODE :">
                            </div>
                            <div class="col-md-8 mb-4">
                                <label for="address2" class="form-label">Address : </label>
                                <textarea class="form-control shadow-none" id="address2" name="address2"
                                    rows="1" data-validation="required min max" data-min="10" data-max="50" placeholder="Enter Your Address :"></textarea>
                                    <div class="error" id="address2Error"></div>
                            </div>
                        </div>
                        <button type="submit" class="btn text-white custom-bg shadow-none">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-4 px-4 mb-5 px-5">
            <div class="card mb-4 border-0 shadow rounded-3">
            <form action="profile.php" method="post" enctype="multipart/form-data" id="profile_pic">
                    <div class="card-body">
                        <h5 class="mb-3 fw-bold">Picture</h5>
                        <img src="img/user.jpg" class="img-fluid mx-md-0 rounded-circle" style="height: 300px; width: 100%;"> <br>
                        <label for="pic1" class="form-label">New Picture : </label>
                        <input type="file" id="pic1" name="pic1" data-validation="required file" class="mb-4 form-control shadow-none" shadow-none>
                        <div class="error" id="pic1Error"></div>
                        <button type="submit" name="Pic_submit" class="btn text-white custom-bg shadow-none">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-8 px-4 mb-5 px-5">
            <div class="card mb-4 border-0 shadow rounded-3 p-2">
                <div class="card-body">
                    <h5 class="mb-3 fw-bold">Change Password</h5>
                    <form action="profile.php" method="post" id="old_new_pass">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="oldpass" class="form-label">Old Password:</label>
                                <input type="password" id="oldpass" name="oldpass" class="form-control shadow-none" data-validation="required strongPassword" placeholder="Enter old Password:">
                                <div class="error" id="oldpassError"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="newpass" class="form-label">New Password:</label>
                                <input type="password" id="newpass" name="newpass" class="form-control shadow-none" data-validation="required strongPassword" placeholder="Enter new Password:">
                                <div class="error" id="newpassError"></div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="C_newpass" class="form-label">Confirm Password:</label>
                                <input type="password" id="C_newpass" name="C_newpass" class="form-control shadow-none" data-validation="required confirmPassword" data-password-id="newpass" placeholder="Enter Confirm Password:">
                                <div class="error" id="C_newpassError"></div>
                            </div>
                        </div>
                        <button type="submit" class="btn text-white custom-bg shadow-none">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>