<?php
include_once('inc/admin-header.php');
?>
<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Carousel
        <div>
            <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#c-img">
                Add
            </button>
            <a href="#" class="btn btn-danger text-light"><i class="bi bi-trash"></i> Delete all</a>
        </div>
    </div>
    <div class="table-responsive-lg table-responsive-lg" style="z-index: 1;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered">
                <thead class="sticky-top">
                    <?php
                    $sql = "SELECT * FROM carousel";
                    $res = mysqli_query($conn, $sql);

                    ?>
                    <tr>
                        <th scope="col" class="bg-dark text-white">Sr no.</th>
                        <th scope="col" class="bg-dark text-white">Image</th>
                        <th scope="col" class="bg-dark text-white">Status</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data = mysqli_fetch_assoc($res)) {
                    ?>
                        <tr>
                            <td><?= $data['id'] ?></td>
                            <td><img src="../img/carousel/<?= $data['image'] ?>" height="200px" width="500px" alt="" srcset=""></td>
                            <td><button class="btn btn-<?php 
                            if($data['status'] == "active")
                             echo "info";
                            else 
                             echo "danger";
                            ?> btn-md mx-1"><?= $data['status'] ?></button></td>
                            <td><button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
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
                    <input type="file" name="image" class="mb-1 col-md-12 form-control" data-validation="required file">
                    <div class="error" id="imageError"></div>
                </div>
                <div class="mb-3 mx-3">
                    <button type="submit" name="Pic_submit" class="btn btn-success shadow-none">Add</button>
                </div>
            </form>



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