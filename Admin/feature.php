<?php
include_once('connection.php');

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
        $deleteQuery = "DELETE FROM `room_facilities` WHERE `id`= '$id'";
    } else {
        $deleteQuery = "DELETE FROM `room_features` WHERE `id`= '$id'";
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
include_once('inc/admin-header.php');
?>

<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Feature
        <div>
            <button type="button" class="btn btn-success shadow-none" data-bs-toggle="modal" data-bs-target="#feature">
                <i class="bi bi-plus-lg"></i> Add
            </button>
            <a href="#" class="btn btn-danger text-light"><i class="bi bi-trash"></i> all</a>
        </div>
    </div>

    <div class="table-responsive-md table-responsive-sm" style="overflow-y: scroll; z-index: 1; height: 226px;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered">
                <thead class="sticky-top">
                    <tr class="text-center">
                        <th scope="col" class="bg-dark text-white">#</th>
                        <th scope="col" class="bg-dark text-white">Name</th>
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
            <a href="#" class="btn btn-danger text-light"><i class="bi bi-trash"></i> all</a>
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
                            <td>
                                <button type="button" class="btn btn-warning shadow-none mb-md-1 mb-sm-1" data-bs-toggle="modal" data-bs-target="#discount">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
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
                        <textarea class="form-control" id="description" name="description" rows="2"></textarea>
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

</div>
</div>
</div>