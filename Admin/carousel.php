<?php
include_once('inc/admin-header.php');
?>


<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Carousel Image
        <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#c-img">
            Add
        </button>
    </div>
    <div class="card-body">
        <div class="row  d-flex align-items-center justify-content-between">
            <div class="col-lg-6 col-md-12">
                <div class=" text-center overflow-hidden mb-sm-3 mb-md-2">
                    <img src="img/carousel/1.png" class="w-100 rounded" style="height: 200px;">
                    <div class="d-flex align-items-center justify-content-between mx-3 m-xs-0 non">
                        <button class="btn btn-danger btn-md mt-2 mb-2">Delete</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="text-center overflow-hidden mb-sm-3 mb-md-2">
                    <img src="img/carousel/2.png" class="w-100 rounded" style="height: 200px;">
                    <div class="d-flex align-items-center justify-content-between mx-3 m-xs-0 non">
                        <button class="btn btn-danger btn-md mt-2 mb-2">Delete</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="text-center overflow-hidden mb-sm-3 mb-md-2">
                    <img src="img/carousel/3.png" class="w-100 rounded" style="height: 200px;">
                    <div class="d-flex align-items-center justify-content-between mx-3 m-xs-0 non">
                        <button class="btn btn-danger btn-md mt-2 mb-2">Delete</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="overflow-hidden mb-sm-3 mb-md-2">
                    <img src="img/carousel/4.png" class="w-100 rounded" style="height: 200px;">
                    <div class="d-flex align-items-center justify-content-between mx-3 m-xs-0 non">
                        <button class="btn btn-danger btn-md mt-2 mb-2">Delete</button>
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
                    <label for="name">Choose Photo :</label>
                    <input type="file" name="pic" id="team" class="mb-1 col-md-12 form-control">
                </div>
                <div class="mb-3 mx-3">
                    <button type="submit" name="Pic_submit" class="btn btn-success shadow-none">Save</button>
                </div>
            </form>

            <?php
            if (isset($_POST['Pic_submit'])) {

                $ftype = $_FILES['pic']['type'];
                $fsize = $_FILES['pic']['size'];
                if ($ftype == "image/png" || $ftype == "image/jpg") {

                    if ($fsize <= 1024 * 1024) {

                        if (!is_dir("uploads")) {
                            mkdir("uploads");
                        }

                        $fname = uniqid() . $_FILES['pic']['name'];
                        if (move_uploaded_file($_FILES['pic']['tmp_name'], "uploads/" . $fname)) {
                            echo "<script>
                            alert('File Uploaded Successfull...')
                        </script>";
                        }
                    } else {
            ?>
                        <script>
                            alert('File is larger than 1 KB. Please select a smaller file.')
                        </script>

                    <?php
                    }
                } else {
                    ?>
                    <script>
                        alert('File is not a png or jpg file')
                    </script>
            <?php
                }
            }
            ?>

        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("#carousel_pic").validate({
            rules: {
                pic: {
                    required: true,
                }
            },
            messages: {
                pic: {
                    required: "Please select a profile picture.",
                }
            },
        });
    });
</script>
<?php
include_once('inc/admin-footer.php');
?>