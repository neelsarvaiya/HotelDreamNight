<?php

require_once('connection.php');

function upload_image($img)
{
    $tmpLocation = $img['tmp_name'];
    $file = $img['name'];

    $fileLocation = UPLOAD_SRC . $file;


    if (!move_uploaded_file($tmpLocation, $fileLocation)) {
        echo "
           <script>alert('File uploading failed');</script>
        ";
        exit();
    }else{
        return $file;
    }
}

if (isset($_POST['upload'])) {

    $id = $_POST['id'];
    $filename =  upload_image($_FILES['image']);

    $insert = "INSERT INTO `carousel`(`id`,`image`) VALUES ($id,'$filename')";

    $result = mysqli_query($conn, $insert);
    
    if($result){
        echo "
           <script>alert('image uploaded');</script>
        ";
        header("Location: slider.php");
    }
    else{
        echo "inserting failed".mysqli_error($conn);
    }

}

?>
