<?php
require_once('connection.php');

// Delete staf
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($id > 0) {
        $delete = "SELECT `image` FROM `staff` WHERE `id` = $id";
        $result = mysqli_query($conn, $delete);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $image = $row['image'];
            define("DELETE_SRC", $_SERVER['DOCUMENT_ROOT'] . "/HotelDreamNight/img/about/");
            unlink(DELETE_SRC . $image);
        }

        $delete = "DELETE FROM `staff` WHERE `id` = $id";
        if (mysqli_query($conn, $delete)) {
            setcookie("success", "Deleted Successfull", time() + 3, "/");
?>
            <script>
                window.location.href = 'settings.php';
            </script>
        <?php
        } else {
            setcookie("error", "NOt Deleted Successfull", time() + 3, "/");
        ?>
            <script>
                window.location.href = 'settings.php';
            </script>
<?php
        }
    }
}
?>

<?php


// Add staf
if (isset($_POST['add'])) {

    $img = $_FILES['team_management']['name'];
    $name = $_POST['name4'];

    define("UPLOAD_SRC", $_SERVER['DOCUMENT_ROOT'] . "/HotelDreamNight/img/about/");

    if (move_uploaded_file($_FILES['team_management']['tmp_name'], UPLOAD_SRC . $img)) {

        $insert = "INSERT INTO `team`(`image`, `name`) VALUES ('$img','$name')";
        $res = mysqli_query($conn, $insert);

        if ($res) {
            setcookie("success", "Team Added Successfull.", time() + 3, "/");
?>
            <script>
                window.location.href = "settings.php";
            </script>
        <?php
        } else {
            setcookie("error", "Error To Add", time() + 3, "/");
        ?>
            <script>
                window.location.href = "settings.php";
            </script>
<?php
        }
    }
}

?>