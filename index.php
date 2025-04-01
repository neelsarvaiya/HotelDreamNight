<?php

include_once('inc/header.php');
?>

<style>
    .custom-bg {
        background-color: var(--teal);
        border: 1px solid var(--teal);
    }

    .fade-in {
        opacity: 0;
        animation: fadeIn 2s ease-in forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .bounce:hover {
        animation: bounce 1s;
    }

    @keyframes bounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }
    }
</style>

<?php

$insert = "SELECT * FROM `carousel` where `status`='active';";
$res = mysqli_query($conn, $insert);

?>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php
        $firstimg = true;
        while ($data = mysqli_fetch_assoc($res)) {
        ?>
            <div class="carousel-item <?= $firstimg ? 'active' : '' ?>">
                <img src="img/carousel/<?= $data['image'] ?>" class="d-block w-100">
            </div>
        <?php
            $firstimg = false;
        }
        ?>
    </div>
</div>

<h2 class="mt-5 pt-4 mb-3 text-center fw-bold h-font fade-in">Our Rooms</h2>
<div class="h-line bg-dark"></div>

<div class="container">
    <div class="row">
        <?php
        $sql = "SELECT * FROM `room_categories` WHERE id = 16 OR id = 21 OR id = 22 And status='active'";
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $room_id = $data['id'];

        ?>

            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="img/rooms/<?= $data['image'] ?>" class="card-img-top rounded">
                    <div class="card-body">
                        <h5><?= $data['name'] ?></h5>
                        <h6 class="mb-4">₹<?= $data['actual_price'] ?> per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features : </h6>
                            <?php
                            $sql = "SELECT rf.name FROM `room_features` rf JOIN `room_features_mapping` rfm ON rfm.room_feature_id = rf.id WHERE rfm.room_id = $room_id AND rf.status = 'active'";
                            $features = mysqli_query($conn, $sql);
                            while ($feature = mysqli_fetch_assoc($features)) {
                            ?>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <?= $feature['name'] ?>
                                </span>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="facilities mb-4">
                            <h6>Facilities : </h6>
                            <?php
                            $sql = "SELECT rf.name FROM `room_facilities` rf JOIN `room_facilities_mapping` rfm ON rfm.room_facility_id = rf.id WHERE rfm.room_id = $room_id AND rf.status = 'active'";
                            $facilities = mysqli_query($conn, $sql);
                            while ($facility = mysqli_fetch_assoc($facilities)) {
                            ?>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <?= $facility['name'] ?>
                                </span>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="guests mb-4">
                            <h6>Guests : </h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                <?= $data['adult_max'] ?> Adults
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                <?= $data['child_max'] ?> Children
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
                        <span class="badge rounded-pill bg-success text-white text-wrap mb-2" style="font-size: 13px; line-height:15px;">
                            25% Off for Early Bookings (30+ days in advance)
                        </span>
                        <h6 class="mb-2 text-center" style="text-decoration: line-through;">₹<?= $data['actual_price'] ?> per night</h6>
                        <span class="text-dark text-wrap mb-2">
                            <h6 class="text-center mb-3">₹50000 per night</h6>
                        </span>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="booking.php?room_id=<?= $data['id'] ?>"
                                onclick="return checkLogin(event);"
                                class="btn btn-sm text-white custom-bg shadow-none">
                                Book now
                            </a>
                            <a href="more_details.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function checkLogin(event) {
                    <?php if (!isset($_SESSION['user'])) { ?>
                        event.preventDefault();
                        alert("⚠ You must log in to book a room!");
                        window.location.href = "index.php";
                        return false;
                    <?php } ?>
                    return true;
                }
            </script>

        <?php
        }
        ?>

        <div class="col-ld-12 text-center mt-5">
            <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 shadow-none">More Rooms >>></a>
        </div>
    </div>
</div>

<h2 class="mt-5 pt-4 mb-3 text-center fw-bold h-font ">Our Facilities</h2>
<div class="h-line bg-dark"></div>
<div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
        <?php
        $select = "SELECT * FROM room_facilities WHERE status = 'active'";
        $query = mysqli_query($conn, $select);

        while ($row = mysqli_fetch_assoc($query)) {
        ?>
            <div class="col-lg-3 me-5 col-md-2 text-center bg-white rounded shadow py-4 my-3 bounce">
                <img class="me-3" src="img/facilities/<?= $row['image'] ?>" width="80ppx">
                <h5 class="mt-3"><?= $row['name'] ?></h5>
            </div>
        <?php
        }
        ?>
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


<?php
include_once('inc/footer.php');
?>