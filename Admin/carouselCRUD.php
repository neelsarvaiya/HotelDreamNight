<?php
include_once('connection.php');

define("UPLOAD_SRC", $_SERVER['DOCUMENT_ROOT'] . "/HotelDreamNight/img/carousel/");

function upload_image($img)
{
    $tmpLocation = $img['tmp_name'];
    $file = $img['name'];

    $fileLocation = UPLOAD_SRC . $file;

    if (!move_uploaded_file($tmpLocation, $fileLocation)) {
        setcookie("error", "Image Uploading Failed.", time() + 3, "/");
?>
        <script>
            window.location.href = "carousel.php";
        </script>
    <?php
        exit();
    } else {
        return $file;
    }
}

if (isset($_POST['add'])) {

    $filename = upload_image($_FILES['image']);

    $insert = "INSERT INTO `carousel`(`image`) VALUES ('$filename')";

    $result = mysqli_query($conn, $insert);

    if ($result) {
        setcookie("success", "Inserting Successfull.", time() + 3, "/");
    ?>
        <script>
            window.location.href = "carousel.php";
        </script>
    <?php
        exit();
    } else {
        setcookie("error", "Inserting Failed", time() + 3, "/");
    ?>
        <script>
            window.location.href = "carousel.php";
        </script>
    <?php
        exit();
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $select = "SELECT `image` FROM carousel WHERE id = $id";
    $res = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($res);

    if ($res && mysqli_num_rows($res) > 0) {
        $img = $row['image'];
        if (unlink(UPLOAD_SRC . $img)) {
            mysqli_query($conn, "DELETE FROM `carousel` WHERE `id` = $id");
            setcookie("success", "Deleted Successfully.", time() + 3, "/");
        } else {
            setcookie("error", "Not Deleted", time() + 3, "/");
        }
    }

    ?>

    <script>
        window.location.href = "carousel.php";
    </script>

    <?php

}

if (isset($_GET['status_id'])) {

    $status_query = "SELECT `status` FROM `carousel` WHERE id = $_GET[status_id]";
    $result = mysqli_query($conn, $status_query);

    $status = mysqli_fetch_assoc($result);

    if ($status['status'] == "active") {
        $update_qu = "UPDATE `carousel` SET `status` = 'inactive' WHERE id = $_GET[status_id]";
    } else {
        $update_qu = "UPDATE `carousel` SET `status` = 'active' WHERE id = $_GET[status_id]";
    }

    $sql = mysqli_query($conn, $update_qu);

    if ($sql) {
        setcookie("success", "status updated Successfull.", time() + 3, "/");
    ?>
        <script>
            window.location.href = "carousel.php";
        </script>
<?php
        exit;
    }
}
