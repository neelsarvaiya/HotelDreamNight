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
