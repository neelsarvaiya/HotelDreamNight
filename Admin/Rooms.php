<?php
include_once("inc/admin-header.php");
?>

<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Rooms
        <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#edit_room">
            Add
        </button>
    </div>

    <div class="card mb-2 border-0 shadow mt-4">
        <div class="row g-0 p-3 align-items-center">
            <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                <img src="img/rooms/3.png" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-5 px-lg-3 px-md-3 px-0">
                <h5 class="mb-3">Simple Room</h5>
                <div class="features mb-3">
                    <h6 class="mb-1">Features : </h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Bed Rooms
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Balcony
                    </span>
                </div>
                <div class="facilities mb-3">
                    <h6>Facilities : </h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Air Conditioner
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Television
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Room Heater
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Geyser
                    </span>
                </div>
                <div class="guests44 mb-3">
                    <h6>Guests : </h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        5 Adults
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        3 Children
                    </span>
                </div>
                <div class="mb-3">
                    <h6>Price : </h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        ₹3000
                    </span>
                </div>
            </div>
            <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                <button class="btn btn-danger"> <i class="bi bi-trash"></i> Delete</button>
                <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#edit_room">
                    Edit
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit_room" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center h-font">
                        <i class="bi bi-person-circle fs-3 me-2"></i> Room
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <form id="edit_room_form" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label for="team">Choose Photo:</label>
                        <input type="file" name="pic" id="team" class="mb-2 col-md-12 form-control"> <br>

                        <label for="room_name" class="mt-1">Room Name:</label>
                        <input type="text" name="room_name" id="room_name" placeholder="Enter Room Name:" class="form-control col-md-12"> <br>

                        <label for="feature_name" class="mt-1">Feature Name:</label>
                        <input type="text" name="feature_name" id="feature_name" placeholder="Enter Feature Name:" class="form-control col-md-12"> <br>

                        <label for="facilities_name" class="mt-2">Facilities Name:</label>
                        <input type="text" name="facilities_name" id="facilities_name" placeholder="Enter Facilities Name:" class="form-control col-md-12"> <br>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="adults_number">Adults Number:</label>
                                <input type="number" name="adults_number" id="adults_number" placeholder="Enter Adults Number:" class="form-control col-md-6"> <br>
                            </div>
                            <div class="col-md-6">
                                <label for="children_number">Children Number:</label>
                                <input type="number" name="children_number" id="children_number" placeholder="Enter Children Number:" class="form-control col-md-6"> <br>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-2">
                            <button type="submit" name="Pic_submit" class="btn btn-success shadow" name="login">Save</button>
                        </div>
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

    <div class="card mb-4 border-0 shadow mt-3">
        <div class="row g-0 p-3 align-items-center">
            <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                <img src="img/rooms/8.png" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-5 px-lg-3 px-md-3 px-0">
                <h5 class="mb-3">Deluxe Room </h5>
                <div class="features mb-3">
                    <h6 class="mb-1">Features : </h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Bed Rooms
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Balcony
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Kitchen
                    </span>
                </div>
                <div class="facilities mb-3">
                    <h6>Facilities : </h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Air Conditioner
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Room Heater
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Geyser
                    </span>
                </div>
                <div class="guests44 mb-3">
                    <h6>Guests : </h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        3 Adults
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        2 Children
                    </span>
                </div>
                <div class="mb-3">
                    <h6>Price : </h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        ₹6000
                    </span>
                </div>
            </div>
            <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                <button class="btn btn-danger"><i class="bi bi-trash"></i> Delete</button>
                <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#edit_room">
                    Edit
                </button>
            </div>
        </div>
    </div>
    <div class="card mb-4 border-0 shadow">
        <div class="row g-0 p-3 align-items-center">
            <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                <img src="img/rooms/4.png" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-5 px-lg-3 px-md-3 px-0">
                <h5 class="mb-3">Luxury Room</h5>
                <div class="features mb-3">
                    <h6 class="mb-1">Features : </h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Bed Rooms
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Balcony
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Kitchen
                    </span>
                </div>
                <div class="facilities mb-3">
                    <h6>Facilities : </h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Wi-Fi
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Air Conditioner
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Room Heater
                    </span>
                </div>
                <div class="guests44 mb-3">
                    <h6>Guests : </h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        8 Adults
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        6 Children
                    </span>
                </div>
                <div class="mb-3">
                    <h6>Price : </h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        ₹8000
                    </span>
                </div>
            </div>
            <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                <button class="btn btn-danger"><i class="bi bi-trash"></i> Delete</button>
                <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#edit_room">
                    Edit
                </button>
            </div>
        </div>
    </div>
    <div class="card mb-2 border-0 shadow">
        <div class="row g-0 p-3 align-items-center">
            <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                <img src="img/rooms/2.png" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-5 px-lg-3 px-md-3 px-0">
                <h5 class="mb-3">Supreme Deluxe Room</h5>
                <div class="features mb-3">
                    <h6 class="mb-1">Features : </h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Bed Rooms
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Balcony
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Kitchen
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        BathRooms
                    </span>
                </div>
                <div class="facilities mb-3">
                    <h6>Facilities : </h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Wi-Fi
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Air Conditioner
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Room Heater
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        Geyser
                    </span>
                </div>
                <div class="guests44 mb-3">
                    <h6>Guests : </h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        9 Adults
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        10 Children
                    </span>
                </div>
                <div class="mb-3">
                    <h6>Price : </h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        ₹10000
                    </span>
                </div>
            </div>
            <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                <button class="btn btn-danger"><i class="bi bi-trash"></i> Delete</button>
                <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#edit_room">
                    Edit
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#edit_room_form").validate({
            rules: {
                pic: {
                    required: true,
                },
                room_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                feature_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                facilities_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                adults_number: {
                    required: true,
                    min: 1
                },
                children_number: {
                    required: true,
                    min: 0
                }
            },
            messages: {
                pic: {
                    required: "Please upload a photo.",
                },
                room_name: {
                    required: "Please enter the room name.",
                    minlength: "Room name must be at least 3 characters long.",
                    maxlength: "Room name cannot exceed 50 characters."
                },
                feature_name: {
                    required: "Please enter the feature name.",
                    minlength: "Feature name must be at least 3 characters long.",
                    maxlength: "Feature name cannot exceed 50 characters."
                },
                facilities_name: {
                    required: "Please enter the facilities name.",
                    minlength: "Facilities name must be at least 3 characters long.",
                    maxlength: "Facilities name cannot exceed 50 characters."
                },
                adults_number: {
                    required: "Please enter the number of adults.",
                    min: "There must be at least one adult."
                },
                children_number: {
                    required: "Please enter the number of children.",
                    min: "The number of children cannot be negative."
                }
            },
            errorPlacement: function(error, element) {
                error.addClass("text-danger");
                error.insertAfter(element);
            },
            highlight: function(element) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function(element) {
                $(element).removeClass("is-invalid");
            }
        });
    });
</script>
<?php
include_once('inc/admin-footer.php');
?>