<?php
include_once 'Admin/connection.php';
session_start();



if (isset($_GET['fetch_rooms'])) {

    $chk_avail = json_decode($_GET['chk_avail'],true);

    $room_count = 0;
    $output = "";

    $sql = "SELECT * FROM `room_categories` WHERE status='active'";
    $res = mysqli_query($conn, $sql);

    while ($data = mysqli_fetch_assoc($res)) {

        if($chk_avail['checkin'] != "" && $chk_avail['checkout'] != ""){
            
        }

        $room_id = $data['id'];

        $sql = "SELECT rf.name FROM `room_features` rf 
                JOIN `room_features_mapping` rfm ON rfm.room_feature_id = rf.id 
                WHERE rfm.room_id = $room_id AND rf.status = 'active'";
        $features = mysqli_query($conn, $sql);

        $features_html = "";
        while ($feature = mysqli_fetch_assoc($features)) {
            $features_html .= "<span class='badge rounded-pill bg-light text-dark text-wrap'>{$feature['name']}</span> ";
        }

        $sql = "SELECT rf.name FROM `room_facilities` rf 
                JOIN `room_facilities_mapping` rfm ON rfm.room_facility_id = rf.id 
                WHERE rfm.room_id = $room_id AND rf.status = 'active'";
        $facilities = mysqli_query($conn, $sql);

        $facilities_html = "";
        while ($facility = mysqli_fetch_assoc($facilities)) {
            $facilities_html .= "<span class='badge rounded-pill bg-light text-dark text-wrap'>{$facility['name']}</span> ";
        }

        $output .= "
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
                    <a href='booking.php?room_id={$data['id']}'
                        onclick='return checkLogin(event);'
                        class='btn btn-sm w-100 text-white custom-bg shadow-none mb-3'>
                        Book now
                    </a>
                    <a href='more_details.php?id={$data['id']}' class='btn btn-sm w-100 btn-outline-dark shadow-none'>More Details</a>
                </div>
            </div>
        </div>";

        $room_count++;
    }

    if ($room_count > 0) {
        echo $output;
    } else {
        echo "<h3 class='text-center text-danger'>No rooms found!</h3>";
    }
}

?>
