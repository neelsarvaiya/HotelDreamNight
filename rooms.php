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
                    <h4 class="d-flex align-items-center justify-content-between mt-2 h-font fs-5">
                        <span>CHECK BOOKING AVAILABILITY :</span>
                    </h4>
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
                            <button type="submit" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-3 fs-5" name="filter_btn">Check</button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>

        <div class="col-lg-9 col-md-12 px-4" id="room-data">
            <?php
            if (isset($_POST['filter_btn'])) {
                $adult = $_POST['adults'];
                $child = $_POST['children'];
                $checkin = $_POST['checkin1'];
                $checkout = $_POST['checkout1'];

                if (!empty($adult && $child)) {
                    $select = "SELECT * FROM room_categories WHERE status = 'active' AND adult_max >= $adult AND child_max >= $child";
                }

                if (!empty($checkin && $checkout)) {
                    $select = $select . " AND id NOT IN (
                    SELECT room_id FROM bookings 
                    WHERE ('$checkin' BETWEEN check_in_date AND check_out_date) 
                    OR ('$checkout' BETWEEN check_in_date AND check_out_date) 
                    OR (check_in_date BETWEEN '$checkin' AND '$checkout'))";
                }
            } else {
                $select = "SELECT * FROM room_categories WHERE status = 'active'";
            }

            $res = mysqli_query($conn, $select);
            if (mysqli_num_rows($res) > 0) {

                while ($data = mysqli_fetch_assoc($res)) {
                    $room_id = $data['id'];

                    $login = 0;
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                        $login = 1;
                    }

                    $book = " <button 
                        onclick='checkLoginToBook($login,$room_id);'
                        class='btn btn-sm w-100 text-white custom-bg shadow-none mb-3'>
                        Book now
                    </button>";

                    $sql = "SELECT rf.name FROM room_features rf 
                JOIN room_features_mapping rfm ON rfm.room_feature_id = rf.id 
                WHERE rfm.room_id = $room_id AND rf.status = 'active'";
                    $features = mysqli_query($conn, $sql);

                    $features_html = "";
                    while ($feature = mysqli_fetch_assoc($features)) {
                        $features_html .= "<span class='badge rounded-pill bg-light text-dark text-wrap'>{$feature['name']}</span> ";
                    }

                    $sql = "SELECT rf.name FROM room_facilities rf 
                JOIN room_facilities_mapping rfm ON rfm.room_facility_id = rf.id 
                WHERE rfm.room_id = $room_id AND rf.status = 'active'";
                    $facilities = mysqli_query($conn, $sql);

                    $facilities_html = "";
                    while ($facility = mysqli_fetch_assoc($facilities)) {
                        $facilities_html .= "<span class='badge rounded-pill bg-light text-dark text-wrap'>{$facility['name']}</span> ";
                    }

                    echo "
                <div class='card mb-4 border-0 shadow'>
                <div class='row g-0 p-3 align-items-center'>
                <div class='col-md-5 mb-lg-0 mb-md-0 mb-3'>
                    <img src='img/rooms/{$data['image']}' class='img-fluid rounded-start' alt='Room Image'>
                </div>
                <div class='col-md-5 px-lg-3 px-md-3 px-0'>
                    <h5 class='mb-3'>{$data['name']}</h5>

                    <div class='features mb-3'>
                        <h6 class='mb-1'>Features:</h6>
                        {$features_html}
                    </div>

                    <div class='facilities mb-3'>
                        <h6>Facilities:</h6>
                        {$facilities_html}
                    </div>

                    <div class='guests44 mb-3'>
                        <h6>Guests:</h6>
                        <span class='badge rounded-pill bg-light text-dark text-wrap'>
                            {$data['adult_max']} Adults
                        </span>
                        <span class='badge rounded-pill bg-light text-dark text-wrap'>
                            {$data['child_max']} Children
                        </span>
                    </div>

                    <div class='rating mb-4'>
                        <h6>Rating</h6>
                        <span class='badge rounded-pill bg-light'>
                            <i class='bi bi-star-fill text-warning'></i>
                            <i class='bi bi-star-fill text-warning'></i>
                            <i class='bi bi-star-fill text-warning'></i>
                            <i class='bi bi-star text-warning'></i>
                            <i class='bi bi-star text-warning'></i>
                        </span>
                    </div>
                </div>

                <div class='col-md-2 mt-lg-0 mt-md-0 mt-4 text-center mb-2'>
                    <span class='badge rounded-pill bg-success text-white text-wrap mb-2' style='font-size: 13px;'>
                        15% Off on Weekends
                    </span>
                    <h6 class='mb-2' style='text-decoration: line-through;'>₹{$data['actual_price']} per night</h6>
                    <span class='badge rounded text-dark text-wrap mb-2'>
                        <h6>₹{$data['actual_price']}</h6>
                    </span>
                    $book
                    <a href='more_details.php?id={$data['id']}' class='btn btn-sm w-100 btn-outline-dark shadow-none'>More Details</a>
                </div>
            </div>
        </div>";
                }
            } else {
            ?>
                <div class="text-center mt-5">
                    <div class="mt-3 alert alert-danger">
                        <h3>No Rooms Found </h3>
                        <h2><i class="bi bi-emoji-frown text-danger"></i></h2>
                        <p class="lead">Please try again.</p>
                    </div>

                </div>
            <?php
            }
            ?>
        </div>

    </div>
</div>

<?php
include_once('inc/footer.php');
?>