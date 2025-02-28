<?php
include_once('inc/admin-header.php');
?>


<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Carousel Image
        <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#c-img">
            Add
        </button>
    </div>

    <?php
    require_once('connection.php');

    $sql = "SELECT * FROM `carousel`";
    $res = mysqli_query($conn, $sql);
    ?>

    <div class="card-body">
        <div class="row  d-flex align-items-center justify-content-between">

            <?php
            while ($data = mysqli_fetch_assoc($res)) {
                $status = $data['status'];
            ?>
                <div class="col-lg-6 col-md-12">
                    <div class=" text-center overflow-hidden mb-sm-3 mb-md-2">
                        <img src="../img/carousel/<?= $data['image'] ?>" class="w-100 rounded" style="height: 200px;">
                        <div class="d-flex align-items-center m-xs-0">
                            <button class="btn btn-danger btn-md mt-2 mb-2 me-3">Delete</button>
                            <button class="btn btn-danger btn-md mt-2 mb-2 me-3">Inactive</button>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </div>
</div>
</div>
</div>
</div>


<div class="modal fade" id="c-img" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    Image
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>
            <form id="carousel_pic" method="post" enctype="multipart/form-data" action="carousel.php">
                <div class="modal-body">
                    <input type="file" name="image" class="mb-1 col-md-12 form-control">
                </div>
                <div class="mb-3 mx-3">
                    <button type="submit" name="Pic_submit" class="btn btn-success shadow-none">Add</button>
                </div>
            </form>


            <script>
                $(document).ready(function() {
                    $("#carousel_pic").validate({
                        rules: {
                            image: {
                                required: true,
                            }
                        },
                        messages: {
                            image: {
                                required: "Please select a Image.",
                            }
                        },
                    });
                });
            </script>

            <?php
            function upload_image($img)
            {
                $tmpLocation = $img['tmp_name'];
                $ftype = $img['type'];
                $file = $img['name'];

                define("UPLOAD_SRC", $_SERVER['DOCUMENT_ROOT'] . "/HotelDreamNight/img/carousel/");

                $fileLocation = UPLOAD_SRC . $file;

                if ($ftype == "image/png" || $ftype == "image/jpg") {

                    if (!move_uploaded_file($tmpLocation, $fileLocation)) {
                        echo "
                               <script>alert('File uploading failed');</script>
                            ";
                        exit();
                    } else {
                        return $file;
                    }
                }
            }
            ?>

            <?php
            if (isset($_POST['Pic_submit'])) {

                $filename = upload_image($_FILES['image']);

                $insert = "INSERT INTO `carousel`(`image`) VALUES ('$filename')";

                $result = mysqli_query($conn, $insert);

                if ($result) {
                    echo "
                    <script>
                      alert('Image uploaded successfully!');
                      window.location.href = 'carousel.php';
                    </script>
                ";
                exit();
                } else {
                    echo "inserting failed" . mysqli_error($conn);
                }
            }
            ?>
        </div>
    </div>
</div>
