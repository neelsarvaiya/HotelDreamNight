<?php
include_once('inc/header.php');
?>
<style>
    .custom-bg {
        background-color: var(--teal);
        border: 1px solid var(--teal);
    }

    .slide-top {
        opacity: 0;
        transform: translateY(-100%);
        animation: slideTop 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
    }

    @keyframes slideTop {
        from {
            opacity: 0;
            transform: translateY(-300%);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center slide-top">Our Rooms</h2>
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
                        <form action="rooms.php" id="bookingForm" method="post">
                            <div class="border bg-light p-3 rounded mb-3">
                                <label for="checkin1" class="form-label">Check-in: </label>
                                <input type="date" id="checkin1" name="checkin1" class="form-control shadow-none mb-3" data-validation="required">
                                <div class="error" id="checkin1Error"></div>

                                <label for="checkout1" class="form-label">Check-Out: </label>
                                <input type="date" id="checkout1" name="checkout1" class="form-control shadow-none" data-validation="required">
                                <div class="error" id="checkout1Error"></div>
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3 h-font" style="font-size: 18px;">FACILITIES: </h5>
                                <div class="mb-2">
                                    <input type="checkbox" id="f1" name="facilities[]" data-validation="required terms" value="Facility 1" class="form-check-input shadow-none me-1">
                                    <label for="f1" class="form-check-label">Wifi</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="" name="facilities[]" value="Facility 2" class="form-check-input shadow-none me-1">
                                    <label for="f2" class="form-check-label">Room Heater</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="" name="facilities[]" value="Facility 3" class="form-check-input shadow-none me-1">
                                    <label for="f3" class="form-check-label">Air Conditioner</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="" name="facilities[]" value="Facility 3" class="form-check-input shadow-none me-1">
                                    <label for="f3" class="form-check-label">Spa</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="" name="facilities[]" value="Facility 3" class="form-check-input shadow-none me-1">
                                    <label for="f3" class="form-check-label">Television</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="" name="facilities[]" value="Facility 3" class="form-check-input shadow-none me-1">
                                    <label for="f3" class="form-check-label">Geyser</label>
                                </div>
                                <div class="error" id="facilities[]Error"></div>
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3 h-font" style="font-size: 18px;">GUESTS: </h5>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label for="adults" class="form-label">Adults</label>
                                        <input type="number" id="adults" name="adults" class="form-control shadow-none" data-validation="required numeric">
                                        <div class="error" id="adultsError"></div>
                                    </div>
                                    <div>
                                        <label for="children" class="form-label">Children</label>
                                        <input type="number" id="children" name="children" class="form-control shadow-none" data-validation="required">
                                        <div class="error" id="childrenError"></div>
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
            <?php
            $sql = "SELECT * FROM `room_categories` WHERE status='active'";
            $res = mysqli_query($conn, $sql);
            while ($data = mysqli_fetch_assoc($res)) {
                $room_id = $data['id'];

            ?>
                <div class="card mb-4 border-0 shadow">
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="img/rooms/<?= $data['image'] ?>" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-5 px-lg-3 px-md-3 px-0">
                            <h5 class="mb-3"><?= $data['name'] ?></h5>
                            <div class="features mb-3">
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
                            <div class="facilities mb-3">
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
                            <div class="guests44 mb-3">
                                <h6>Guests : </h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <?= $data['adult(max)'] ?> Adults
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <?= $data['child(max)'] ?> Children
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
                        <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center mb-2">
                            <span class="badge rounded-pill bg-success text-white text-wrap mb-2" style="font-size: 13px;">
                                15% Off on Weekends
                            </span>
                            <h6 class="mb-2" style="text-decoration: line-through;">₹<?= $data['actual_price'] ?> per night</h6>
                            <span class="badge rounded text-dark text-wrap mb-2">
                                <h6>₹<?= $data['final_price'] ?> per night</h6>
                            </span>
                            <a href="booking.php?room_id=<?= $data['id'] ?>"
                                onclick="return checkLogin(event);"
                                class="btn btn-sm w-100 text-white custom-bg shadow-none mb-3">
                                Book now
                            </a>
                            <a href="more_details.php?id=<?= $data['id'] ?>" class="btn btn-sm w-100 btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
                <script>
                    function checkLogin(event) {
                        <?php if (!isset($_SESSION['user'])) { ?>
                            event.preventDefault();
                            alert("⚠ You must log in to book a room!");
                            window.location.href = "rooms.php";
                            return false;
                        <?php } ?>
                        return true;
                    }
                </script>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<?php
include_once('inc/footer.php');
?>