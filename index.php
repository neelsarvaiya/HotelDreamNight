<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamNights Hotel | Home </title>
    <?php
    require('inc/link.php');
    ?>
    <style>
        .pop {
            transition: all ease 0.5s;
        }

        .pop:hover {
            border-top-color: var(--teal) !important;
            transform: scaleX(1.1) scaleY(0.9);
        }
    </style>
</head>

<body class="bg-light">

    <?php
    require('inc/header.php');
    ?>

    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/carousel/1.png" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="img/carousel/2.png" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="img/carousel/3.png" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="img/carousel/4.png" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="img/carousel/5.png" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="img/carousel/6.png" class="d-block w-100">
            </div>
        </div>
    </div>

    <h2 class="mt-5 pt-4 mb-3 text-center fw-bold h-font ">Our Rooms</h2>
    <div class="h-line bg-dark"></div>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="img/rooms/2.png" class="card-img-top rounded">
                    <div class="card-body">
                        <h5>Supreme Deluxe Room</h5>
                        <h6 class="mb-4">₹10000 per night</h6>
                        <div class="features mb-4">
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
                        <div class="facilities mb-4">
                            <h6>Facilities : </h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Geyser
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Air Conditioner
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Wi-Fi
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Room Heater
                            </span>
                        </div>
                        <div class="guests mb-4">
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
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#"
                                onclick="alert('Please login forn Booking...');"
                                class="btn btn-sm text-white custom-bg shadow-none"
                                name="book">
                                Book now
                            </a>
                            <a href="supreme_deluxe.php" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="img/rooms/4.png" class="card-img-top rounded">
                    <div class="card-body">
                        <h5>Luxury Room</h5>
                        <h6 class="mb-4">₹8000 per night</h6>
                        <div class="features mb-4">
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
                        <div class="facilities mb-4">
                            <h6>Facilities : </h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Room Heater
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Air Conditioner
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Wi-Fi
                            </span>
                        </div>
                        <div class="guests mb-4">
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
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="booking.php"
                                class="btn btn-sm text-white custom-bg shadow-none">
                                Book now
                            </a>
                            <a href="luxury.php" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="img/rooms/8.png" class="card-img-top rounded">
                    <div class="card-body">
                        <h5>Deluxe Room</h5>
                        <h6 class="mb-4">₹6000 per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features : </h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Bed Room
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Balcony
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Kitchen
                            </span>
                        </div>
                        <div class="facilities mb-4">
                            <h6>Facilities : </h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Geyser
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Room Heater
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Air Conditioner
                            </span>
                        </div>
                        <div class="guests mb-4">
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
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="booking.php"
                                class="btn btn-sm text-white custom-bg shadow-none"
                                name="book">
                                Book now
                            </a> <a href="deluxe.php" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-ld-12 text-center mt-5">
                <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 shadow-none">More Rooms >>></a>
            </div>
        </div>
    </div>

    <h2 class="mt-5 pt-4 mb-3 text-center fw-bold h-font ">Our Facilities</h2>
    <div class="h-line bg-dark"></div>
    <div class="container">
        <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow  py-4 my-3 pop">
                <img src="img/facilities/wifi6.svg" width="80ppx">
                <h5 class="mt-3">Geyser</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow  py-4 my-3 pop">
                <img src="img/facilities/wifi2.svg" width="80ppx">
                <h5 class="mt-3">Room Heater</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow  py-4 my-3 pop">
                <img src="img/facilities/wifi3.svg" width="80ppx">
                <h5 class="mt-3">Air Conditioner</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow  py-4 my-3 pop">
                <img src="img/facilities/wifi4.svg" width="80ppx">
                <h5 class="mt-3">Spa</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow  py-4 my-3 pop">
                <img src="img/facilities/wifi5.svg" width="80ppx">
                <h5 class="mt-3">Television</h5>
            </div>
            <div class="col-lg-12 text-center mt-5">
                <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 shadow-none">More Facilities >>></a>
            </div>
        </div>
    </div>

    <h2 class="mt-5 pt-4 mb-3 text-center fw-bold h-font ">Testimonials</h2>
    <div class="h-line bg-dark"></div>
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6  my-3 bg-white border-3 border-dark m-3">
                <div class="profile d-flex align-items-center mb-3 mt-3">
                    <img src="img/a1.jpg" width="60px" height="60px" class="rounded-circle">
                    <h6 class="m-0 ms-2">Alessandro Rossi</h6>
                </div>
                <p>
                    DreamNights Hotel exceeded all my expectations! The rooms were spotless, The facilities were top-notch, and the staff went above and beyond to make us feel welcome. the staff was incredibly friendly, and the location was perfect. I'll definitely be returning!.
                </p>
                <div class="rating">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 my-3 border-2 border-dark bg-white m-3">
                <div class="profile d-flex align-items-center mb-3 mt-3">
                    <img src="img/a2.jpeg" width="60px" height="60px" class="rounded-circle">
                    <h6 class="m-0 ms-2">Sopia Becker</h6>
                </div>
                <p>
                    We stayed for a week with our kids and had an amazing time. The facilities were top-notch, and the staff went above and beyond to make us feel welcome. Highlyrecommended!
                </p>
                <div class="rating">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star text-warning"></i>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 my-3 border-2 border-dark bg-white m-3">
                <div class="profile d-flex align-items-center mb-3 mt-3">
                    <img src="img/a3.jpg" width="60px" height="60px" class="rounded-circle">
                    <h6 class="m-0 ms-2">Marco Bianchi</h6>
                </div>
                <p>
                    DreamNights Hotel provided me everything I needed during my business trip. The facilities were top-notch. The Wi-Fi was fast, the conference facilities were excellent, and the service was impeccable. the staff was incredibly friendly.
                </p>
                <div class="rating">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star text-warning"></i>
                </div>
            </div>
        </div>
        <div class="col-ld-12 text-center mt-5">
            <a href="about.php" class="btn btn-sm btn-outline-dark rounded-0 shadow-none">Know More >>></a>
        </div>
    </div>

    <h2 class="mt-5 pt-4 mb-3 text-center fw-bold h-font ">Reach Us</h2>
    <div class="h-line bg-dark"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-3 bg-white rounded">
                <iframe class="w-100 rounded" height="320px"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118147.82106509873!2d70.73889453087791!3d22.273466166686283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959c98ac71cdf0f%3A0x76dd15cfbe93ad3b!2sRajkot%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1734684297133!5m2!1sen!2sin"
                    loading="lazy"></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 ronded mb-4">
                    <h5 class="h-font">Call Us</h5>
                    <a href="tel: +917778889991" class="d-inline-block mb-2 text-decoration-none text-dark"><i
                            class="bi bi-telephone-fill"></i> +91 7778889991</a><br>
                    <a href="tel: +91852936985" class="d-inline-block text-decoration-none text-dark"><i
                            class="bi bi-telephone-fill"></i> +91 8529636985</a>
                </div>
                <div class="bg-white p-4 ronded mb-4">
                    <h5 class="h-font">Follow Us</h5>
                    <a href="https://www.twitter.com/" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-twitter me-1"></i> Twitter
                        </span>
                    </a><br>
                    <a href="https://www.facebook.com/" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-facebook me-1"></i> FaceBook
                        </span>
                    </a><br>
                    <a href="https://www.instagram.com/" class="d-inline-block">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-instagram me-1"></i> Instagram
                        </span>
                    </a>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <?php
    require('inc/footer.php');
    ?>

    <script>
        $(document).ready(function() {


            $("#check").validate({
                rules: {
                    checkin: {
                        required: true,
                        date: true
                    },
                    checkout: {
                        required: true,
                        date: true
                    },
                    adult: {
                        required: true
                    },
                    child: {
                        required: true
                    }
                },
                messages: {

                    checkin: {
                        required: "Please Enter Your Check-in date ",
                        date: "Please enter valid date"
                    },
                    checkout: {
                        required: "Please Enter Your Check-Out date ",
                        date: "Please enter valid date"
                    },
                    adult: {
                        required: "Please select an Adults"
                    },
                    child: {
                        required: "Please select Children"
                    }
                }
            })
        });
    </script>

</body>

</html>