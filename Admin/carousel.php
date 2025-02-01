<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Settings</title>
    <link rel="stylesheet" href="css/common.css">
</head>

<body class="bg-light">
    <?php
    require('inc/admin-header.php');
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
                <form id="manage_team" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label for="name">Choose Photo :</label>
                        <input type="file" name="team" id="team" class="mb-1 col-md-12 form-control">
                    </div>
                    <div class="mb-3 mx-3">
                        <button type="submit" class="btn btn-success shadow-none">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <h6 class="text-center bg-dark text-white p-3 m-0 h-font">@Designed and Developed by DreamNights Hotel</h6>


</body>

</html>