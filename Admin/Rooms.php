<?php
include_once 'connection.php';

if (isset($_POST['add-btn'])) {
    $name = $_POST['room_name'];
    $description = $_POST['description'];
    $price = $_POST['actual_price'];
    $discount = $_POST['discount_value'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $features = $_POST['features']; // Array of feature IDs
    $facilities = $_POST['facilities']; // Array of facility IDs


    // Handle Image Upload
    $img = "";
    if (isset($_FILES['room_image']) && $_FILES['room_image']['error'] === 0) {
        $path = "../img/rooms/";
        $img = uniqid() . basename($_FILES['room_image']['name']);
        $target_file = $path . $img;

        if (!move_uploaded_file($_FILES['room_image']['tmp_name'], $target_file)) {
            echo "File upload error!";
            exit;
        }
    }

    // Insert Room Data
    $insert = "INSERT INTO `room_categories` (`name`, `image`, `description`, `actual_price` , `discount_percentage` , `adult(max)`, `child(max)`)  VALUES ('$name', '$img', '$description', '$price', '$discount', '$adults', '$children')";

    if (mysqli_query($conn, $insert)) {

        $room_id = mysqli_insert_id($conn); // Get inserted room ID

        foreach ($features as $feature_id) {
            $feature_insert = "INSERT INTO `room_features_mapping`(`room_id`, `room_feature_id`) VALUES ('$room_id','$feature_id')";
            mysqli_query($conn, $feature_insert);
        }

        foreach ($facilities as $facility_id) {
            $facility_insert = "INSERT INTO `room_facilities_mapping`(`room_id`, `room_facility_id`) VALUES ('$room_id','$facility_id')";
            mysqli_query($conn, $facility_insert);
        }

        setcookie("success", "Room add successfull.", time() + 3, "/");
    } else {
        setcookie("error", "Not add successfull.", time() + 3, "/");
    }
?>
    <script>
        window.location.href = 'Rooms.php';
    </script>
<?php
}
?>

<?php
include_once("inc/admin-header.php");
?>

<div class="card container mt-5 p-4  mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Rooms
        <button type="button" class="btn btn-success shadow-none" data-bs-toggle="modal" data-bs-target="#add_room">
            <i class="bi bi-plus-square"></i> Add
        </button>
    </div>
</div>

<?php
$sql = "SELECT * FROM `room_categories`";
$res = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($res)) {
    $room_id = $data['id'];

?>

    <div class="card container mt-5 p-4 border-2 mb-4">
        <div class="container mt-1">
            <h2><?= $data['name'] ?></h2>
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Room Name</strong></td>
                        <td><?= $data['name'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Image</strong></td>
                        <td><img src="../img/rooms/<?= $data['image'] ?>" alt="Room Image" style="max-width: 200px;"></td>
                    </tr>
                    <tr>
                        <td><strong>Features</strong></td>
                        <?php
                        $sql = "SELECT rf.name FROM `room_features` rf JOIN `room_features_mapping` rfm ON rfm.room_feature_id = rf.id WHERE rfm.room_id = $room_id";
                        $features = mysqli_query($conn, $sql);
                        while ($feature = mysqli_fetch_assoc($features)) {
                        ?>
                            <td><?= $feature['name'] ?></td>
                        <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <td><strong>Facilities</strong></td>
                        <?php
                        $sql = "SELECT rf.name FROM `room_facilities` rf JOIN `room_facilities_mapping` rfm ON rfm.room_facility_id = rf.id WHERE rfm.room_id = $room_id";
                        $facilities = mysqli_query($conn, $sql);
                        while ($facility = mysqli_fetch_assoc($facilities)) {
                        ?>
                            <td><?= $facility['name'] ?></td>
                        <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <td><strong>Guests</strong></td>
                        <td><?= $data['adult(max)'] ?> Adults, <?= $data['child(max)'] ?> Children</td>
                    </tr>
                    <tr>
                        <td><strong>Rating</strong></td>
                        <td>⭐⭐⭐⭐</td>
                    </tr>
                    <tr>
                        <td><strong>Original Price (per night)</strong></td>
                        <td><?= $data['actual_price'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Discounted Price (per night)</strong></td>
                        <td><?= $data['final_price'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Discount Offer</strong></td>
                        <td>10% Off on Weekdays</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-3">
                <button type="button" class="btn btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#edit_room">
                    Edit Room
                </button>
                <button class="btn btn-danger">Delete Room</button>
            </div>
        </div>
    </div>
<?php
}
?>

<div class="modal fade" id="edit_room" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    <i class="bi bi-person-circle fs-3 me-2"></i> Room
                </h5>
            </div>
            <div class="modal-body">
                <form action="Rooms.php" method="POST" enctype="multipart/form-data">
                    <div class="container-fluid mt-4">
                        <div class="row">
                            <!-- Room Name -->
                            <div class="col-md-6 mb-3">
                                <label for="room_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="room_name" name="room_name" required>
                            </div>

                            <!-- Image Upload -->
                            <div class="col-md-6 mb-3">
                                <label for="room_image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="room_image" name="room_image" accept="image/*" required>
                            </div>

                            <!-- Actual Price -->
                            <div class="col-md-6 mb-3">
                                <label for="actual_price" class="form-label">Actual Price</label>
                                <input type="number" class="form-control" id="actual_price" name="actual_price" required>
                            </div>

                            <!-- Discount Value -->
                            <div class="col-md-6 mb-3">
                                <label for="discount_value" class="form-label">Discount (%)</label>
                                <input type="number" class="form-control" id="discount_value" name="discount_value" min="0" max="100" required>
                            </div>

                            <!-- Adult Capacity -->
                            <div class="col-md-6 mb-3">
                                <label for="adults" class="form-label">Adult (Max.)</label>
                                <input type="number" class="form-control" id="adults" name="adults" required>
                            </div>

                            <!-- Children Capacity -->
                            <div class="col-md-6 mb-3">
                                <label for="children" class="form-label">Children (Max.)</label>
                                <input type="number" class="form-control" id="children" name="children" required>
                            </div>
                        </div>

                        <!-- Features -->
                        <div class="mb-3">
                            <label class="form-label">Features</label>
                            <div class="d-flex flex-wrap">
                                <?php
                                $sql = "SELECT * FROM `room_features`";
                                $res = mysqli_query($conn, $sql);
                                while ($data = mysqli_fetch_assoc($res)) {
                                ?>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" name="features[]" value="<?= $data['id'] ?>" id="feature1">
                                        <label class="form-check-label" for="feature1"><?= $data['name'] ?></label>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Facilities -->
                        <div class="mb-3">
                            <label class="form-label">Facilities</label>
                            <div class="d-flex flex-wrap">
                                <?php
                                $sql = "SELECT * FROM `room_facilities`";
                                $res = mysqli_query($conn, $sql);
                                while ($data = mysqli_fetch_assoc($res)) {
                                ?>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" name="facilities[]" value="<?= $data['id'] ?>" id="facility1">
                                        <label class="form-check-label" for="facility1"><?= $data['name'] ?></label>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-secondary me-2 shadow-none" data-bs-dismiss="modal">cancle</button>
                            <button type="submit" class="btn btn-success" name="edit-btn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add_room" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    <i class="bi bi-person-circle fs-3 me-2"></i> Room
                </h5>
            </div>
            <div class="modal-body">
                <form action="Rooms.php" method="POST" enctype="multipart/form-data">
                    <div class="container-fluid mt-4">
                        <div class="row">
                            <!-- Room Name -->
                            <div class="col-md-6 mb-3">
                                <label for="room_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="room_name" name="room_name" required>
                            </div>

                            <!-- Image Upload -->
                            <div class="col-md-6 mb-3">
                                <label for="room_image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="room_image" name="room_image" accept="image/*" required>
                            </div>

                            <!-- Actual Price -->
                            <div class="col-md-6 mb-3">
                                <label for="actual_price" class="form-label">Actual Price</label>
                                <input type="number" class="form-control" id="actual_price" name="actual_price" required>
                            </div>

                            <!-- Discount Value -->
                            <div class="col-md-6 mb-3">
                                <label for="discount_value" class="form-label">Discount (%)</label>
                                <input type="number" class="form-control" id="discount_value" name="discount_value" min="0" max="100" required>
                            </div>

                            <!-- Adult Capacity -->
                            <div class="col-md-6 mb-3">
                                <label for="adults" class="form-label">Adult (Max.)</label>
                                <input type="number" class="form-control" id="adults" name="adults" required>
                            </div>

                            <!-- Children Capacity -->
                            <div class="col-md-6 mb-3">
                                <label for="children" class="form-label">Children (Max.)</label>
                                <input type="number" class="form-control" id="children" name="children" required>
                            </div>
                        </div>

                        <!-- Features -->
                        <div class="mb-3">
                            <label class="form-label">Features</label>
                            <div class="d-flex flex-wrap">
                                <?php
                                $sql = "SELECT * FROM `room_features`";
                                $res = mysqli_query($conn, $sql);
                                while ($data = mysqli_fetch_assoc($res)) {
                                ?>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" name="features[]" value="<?= $data['id'] ?>" id="feature1">
                                        <label class="form-check-label" for="feature1"><?= $data['name'] ?></label>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Facilities -->
                        <div class="mb-3">
                            <label class="form-label">Facilities</label>
                            <div class="d-flex flex-wrap">
                                <?php
                                $sql = "SELECT * FROM `room_facilities`";
                                $res = mysqli_query($conn, $sql);
                                while ($data = mysqli_fetch_assoc($res)) {
                                ?>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" name="facilities[]" value="<?= $data['id'] ?>" id="facility1">
                                        <label class="form-check-label" for="facility1"><?= $data['name'] ?></label>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-secondary me-2 shadow-none" data-bs-dismiss="modal">cancle</button>
                            <button type="submit" class="btn btn-success" name="add-btn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>