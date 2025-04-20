<?php
include_once('inc/Admin-header.php');
?>

<?php
if (isset($_POST['save_detail_of_owner'])) {

    $name = $_POST['owner_name'];
    $description = $_POST['description_owner'];

    if ($_FILES['owner_image']['name'] != "") {
        $image = uniqid() . $_FILES['owner_image']['name'];
        $image_tmp_name = $_FILES['owner_image']['tmp_name'];
    }

    $q1 = "select * from about_details";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $q1));
    $old_image = $result['image'];

    $update = "UPDATE about_details SET name='$name'";
    if ($_FILES['owner_image']['name'] != "") {
        $update = $update . ",image='$image'";
    }
    $update = $update . ",owner_detail='$description' Where id = 2";

    if (mysqli_query($conn, $update)) {
        if ($_FILES['owner_image']['name'] != "") {
            move_uploaded_file($image_tmp_name, "../img/about/$image");
            unlink("../img/about/" . $old_image);
        }
        echo '<script> alert("Data updated successfully");</script>';
    } else {
        echo '<script> alert("Data is not updated");</script>';
    }

    echo '<script> window.location.href = "about.php";</script>';
}
?>

<?php
$select = "SELECT * FROM about_details";
$data = mysqli_fetch_assoc(mysqli_query($conn, $select));
?>



<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Owner Details
    </div>

    <div class="table-responsive-md table-responsive-sm" style="z-index: 1;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered text-center">
                <thead class="sticky-top">
                    <tr>
                        <th scope="col" width="30%" class="bg-dark text-white">Image</th>
                        <th scope="col" width="10%" class="bg-dark text-white">Name</th>
                        <th scope="col" width="50%" class="bg-dark text-white">Detail</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="align-middle">
                        <td class="p-2"><img src="../img/about/<?= $data['image'] ?>" height="200px" width="300px"></td>
                        <td><?= $data['name'] ?></td>
                        <td><?= $data['owner_detail'] ?></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-md mx-1 mt-1 shadow-none" data-bs-toggle="modal" data-bs-target="#edit_owner">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Details of Hotel
        <div>
            <button type="button" class="btn btn-success shadow-none" data-bs-toggle="modal" data-bs-target="#add">
                <i class="bi bi-plus-lg"></i> Add
            </button>
        </div>
    </div>
    <div class="table-responsive-md table-responsive-sm" style="z-index: 1;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered text-center">
                <thead class="sticky-top">
                    <tr>
                        <th scope="col" class="bg-dark text-white">Sr no.</th>
                        <th scope="col" class="bg-dark text-white">Image</th>
                        <th scope="col" class="bg-dark text-white">Detail</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select = "SELECT * FROM detail_of_hotel";
                    $res = mysqli_query($conn, $select);
                    $i = 1;
                    while ($data = mysqli_fetch_assoc($res)) {
                    ?>
                        <tr class="align-middle">
                            <td><?= $i ?></td>
                            <td class="p-2"><img src="../img/about/<?= $data['image'] ?>" height="100px" width="100px"></td>
                            <td><?= $data['detail'] ?></td>
                            <td>
                                <a href="?edit_id=<?= $data['id'] ?>" class="btn btn-warning shadow-none"><i class="bi bi-pencil-square"></i></a>
                                <a href="?delete_id=<?= $data['id'] ?>" onclick="return confirm('Are you sure you want to delete this?');" class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i></a>
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

<!-- owner -->
<div class="modal fade" id="edit_owner" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    Description
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>
            <?php
            $select = "SELECT * FROM about_details";
            $data = mysqli_fetch_assoc(mysqli_query($conn, $select));
            ?>
            <form action="about.php" method="post" enctype="multipart/form-data">
                <img class="rounded ms-3 mt-3 mb-4" src="../img/about/<?= $data['image'] ?>" height="120px" width="150px">
                <div class="modal-body">
                    <label for="Image" class="form-label">Owner Image : </label>
                    <input type="file" name="owner_image" id="owner_image" class="mb-1 col-md-12 form-control" rows="5" data-validation="file filesize" value="<?= $data['name'] ?>">
                    <div class="error" id="owner_imageError"></div>

                    <label for="name" class="form-label">Owner Name : </label>
                    <input type="text" name="owner_name" id="owner_name" class="mb-1 col-md-12 form-control" rows="5" data-validation="required" value="<?= $data['name'] ?>">
                    <div class="error" id="owner_nameError"></div>

                    <label for="description_owner" class="form-label"> Description of Owner : </label>
                    <textarea name="description_owner" id="description_owner" class="mb-1 col-md-12 form-control" rows="8" data-validation="required"><?= $data['owner_detail'] ?></textarea>
                    <div class="error" id="description_ownerError"></div>
                </div>
                <div class="mb-3 mx-3">
                    <button type="submit" name="save_detail_of_owner" class="btn btn-success shadow-none">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- add -->
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    <i class="bi bi-person-circle fs-3 me-2"></i> Details of Hotel
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="about.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-4">

                        <label for="description" class="form-label fw-bold">Description : </label>
                        <input type="file" name="add_detail_img" id="add_detail_img" data-validation="required file" class="form-control mb-3" placeholder="Enter Detail :">
                        <div class="error" id="add_detail_imgError"></div>

                        <label for="description" class="form-label fw-bold">Description : </label>
                        <input type="text" name="add_description" id="add_description" data-validation="required" class="form-control mb-3" placeholder="Enter Detail :">
                        <div class="error" id="add_descriptionError"></div>

                    </div>
                    <div class="d-flex align-items-end justify-content-between mb-2">
                        <button type="submit" class="btn btn-success shadow" name="add_detail">Add</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


<!-- edit -->
<div class="modal fade" id="edit_detail_of_hotel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    <i class="bi bi-person-circle fs-3 me-2"></i> Details of Hotel
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="about.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <label for="detail_image" class="form-label fw-bold">Image : </label> <br>
                            <img src="" id="detail_edit_img" class="ms-2 mb-4" height="100px" width="100px">
                            <input type="file" name="detail_edit_img" id="detail_edit_img" data-validation="file filesize" class="form-control mb-3">
                            <div class="error" id="detail_edit_imgError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Description : </label>
                            <input type="text" name="description1" data-validation="required " id="description1" class="form-control mb-2" placeholder="Enter Detail :">
                            <div class="error" id="description1Error"></div>
                        </div>
                    </div>
                    <input type="hidden" name="id_of_detail" id="id_of_detail">
                    <div class="d-flex align-items-end justify-content-between">
                        <button type="submit" class="btn btn-success shadow" name="edt_detail_btn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_GET['edit_id'])) {

    $sql = "SELECT * FROM `detail_of_hotel` WHERE `id` = $_GET[edit_id]";
    $res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $image = $res['image'];

    echo "
     <script>
     var edit_detail_of_hotel  = new bootstrap.Modal(document.getElementById('edit_detail_of_hotel'), {
        keyboard: false
        })
        document.querySelector('#description1').value = '$res[detail]';
        document.querySelector('#id_of_detail').value = '$res[id]';
        document.querySelector('#detail_edit_img').src = '../img/about/$image';
        edit_detail_of_hotel.show();
        </script>
        ";
}
?>

