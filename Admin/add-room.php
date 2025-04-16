<?php
include_once("inc/admin-header.php");

// Add room
if (isset($_POST['add_room'])) {
    $room_number = $_POST['room_number'];
    $room_category_id = $_POST['room_category_id'];

    $quantity_sql = "SELECT quantity_value FROM room_categories WHERE id = $room_category_id";
    $res = mysqli_query($conn, $quantity_sql);
    $row = mysqli_fetch_assoc($res);

    $res1 = mysqli_query($conn, "SELECT COUNT(*) AS count FROM rooms WHERE room_id = $room_category_id");
    $data = mysqli_fetch_assoc($res1);

    if ($row['quantity_value'] > $data['count']) {
        $sql = "INSERT INTO rooms (room_id,room_number)
            VALUES ('$room_category_id', '$room_number')";
        mysqli_query($conn, $sql);
        echo "<script>
    alert('Room added successfully');
    window.location.href = 'add-room.php';
    </script>";
    }else{
        echo "<script>
        alert('Room can not add it crosses quantity limit');
        window.location.href = 'add-room.php';
        </script>";
    }
}

//delete
if(isset($_GET['delete_id'])){

   if(mysqli_query($conn, "UPDATE rooms SET is_deleted = 1 WHERE room_id = $_GET[delete_id]")){
    echo "<script>
        alert('Room deleted');
        window.location.href = 'add-room.php';
        </script>";
   }else{
    echo "<script>
        alert('Room not deleted');
        window.location.href = 'add-room.php';
        </script>";
   }
}

//edit
if(isset($_POST['edit_room'])){
    
    $room_number = $_POST['room_number'];
    $room_category_id = $_POST['room_category_id'];

   if(mysqli_query($conn, "UPDATE rooms SET `room_id`='$room_category_id',`room_number`='$room_number' WHERE room_id = $room_category_id")){
    echo "<script>
        alert('Room updated');
        window.location.href = 'add-room.php';
        </script>";
   }else{
    echo "<script>
        alert('Room not updated');
        window.location.href = 'add-room.php';
        </script>";
   }

}

// status toggle
if (isset($_GET['status_id'])) {

    $status_query = "SELECT `status_available` FROM `rooms` WHERE id = $_GET[status_id]";
    $result = mysqli_query($conn, $status_query);

    $status = mysqli_fetch_assoc($result);

    if ($status['status_available'] == "active") {
        $update_qu = "UPDATE `rooms` SET `status_available` = 'inactive' WHERE id = $_GET[status_id]";
    } else {
        $update_qu = "UPDATE `rooms` SET `status_available` = 'active' WHERE id = $_GET[status_id]";
    }

    $sql = mysqli_query($conn, $update_qu);

    if ($sql) {
    ?>
        <script>
            alert('status updated Successfull.');
            window.location.href = "add-room.php";
        </script>
<?php

    }
}

?>

<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> rooms
        <div>
            <button type="button" class="btn btn-success shadow-none" data-bs-toggle="modal" data-bs-target="#room">
                <i class="bi bi-plus-lg"></i> Add
            </button>
        </div>
    </div>
    <div class="table-responsive-md table-responsive-sm">
        <div class="container mt-3">
            <table class="table table-striped table-bordered">
                <thead class="sticky-top">
                    <tr class="text-center">
                        <th scope="col" class="bg-dark text-white">Room Number</th>
                        <th scope="col" class="bg-dark text-white">Category</th>
                        <th scope="col" class="bg-dark text-white">Status</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "
                        SELECT r.*, r.id AS room_no_id, rc.id, rc.name AS category 
                        FROM rooms r
                        JOIN room_categories rc ON r.room_id = rc.id WHERE is_deleted = 0
                        ");
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr class="text-center align-middle">
                            <td><?= $row['room_number'] ?></td>
                            <td><?= $row['category'] ?></td>
                            <td><a href="?status_id=<?= $row['room_no_id'] ?>" class="btn btn-<?= ($row['status_available'] == "active") ? 'success' : 'danger' ?> shadow-none"><?= $row['status_available'] ?></a></td>
                            <td>
                                <a href="?edit_id=<?= $row['id'] ?>" class="btn btn-warning shadow-none">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="?delete_id=<?= $row['id'] ?>"><button onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i></button></a>
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


<!-- add model -->
<div class="modal fade" id="room" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    Room
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="add-room.php" method="post">
                <div class="modal-body">
                    <div class="mb-2">
                        <label class="form-label">Room Category:</label>
                        <select class="form-select shadow-none" name="room_category_id" required>
                            <?php
                            $cats = mysqli_query($conn, "SELECT * FROM room_categories");
                            while ($cat = mysqli_fetch_assoc($cats)) {
                                echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Room Number:</label>
                        <input class="form-control" type="text" name="room_number" required>
                        <div class="error" id=""></div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mb-2">
                        <button type="submit" class="btn btn-primary shadow" name="add_room">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="edit_room" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    Room
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="add-room.php" method="post">
                <div class="modal-body">
                    <div class="mb-2">
                        <label class="form-label">Room Category:</label>
                        <select class="form-select shadow-none" id="edit_room_category_id" name="room_category_id" required>
                            <?php
                            $cats = mysqli_query($conn, "SELECT * FROM room_categories");
                            while ($cat = mysqli_fetch_assoc($cats)) {
                                echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Room Number:</label>
                        <input class="form-control" type="text" id="edit_room_number" name="room_number" required>
                        <div class="error" id=""></div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mb-2">
                        <button type="submit" class="btn btn-primary shadow" name="edit_room">submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
//edit
if(isset($_GET['edit_id'])){

    $sql = "SELECT * FROM `rooms` WHERE room_id = $_GET[edit_id] AND is_deleted = 0";
    $fetch = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    echo "
    <script>
    var edit_room  = new bootstrap.Modal(document.getElementById('edit_room'), {
        keyboard: false
        })
        
        document.querySelector('#edit_room_category_id').value = `$fetch[room_id]`;
        document.querySelector('#edit_room_number').value = `$fetch[room_number]`;
        edit_room.show();
    </script>
";
}
