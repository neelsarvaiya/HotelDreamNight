<?php
include_once('connection.php');



if (isset($_POST['facility_edit_btn'])) {
    $edit_id = $_POST['edit_id'];
    $img = $_FILES['edit_facility_img']['name'];
    $des = $_POST['edit_description'];
    $fac_name  = $_POST['edit_facilities_name'];

    echo $edit_id;

    $q1 = "select * from `room_facilities` where `id` = '$edit_id'";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $q1));
    $old_image = $result['image'];

    if ($_FILES['edit_facility_img']['name'] != "") {
        $update = "UPDATE `room_facilities` SET `image`='$img', `name` = '$fac_name', `description`='$des' WHERE `id` = $edit_id";
    } else {
        $update = "UPDATE `room_facilities` SET `name` = '$fac_name', `description`='$des' WHERE `id` = $edit_id";
    }

    if (mysqli_query($conn, $update)) {
        if ($_FILES['edit_facility_img']['name'] != "") {
            move_uploaded_file($_FILES['edit_facility_img']['tmp_name'], "../img/facilities/$img");
            unlink("../img/facilities/" . $old_image);
        }
        echo '<script> alert("Data updated");
        window.location.href = "feature.php";
        </script>';
        exit;
    } else {
        echo '<script> alert("Data not updated");
        window.location.href = "feature.php";
        </script>';
        exit;
    }
}

// feature
if (isset($_POST['add-btn'])) {
    $feature = trim($_POST['feature']);

    try {
        $insert = "INSERT INTO `room_features`(`name`) VALUES ('$feature')";

        if (mysqli_query($conn, $insert)) {
            setcookie("success", "Add Successfull.", time() + 3, "/");
        } else {
            setcookie("error", "Not add successfull.", time() + 3, "/");
        }
    } catch (Exception $e) {
        setcookie("error", "Not Add Successful. Error: " . $e->getMessage(), time() + 3, "/");
    }
?>
    <script>
        window.location.href = 'feature.php';
    </script>
<?php
    exit;
}

// delete
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_GET['name'])) {
        $sql = "SELECT rfm.room_id FROM room_facilities_mapping rfm JOIN room_facilities rf ON rfm.room_facility_id = rf.id WHERE rf.id = $id";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) > 0) {
            setcookie("warning", "facility mapped with rooms! cannot delete", time() + 3, "/");
            echo "<script>window.location.href = 'feature.php'</script>";
            exit;
        } else {
            $deleteQuery = "DELETE FROM `room_facilities` WHERE `id`= '$id'";
        }
    } else {
        $sql = "SELECT rfm.room_id FROM room_features_mapping rfm JOIN room_features rf ON rfm.room_feature_id = rf.id WHERE rf.id = $id";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) > 0) {
            setcookie("warning", "features mapped with rooms! cannot delete", time() + 3, "/");
            echo "<script>window.location.href = 'feature.php'</script>";
            exit;
        } else {
            $deleteQuery = "DELETE FROM `room_features` WHERE `id`= $id";
        }
    }

    if (mysqli_query($conn, $deleteQuery)) {
        setcookie("success", "Deleted Successfull.", time() + 3, "/");
    } else {
        setcookie("error", "Not Deleted Successfull.", time() + 3, "/");
    }
?>
    <script>
        window.location.href = 'feature.php';
    </script>
<?php
    exit;
}
?>

<!-- facilities -->
<?php
if (isset($_POST['f-btn'])) {
    $facility = trim($_POST['facilities_name']);
    $description = $_POST['description'];

    $img = "";
    if (isset($_FILES['facilities_image']) && $_FILES['facilities_image']['error'] === 0) {
        $path = "../img/facilities/";
        $img = basename($_FILES['facilities_image']['name']);
        $target_file = $path . $img;

        if (!move_uploaded_file($_FILES['facilities_image']['tmp_name'], $target_file)) {
            setcookie("error", "File not uploaded.", time() + 3, "/");
            exit;
        }

        try {
            $insert = "INSERT INTO `room_facilities`(`image`, `name`, `description`) VALUES ('$img','$facility','$description')";

            if (mysqli_query($conn, $insert)) {
                setcookie("success", "Add Successfull.", time() + 3, "/");
            } else {
                setcookie("error", "Not add successfull.", time() + 3, "/");
            }
        } catch (Exception $e) {
            setcookie("error", "Not Add Successful. Error: " . $e->getMessage(), time() + 3, "/");
        }
    }
?>
    <script>
        window.location.href = 'feature.php';
    </script>
    <?php
    exit;
}