<?php
if (isset($_POST['add_detail'])) {

    $image = $_FILES['add_detail_img']['name'];
    $detail = $_POST['add_description'];

    $ins = "INSERT INTO `detail_of_hotel`(`image`, `detail`) VALUES ('$image','$detail')";
    if (mysqli_query($conn, $ins)) {
        move_uploaded_file($_FILES['add_detail_img']['tmp_name'], "../img/about/$image");
        echo '<script> alert("Data inserted");
           window.location.href = "about.php";
        </script>';
        exit;
    } else {
        echo '<script> alert("Data not inserted");
        window.location.href = "about.php";
        </script>';
        exit;
    }
}
?>

<?php
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    if ($id > 0) {
        $delete = "SELECT `image` FROM `detail_of_hotel` WHERE `id` = $id";
        $result = mysqli_query($conn, $delete);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $image = $row['image'];
            unlink("../img/about/$image");
        }

        $delete = "DELETE FROM `detail_of_hotel` WHERE `id` = $id";
        if (mysqli_query($conn, $delete)) {
?>
            <script>
                alert('Data Deleted successfully.');
                window.location.href = 'about.php';
            </script>
        <?php
        } else {
        ?>
            <script>
                alert('Data not Deleted successfully.');
                window.location.href = 'about.php';
            </script>
<?php
        }
    }
}
?>


<?php

if (isset($_POST['edt_detail_btn'])) {
    $detail_id = $_POST['id_of_detail'];
    $img = $_FILES['detail_edit_img']['name'];
    $des = $_POST['description1'];

    $q1 = "select * from `detail_of_hotel` where `id` = $detail_id";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $q1));
    $old_image = $result['image'];

    if ($_FILES['detail_edit_img']['name'] != "") {
        $update = "UPDATE `detail_of_hotel` SET `image`='$img',`detail`='$des' WHERE `id` = $detail_id";
    }else{
        $update = "UPDATE `detail_of_hotel` SET `detail`='$des' WHERE `id` = $detail_id";
    }

    if (mysqli_query($conn, $update)) {
        if ($_FILES['detail_edit_img']['name'] != "") {
            move_uploaded_file($_FILES['detail_edit_img']['tmp_name'], "../img/about/$img");
            unlink("../img/about/" . $old_image);
        }
        echo '<script> alert("Data updated");
        window.location.href = "about.php";
        </script>';
        exit;
    } else {
        echo '<script> alert("Data not updated");
        window.location.href = "about.php";
        </script>';
        exit;
    }

}

?>