<?php
include_once 'connection.php';

if (isset($_POST['add-btn']) || isset($_POST['edit-btn'])) {
    $name = $_POST['room_name'];
    $description = $_POST['description'];
    $price = $_POST['actual_price'];
    $quantity_value = $_POST['quantity_value'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $features = isset($_POST['features']) ? $_POST['features'] : []; // Array of feature IDs
    $facilities = isset($_POST['facilities']) ? $_POST['facilities'] : []; // Array of facility IDs

    if (isset($_POST['add-btn'])) {
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
    }

    // If Edit Room is triggered
    if (isset($_POST['edit-btn'])) {
        $room_id = $_POST['room_id'];

        if ($_FILES['room_image']['name'] != "") {
            $profile_picture = uniqid() . $_FILES['room_image']['name'];
            $profile_picture_tmp_name = $_FILES['room_image']['tmp_name'];
        }

        $q1 = "select * from `room_categories` where `id`= $room_id";
        $result = mysqli_fetch_assoc($conn->query($q1));
        $old_profile_picture = $result['image'];


        // Update Room Data
        $update = "UPDATE `room_categories` SET `name`='$name'";

        if ($_FILES['room_image']['name'] != "") {
            $update = $update . ",`image`='$profile_picture'";
        } else {
            $update = $update . ",`description`='$description', `actual_price`='$price', 
                   `quantity_value`='$quantity_value', `adult_max`='$adults', `child_max`='$children'";
        }
        $update = $update . " where id = $room_id";

        if ($conn->query($update)) {
            if ($_FILES['room_image']['name'] != "") {
                move_uploaded_file($profile_picture_tmp_name, "../img/rooms/" . $profile_picture);
                unlink("../img/rooms/" . $old_profile_picture);
            }

            // Update Features
            mysqli_query($conn, "DELETE FROM `room_features_mapping` WHERE `room_id`='$room_id'");
            foreach ($features as $feature_id) {
                mysqli_query($conn, "INSERT INTO `room_features_mapping`(`room_id`, `room_feature_id`) VALUES ('$room_id','$feature_id')");
            }

            // Update Facilities
            mysqli_query($conn, "DELETE FROM `room_facilities_mapping` WHERE `room_id`='$room_id'");
            foreach ($facilities as $facility_id) {
                mysqli_query($conn, "INSERT INTO `room_facilities_mapping`(`room_id`, `room_facility_id`) VALUES ('$room_id','$facility_id')");
            }

            setcookie("success", "Room updated successfully.", time() + 3, "/");
        } else {
            setcookie("error", "Update failed.", time() + 3, "/");
        }
    } else {
        // Insert Room Data
        $insert = "INSERT INTO `room_categories` (`name`, `image`, `description`, `actual_price`, `quantity_value`, `adult_max`, `child_max`) 
                   VALUES ('$name', '$img', '$description', '$price', '$quantity_value', '$adults', '$children')";

        if (mysqli_query($conn, $insert)) {
            $room_id = mysqli_insert_id($conn); // Get inserted room ID

            foreach ($features as $feature_id) {
                mysqli_query($conn, "INSERT INTO `room_features_mapping`(`room_id`, `room_feature_id`) VALUES ('$room_id','$feature_id')");
            }

            foreach ($facilities as $facility_id) {
                mysqli_query($conn, "INSERT INTO `room_facilities_mapping`(`room_id`, `room_facility_id`) VALUES ('$room_id','$facility_id')");
            }

            setcookie("success", "Room added successfully.", time() + 3, "/");
        } else {
            setcookie("error", "Room addition failed.", time() + 3, "/");
        }
    }
?>
    <script>
        window.location.href = 'Rooms.php';
    </script>
    <?php
}

if (isset($_GET['room_id'])) {
    $room_id = $_GET['room_id'];

    $fe = "DELETE FROM `room_features_mapping` WHERE room_id = $room_id";
    $fc = "DELETE FROM `room_facilities_mapping` WHERE room_id = $room_id";
    if (mysqli_query($conn, $fe)) {
        if (mysqli_query($conn, $fc)) {
            $select = "SELECT `image` FROM room_categories WHERE id = $room_id";
            $res = mysqli_query($conn, $select);
            $row = mysqli_fetch_assoc($res);

            if ($res && mysqli_num_rows($res) > 0) {
                $img = $row['image'];
                if (unlink("../img/rooms/" . $img)) {
                    mysqli_query($conn, "DELETE FROM `room_categories` WHERE `id` = $room_id");
                    setcookie("success", "Room deleted successfully.", time() + 3, "/");
                } else {
                    setcookie("error", "Not Deleted", time() + 3, "/");
                }
            }
        }

    ?>

        <script>
            window.location.href = "Rooms.php";
        </script>

<?php

    }
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
                        <td><strong>quantity</strong></td>
                        <td><?= $data['quantity_value'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Guests</strong></td>
                        <td><?= $data['adult_max'] ?> Adults(max), <?= $data['child_max'] ?> Children(max)</td>
                    </tr>
                    <tr>
                        <td><strong>Original Price (per night)</strong></td>
                        <td><?= $data['actual_price'] ?></td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-3">
                <a href="?edit=<?= $room_id ?>" class="btn btn-warning shadow-none"><i class="bi bi-pencil-square"></i> Edit Room</a>
                <a href="?room_id=<?= $room_id ?>"><button onclick="return confirm('Are you sure you want to delete this room?');" class="btn btn-danger">Delete Room</button></a>
            </div>
        </div>
    </div>
<?php
}
?>


<div class="modal fade" id="add_room" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    Add Room
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
                                <label for="discount_value" class="form-label">quantity</label>
                                <input type="number" class="form-control" id="quantity_value" name="quantity_value" required>
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
                                <input type="text" class="form-control" id="r_name" name="room_name">
                            </div>

                            <!-- Image Upload -->
                            <div class="col-md-6 mb-3">
                                <label for="room_image" class="form-label">Image</label> <br>
                                <img src="" id="r_image" alt="Room Image" style="max-width: 200px; margin-bottom: 5px;">
                                <input type="file" class="form-control" id="r_image" name="room_image" accept="image/*">
                            </div>

                            <!-- Actual Price -->
                            <div class="col-md-6 mb-3">
                                <label for="actual_price" class="form-label">Actual Price</label>
                                <input type="number" class="form-control" id="price" name="actual_price">
                            </div>

                            <!-- Discount Value -->
                            <div class="col-md-6 mb-3">
                                <label for="discount_value" class="form-label">quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity_value">
                            </div>

                            <!-- Adult Capacity -->
                            <div class="col-md-6 mb-3">
                                <label for="adults" class="form-label">Adult (Max.)</label>
                                <input type="number" class="form-control" id="ad_val" name="adults">
                            </div>

                            <!-- Children Capacity -->
                            <div class="col-md-6 mb-3">
                                <label for="children" class="form-label">Children (Max.)</label>
                                <input type="number" class="form-control" id="ch_val" name="children">
                            </div>
                        </div>

                        <!-- Features -->
                        <div class="mb-3">
                            <label class="form-label">Features</label>
                            <div class="d-flex flex-wrap">
                                <?php
                                // Initialize an array to store selected feature IDs
                                $selected_features = [];

                                if (isset($_GET['edit'])) {
                                    $room_id = $_GET['edit'];

                                    // Fetch selected features for the room
                                    $sql = "SELECT room_feature_id FROM `room_features_mapping` WHERE room_id = $room_id";
                                    $result = mysqli_query($conn, $sql);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $selected_features[] = $row['room_feature_id'];
                                    }
                                }

                                // Fetch all available features
                                $sql = "SELECT * FROM `room_features`";
                                $res = mysqli_query($conn, $sql);

                                while ($data = mysqli_fetch_assoc($res)) {
                                    // Check if feature is selected
                                    $checked = in_array($data['id'], $selected_features) ? "checked" : "";
                                ?>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" name="features[]" value="<?= $data['id'] ?>" <?= $checked ?> id="feature_<?= $data['id'] ?>">
                                        <label class="form-check-label" for="feature_<?= $data['id'] ?>"><?= $data['name'] ?></label>
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
                                // Initialize an array to store selected facility IDs
                                $selected_facilities = [];

                                if (isset($_GET['edit'])) {
                                    $room_id = $_GET['edit'];

                                    // Fetch selected facilities for the room
                                    $sql = "SELECT room_facility_id FROM `room_facilities_mapping` WHERE room_id = $room_id";
                                    $result = mysqli_query($conn, $sql);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $selected_facilities[] = $row['room_facility_id'];
                                    }
                                }

                                // Fetch all available facilities
                                $sql = "SELECT * FROM `room_facilities`";
                                $res = mysqli_query($conn, $sql);

                                while ($data = mysqli_fetch_assoc($res)) {
                                    // Check if facility is selected
                                    $checked = in_array($data['id'], $selected_facilities) ? "checked" : "";
                                ?>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" name="facilities[]" value="<?= $data['id'] ?>" <?= $checked ?> id="facility_<?= $data['id'] ?>">
                                        <label class="form-check-label" for="facility_<?= $data['id'] ?>"><?= $data['name'] ?></label>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="desc" name="description" rows="3"></textarea>
                            <input type="hidden" name="room_id" value="<?= $room_id ?>">
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-secondary me-2 shadow-none" data-bs-dismiss="modal">cancle</button>
                            <button type="submit" class="btn btn-success" name="edit-btn" name="edit_btn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

if (isset($_GET['edit'])) {

    $sql = "SELECT * FROM `room_categories` WHERE id = $_GET[edit]";
    $fetch = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    echo "
    <script>
        var edit_room  = new bootstrap.Modal(document.getElementById('edit_room'), {
            keyboard: false
        })
        document.querySelector('#r_name').value = `$fetch[name]`;
        document.querySelector('#price').value = `$fetch[actual_price]`;
        document.querySelector('#quantity').value = `$fetch[quantity_value]`;
        document.querySelector('#ad_val').value = `$fetch[adult_max]`;
        document.querySelector('#ch_val').value = `$fetch[child_max]`;
        document.querySelector('#desc').value = `$fetch[description]`;
        document.querySelector('#r_image').src = `../img/rooms/$fetch[image]`;
        edit_room.show();
    </script>
";
}
?>