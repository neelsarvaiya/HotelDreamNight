<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamNights Hotel | Our Rooms </title>
    <?php
    require('inc/link.php');
    ?>
</head>

<body class="bg-light">

    <?php
    require('inc/header.php');
    ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Our Rooms</h2>
        <div class="h-line bg-dark"></div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 mb-lg-0 col-md-12 mb-4 ps-4">
                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2 h-font fs-5">CHECK BOOKING AVAILABILITY : </h4>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                            data-bs-target="#filterDrowpdown" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDrowpdown">
                            <form id="bookingForm" action="rooms.php" method="POST">
                                <div class="border bg-light p-3 rounded mb-3">
                                    <label for="checkin" class="form-label">Check-in: </label>
                                    <input type="date" id="checkin" name="checkin" class="form-control shadow-none mb-3">
                                    <label for="checkout" class="form-label">Check-Out: </label>
                                    <input type="date" id="checkout" name="checkout" class="form-control shadow-none">
                                </div>
                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3 h-font" style="font-size: 18px;">FACILITIES: </h5>
                                    <div class="mb-2">
                                        <input type="checkbox" id="f1" name="facilities[]" value="Facility 1" class="form-check-input shadow-none me-1">
                                        <label for="f1" class="form-check-label">Wifi</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="checkbox" id="f2" name="facilities[]" value="Facility 2" class="form-check-input shadow-none me-1">
                                        <label for="f2" class="form-check-label">Room Heater</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="checkbox" id="f3" name="facilities[]" value="Facility 3" class="form-check-input shadow-none me-1">
                                        <label for="f3" class="form-check-label">Air Conditioner</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="checkbox" id="f3" name="facilities[]" value="Facility 3" class="form-check-input shadow-none me-1">
                                        <label for="f3" class="form-check-label">Spa</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="checkbox" id="f3" name="facilities[]" value="Facility 3" class="form-check-input shadow-none me-1">
                                        <label for="f3" class="form-check-label">Television</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="checkbox" id="f3" name="facilities[]" value="Facility 3" class="form-check-input shadow-none me-1">
                                        <label for="f3" class="form-check-label">Geyser</label>
                                    </div>
                                </div>
                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3 h-font" style="font-size: 18px;">GUESTS: </h5>
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <label for="adults" class="form-label">Adults</label>
                                            <input type="number" id="adults" name="adults" class="form-control shadow-none" maxlength="2">
                                        </div>
                                        <div>
                                            <label for="children" class="form-label">Children</label>
                                            <input type="number" id="children" name="children" class="form-control shadow-none" maxlength="2">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-3 fs-5">Check</button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="col-lg-9 col-md-12 px-4">
                <div class="card mb-4 border-0 shadow">
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
                            <div class="rating mb-3">
                                <h6>Rating</h6>
                                <span class="badge rounded-pill bg-light">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star text-warning"></i>
                                    <i class="bi bi-star text-warning"></i>
                                </span>
                            </div>
                        </div>

                        <?php

                        $bookNowUrl = "#";
                        $loginAlert = "";

                        if (isset($_COOKIE['user'])) {
                            $bookNowUrl = "booking.php";
                        } else {

                            $loginAlert = "alert('Please login for booking.');";
                        }
                        ?>

                        <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                            <h6 class="mb-4">₹3000 per night</h6>
                            <a href="<?php echo $bookNowUrl; ?>"
                                onclick="<?php echo $loginAlert; ?> return <?php echo isset($_SESSION['email']) ? 'true' : 'false'; ?>;"
                                class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2"
                                name="book">
                                Book now
                            </a>
                            <a href="simple.php" class="btn btn-sm w-100 btn-outline-dark shadow-none">More Details</a>
                        </div>

                    </div>
                </div>
                <div class="card mb-4 border-0 shadow">
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
                            <div class="rating mb-4">
                                <h6>Rating</h6>
                                <span class="badge rounded-pill bg-light">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star text-warning"></i>
                                    <i class="bi bi-star text-warning"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                            <h6 class="mb-4">₹6000 per night</h6>
                            <a href="<?php echo $bookNowUrl; ?>"
                                onclick="<?php echo $loginAlert; ?> return <?php echo isset($_SESSION['email']) ? 'true' : 'false'; ?>;"
                                class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2"
                                name="book">
                                Book now
                            </a>
                            <a href="deluxe.php" class="btn btn-sm w-100 btn-outline-dark shadow-none">More Details</a>
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
                            <div class="rating mb-4">
                                <h6>Rating</h6>
                                <span class="badge rounded-pill bg-light">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star text-warning"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                            <h6 class="mb-4">₹8000 per night</h6>
                            <a href="<?php echo $bookNowUrl; ?>"
                                onclick="<?php echo $loginAlert; ?> return <?php echo isset($_SESSION['email']) ? 'true' : 'false'; ?>;"
                                class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2"
                                name="book">
                                Book now
                            </a>
                            <a href="luxury.php" class="btn btn-sm w-100 btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 border-0 shadow">
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
                            <div class="rating mb-4">
                                <h6>Rating</h6>
                                <span class="badge rounded-pill bg-light">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                            <h6 class="mb-4">₹10000 per night</h6>
                            <a href="<?php echo $bookNowUrl; ?>"
                                onclick="<?php echo $loginAlert; ?> return <?php echo isset($_SESSION['email']) ? 'true' : 'false'; ?>;"
                                class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2"
                                name="book">
                                Book now
                            </a>
                            <a href="supreme_deluxe.php" class="btn btn-sm w-100 btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require('inc/footer.php');
    ?>

</body>

</html>

<script>
    $(document).ready(function() {

        $.validator.addMethod("atLeastOneCheckbox", function(value, element) {
            return $("input[name='facilities[]']:checked").length > 0;
        }, "Please select at least one facility.");

        $("#bookingForm").validate({
            rules: {
                checkin: {
                    required: true,
                    date: true
                },
                checkout: {
                    required: true,
                    date: true
                },
                adults: {
                    required: true,
                    min: 1
                },
                children: {
                    required: true,
                    min: 0
                },
                "facilities[]": {
                    atLeastOneCheckbox: true
                },
            },
            messages: {
                checkin: {
                    required: "Please select a check-in date.",
                    date: "Please enter a valid date."
                },
                checkout: {
                    required: "Please select a check-out date.",
                    date: "Please enter a valid date."
                },
                adults: {
                    required: "Please specify the number of adults.",
                    min: "There must be at least one adult."
                },
                children: {
                    required: "Please specify the number of children.",
                    min: "The number of children cannot be negative."
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "facilities[]") {
                    error.addClass("text-danger").appendTo(element.closest(".border"));
                } else {
                    error.addClass("text-danger");
                    error.insertAfter(element);
                }
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