<?php
include_once('inc/admin-header.php');

$email = $_SESSION['admin'];

$select = "select * from `register` where `Email` = '$email'";
$result = mysqli_fetch_assoc(mysqli_query($conn, $select));
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
            <div style="font-size: 14px;">
                <a href="dashbord.php" class="text-secondary text-decoration-none">Home</a>
                <span class="text-secondary"> > </span>
                <a href="#" class="text-secondary text-decoration-none">Profile</a>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="col-lg-8 col-md-12 px-4 mb-5 px-5">
                <div class="card mb-4 border-0 shadow rounded-3">
                    <div class="card-body">
                        <form action="profile.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="card-body col-lg-4">
                                    <div class="d-flex justify-content-center">
                                        <img src="/HotelDreamNight/img/userProfile/<?= $result['Profile_pic'] ?>" class="img-fluid rounded-circle" style="height: 270px; width: 40%;">
                                    </div>
                                    <h5 class="text-center mt-2" style="color:#767676"><?= $result['Full_Name'] ?></h5>
                                    <h6 class="text-center mb-3" style="color:#a8a8a8"><?= $result['Email'] ?></h6>
                                </div>

                                <h5 class="mb-3 fw-bold">Basic Information</h5>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="name3">Full Name : </label>
                                    <input type="text" class="form-control shadow-none" id="name3" name="name3" data-validation="required alpha" placeholder="Enter Full Name :" value="<?= $result['Full_Name'] ?>">
                                    <div class="error" id="name3Error"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="phone2">Phone number : </label>
                                    <input type="number" name="phone2" id="phone2" data-validation="required numeric min max" data-min="10" data-max="10" class="form-control shadow-none" placeholder="Enter Your Phone number :" value="<?= $result['Phone_number'] ?>">
                                    <div class="error" id="phone2Error"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dob1" class="form-label">Date of Birth : </label>
                                    <input type="date" id="dob1" data-validation="required" name="dob1" class="form-control shadow-none" value="<?= $result['DOB'] ?>">
                                    <div class="error" id="dob1Error"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pin" class="form-label">State: </label>
                                    <input type="text" id="state1" name="state1" class="form-control shadow-none" data-validation="required min" data-min="3" placeholder="Enter Your Stste :" value="<?= $result['state'] ?>">
                                    <div class="error" id="state1Error"></div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label for="address2" class="form-label">Address : </label>
                                    <textarea class="form-control shadow-none" id="address2" name="address2"
                                        rows="1" data-validation="required min max" data-max="50"
                                        data-min="10" placeholder="Enter Your Address :"><?= $result['Address'] ?></textarea>
                                    <div class="error" id="address2Error"></div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label for="pic" class="form-label">Profile Picture : </label>
                                    <input type="file" name="edit_pic" class="form-control shadow-none" id="edit_pic" data-validation="file filesize" data-filesize="200">
                                    <div class="error" id="edit_picError"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn w-100 text-white custom-bg shadow-none" name="edit_btn">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="col-md-8 px-4 mb-5 px-5">
                <div class="card mb-4 border-0 shadow rounded-3 p-2">
                    <div class="card-body">
                        <h5 class="mb-3 fw-bold">Change Password</h5>
                        <form action="profile.php" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="oldpass" class="form-label">Old Password:</label>
                                    <input type="password" id="oldpass" name="oldpass" class="form-control shadow-none" data-validation="required strongPassword" placeholder="Enter old Password:">
                                    <div class="error" id="oldpassError"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="newpass" class="form-label">New Password:</label>
                                    <input type="password" id="newpass" name="newpass" class="form-control shadow-none mb-3" data-validation="required strongPassword" placeholder="Enter new Password:">
                                    <div class="error" id="newpassError"></div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="C_newpass" class="form-label">Confirm Password:</label>
                                    <input type="password" id="C_newpass" name="C_newpass" class="form-control shadow-none" data-validation="required confirmPassword" data-password-id="newpass" placeholder="Enter Confirm Password:">
                                    <div class="error" id="C_newpassError"></div>
                                </div>
                            </div>
                            <button type="submit" name="pass_btn" class="btn text-white custom-bg shadow-none w-100">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>


<?php
if (isset($_POST['edit_btn'])) {
    $name = $_POST['name3'];
    $phonenumber = $_POST['phone2'];
    $dob = $_POST['dob1'];
    $state = $_POST['state1'];
    $address = $_POST['address2'];

    if ($_FILES['edit_pic']['name'] != "") {
        $profile_picture = uniqid() . $_FILES['edit_pic']['name'];
        $profile_picture_tmp_name = $_FILES['edit_pic']['tmp_name'];
    }

    $q1 = "select * from `register` where `Email`='$email'";
    $result = mysqli_fetch_assoc($conn->query($q1));
    $old_profile_picture = $result['Profile_pic'];

    $update = "UPDATE `register` SET `Full_Name`='$name',`Phone_number`='$phonenumber',`Address`='$address',`state`='$state',`DOB`='$dob'";
    if ($_FILES['edit_pic']['name'] != "") {
        $update = $update . ", `Profile_pic`='$profile_picture'";
    }
    $update = $update . " where Email='$email'";

    if ($conn->query($update)) {
        if ($_FILES['edit_pic']['name'] != "") {
            move_uploaded_file($profile_picture_tmp_name, "../img/userProfile/" . $profile_picture);
            unlink("../img/userProfile/" . $old_profile_picture);
        }
        setcookie('success', 'profile updated successfully', time() + 5, "/");
    } else {
        setcookie('error', 'error in updating profile', time() + 5, "/");
    }

?>
    <script>
        window.location.href = "profile.php";
    </script>
<?php
}
?>