if (isset($_GET['status_id'])) {
 
    if (isset($_GET['rf'])) {
        $status_query = "SELECT `status` FROM `room_facilities` WHERE id = $_GET[status_id]";
        $result = mysqli_query($conn, $status_query);
        $status = mysqli_fetch_assoc($result);
        if ($status['status'] == "active") {
            $update_qu = "UPDATE `room_facilities` SET `status` = 'inactive' WHERE id = $_GET[status_id]";
        } else {
            $update_qu = "UPDATE `room_facilities` SET `status` = 'active' WHERE id = $_GET[status_id]";
        }
    }else{
        $status_query = "SELECT `status` FROM `room_features` WHERE id = $_GET[status_id]";
        $result = mysqli_query($conn, $status_query);
        $status = mysqli_fetch_assoc($result);
        if ($status['status'] == "active") {
            $update_qu = "UPDATE `room_features` SET `status` = 'inactive' WHERE id = $_GET[status_id]";
        } else {
            $update_qu = "UPDATE `room_features` SET `status` = 'active' WHERE id = $_GET[status_id]";
        }  
    }

    $sql = mysqli_query($conn, $update_qu);

    if ($sql) {
        setcookie("success", "status updated Successfull.", time() + 3, "/");
    ?>
        <script>
            window.location.href = "feature.php";
        </script>
<?php
        exit;
    }
}

include_once('inc/admin-header.php');
?>

<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Feature
        <div>
            <button type="button" class="btn btn-success shadow-none" data-bs-toggle="modal" data-bs-target="#feature">
                <i class="bi bi-plus-lg"></i> Add
            </button>
        </div>
    </div>

    <div class="table-responsive-md table-responsive-sm" style="overflow-y: scroll; z-index: 1; height: 226px;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered">
                <thead class="sticky-top">
                    <tr class="text-center">
                        <th scope="col" class="bg-dark text-white">#</th>
                        <th scope="col" class="bg-dark text-white">Name</th>
                        <th scope="col" class="bg-dark text-white">Status</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `room_features`";
                    $res = mysqli_query($conn, $sql);
                    $i = 1;
                    while ($data = mysqli_fetch_assoc($res)) {
                    ?>
                        <tr class="text-center align-middle">
                            <td><?= $i ?></td>
                            <td><?= $data['name'] ?></td>
                            <td><a href="?status_id=<?= $data['id'] ?>" class="btn btn-<?= ($data['status'] === "active") ? 'success' : 'danger' ?> btn-md mx-1"><?= $data['status'] ?></a></td>
                            <td><a href="?id=<?= $data['id'] ?>"><button onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i></button></a></td>
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

<!-- features modal -->
<div class="modal fade" id="feature" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    <i class="bi bi-person-circle fs-3 me-2"></i> Features
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="feature.php" method="post">
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="reponse" class="form-label fw-bold">Feature : </label>
                        <input type="text" name="feature" id="feature" data-validation="required alpha" class="form-control" placeholder="Enter Feature :">
                        <div class="error" id="featureError"></div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mb-2">
                        <button type="submit" class="btn btn-success shadow" name="add-btn">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Facilities
        <div>
            <button type="button" class="btn btn-success shadow-none" data-bs-toggle="modal" data-bs-target="#facilities">
                <i class="bi bi-plus-lg"></i> Add
            </button>
        </div>
    </div>
    <div class="table-responsive-md table-responsive-sm" style="overflow-y: scroll; height: 420px;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered">
                <thead class="sticky-top">
                    <tr class="text-center">
                        <th scope="col" class="bg-dark text-white">#</th>
                        <th scope="col" class="bg-dark text-white">Icons</th>
                        <th scope="col" class="bg-dark text-white">Name</th>
                        <th scope="col" width="50%" class="bg-dark text-white">description</th>
                        <th scope="col" class="bg-dark text-white">Status</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `room_facilities`";
                    $res = mysqli_query($conn, $sql);
                    $i = 1;
                    while ($data = mysqli_fetch_assoc($res)) {
                    ?>
                        <tr class="text-center align-middle">
                            <td><?= $i ?></td>
                            <td><img src="../img/facilities/<?= $data['image'] ?>" width="50px"></td>
                            <td><?= $data['name'] ?></td>
                            <td><?= $data['description'] ?></td>
                            <td><a href="?status_id=<?= $data['id'] ?>&rf=room_facilities" class="btn btn-<?= ($data['status'] === "active") ? 'success' : 'danger' ?> btn-md mx-1"><?= $data['status'] ?></a></td>
                            <td>
                                <a href="?facility_id=<?= $data['id'] ?>" class="btn btn-warning shadow-none mb-md-1 mb-sm-1">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="?id=<?= $data['id'] ?>&name=room_facilities"><button onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i></button></a>
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

<!-- facilities modal -->
<div class="modal fade" id="facilities" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    <i class="bi bi-person-circle fs-3 me-2"></i> Facilities
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="feature.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="facilities_image" class="form-label fw-bold">Choose Facilities icon : </label>
                        <input type="file" name="facilities_image" id="facilities_image" data-validation="required file" class="form-control mb-3">
                        <div class="error" id="facilities_imageError"></div>

                        <label for="reponse" class="form-label fw-bold">Facilities : </label>
                        <input type="text" name="facilities_name" data-validation="required alpha" id="facilities_name" class="form-control mb-3" placeholder="Enter Facilities :">
                        <div class="error" id="facilities_nameError"></div>

                        <label for="reponse" class="form-label fw-bold">description : </label>
                        <textarea class="form-control" id="description" data-validation="required" name="description" rows="2"></textarea>
                        <div class="error" id="descriptionError"></div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mb-2">
                        <button type="submit" class="btn btn-success shadow" name="f-btn">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- edit facilities modal -->
<div class="modal fade" id="facilities_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    <i class="bi bi-person-circle fs-3 me-2"></i> Facilities
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="feature.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-4">
                        <img src="" id="edit_facility_img" height="70px" width="70px"> <br>
                        <label for="facilities_image" class="form-label fw-bold mt-2">Choose Facilities icon : </label>
                        <input type="file" name="edit_facility_img" id="edit_facility_img" data-validation="file" class="form-control mb-3">
                        <div class="error" id="edit_facility_imgError"></div>

                        <label for="reponse" class="form-label fw-bold">Facilities : </label>
                        <input type="text" name="edit_facilities_name" data-validation="required alpha" id="edit_facilities_name" class="form-control mb-3" placeholder="Enter Facilities :">
                        <div class="error" id="edit_facilities_nameError"></div>

                        <label for="reponse" class="form-label fw-bold">description : </label>
                        <textarea class="form-control" id="edit_description" name="edit_description" data-validation="required" rows="2"></textarea>
                        <div class="error" id="edit_descriptionError"></div>
                    </div>
                    <input type="hidden" id="edit_id" name="edit_id">
                    <div class="d-flex align-items-end justify-content-between mb-2">
                        <button type="submit" class="btn btn-success shadow" name="facility_edit_btn">save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
</div>
</div>


<?php
if (isset($_GET['facility_id'])) {

    $sql = "SELECT * FROM `room_facilities` WHERE id = $_GET[facility_id]";
    $fetch = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    echo "
<script>
    var facilities_edit  = new bootstrap.Modal(document.getElementById('facilities_edit'), {
        keyboard: false
    })
    document.querySelector('#edit_facility_img').src = `../img/facilities/$fetch[image]`;
    document.querySelector('#edit_facilities_name').value = `$fetch[name]`;
    document.querySelector('#edit_description').value = `$fetch[description]`;
    document.querySelector('#edit_id').value = `$fetch[id]`;

    facilities_edit.show();
</script>
";
}
?>