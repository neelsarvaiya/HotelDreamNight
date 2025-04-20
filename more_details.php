<?php

include_once('inc/header.php');


if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $sql = "SELECT * FROM `room_categories` WHERE `id` = $id";
    $data = mysqli_fetch_assoc(mysqli_query($conn, $sql));

?>
    <style>
        .custom-bg {
            background-color: var(--teal);
            border: 1px solid var(--teal);
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-12 my-5 mb-4 px-4">
                <h2 class="fw-bold"><?= $data['name'] ?></h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">Home</a>
                    <span class="text-secondary"> > </span>
                    <a href="rooms.php" class="text-secondary text-decoration-none">Rooms</a>
                </div>
            </div>

            <div class="col-lg-7 col-md-12 px-4 mb-md-4 mb-sm-4">
                <img src="img/rooms/<?= $data['image'] ?>" class="img-fluid rounded-start" alt="...">
            </div>

            <div class="col-lg-5 col-md-12 px-4">
                <div class="card mb-4 border-0 shadow rounded-3">
                    <div class="card-body">
                        <h4>₹<?= $data['actual_price'] ?> per night</h4>
                        <div class="rating mb-3">
                            <h6>Rating</h6>
                            <?php
                                $rating_sql = "SELECT AVG(rating) AS avg_rating FROM review_and_rating WHERE room_id = $_GET[id]";
                                $rating_result = mysqli_query($conn, $rating_sql);
                                $rating_row = mysqli_fetch_assoc($rating_result);
                                $avg_rating = round($rating_row['avg_rating'], 1);
                                
                                $stars_html = '';
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= floor($avg_rating)) {
                                        $stars_html .= '<i class="bi bi-star-fill text-warning"></i>';
                                    } elseif ($i - $avg_rating <= 0.5) {
                                        $stars_html .= '<i class="bi bi-star-half text-warning"></i>';
                                    } else {
                                        $stars_html .= '<i class="bi bi-star text-warning"></i>';
                                    }
                                }
                            ?>
                            <span class="badge rounded-pill bg-light">
                               <?= $stars_html ?>
                            </span>
                        </div>
                        <div class="features mb-3">
                            <h6 class="mb-1">Features : </h6>
                            <?php
                            $room_id = $data['id'];

                            // To check user logged-in or not
                            $login = 0;
                            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                                $login = 1;
                            }

                            $book_btn = "<button onclick='checkLoginToBook($login,$room_id)'
                                            class='btn btn-sm w-100 mb-2 text-white custom-bg shadow-none'>
                                             Book now
                                        </button>";

                            $sql = "SELECT rf.name FROM `room_features` rf JOIN `room_features_mapping` rfm ON rfm.room_feature_id = rf.id WHERE rfm.room_id = $room_id";
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
                            $sql = "SELECT rf.name FROM `room_facilities` rf JOIN `room_facilities_mapping` rfm ON rfm.room_facility_id = rf.id WHERE rfm.room_id = $room_id";
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
                                <?= $data['adult_max'] ?> Adults
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                <?= $data['child_max'] ?> Children
                            </span>
                        </div>
                        <span class="badge rounded-pill bg-success text-white text-wrap mb-2" style="font-size: 13px;line-height:15px;">
                            15% Off on Weekends
                        </span>
                        <h6 class="mb-2">₹<?= $data['actual_price'] ?> per night</h6>
                        <?= $book_btn  ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <h5 class="fw-bold">Description</h5>
                <p><?= $data['description'] ?></p>
            </div>

            <div class="col-lg-12">
                <h5 class="fw-bold">Reviews & Ratings</h5>
                <div class="row">
                    <?php
                    $res = mysqli_query($conn, "SELECT r.Profile_pic,r.Full_Name,rr.review_text,rr.rating FROM review_and_rating rr JOIN register r ON rr.user_id = r.id WHERE rr.room_id = $_GET[id] ORDER BY rr.id DESC");

                    while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <div class="profile d-flex align-items-center mb-3 mt-3">
                            <img src="img/userProfile/<?= $row['Profile_pic'] ?>" width="40px" height="auto" class="rounded-circle">
                            <h6 class="m-0 ms-2"><?= $row['Full_Name'] ?></h6>
                        </div>
                        <p>
                            <?= $row['review_text'] ?>
                        </p>
                        <div class="rating">
                            <?php  
                            for($i = 1; $i <= 5; $i++){
                                if( $i <= $row['rating']){
                                  echo '<i class="bi bi-star-fill text-warning"></i>';
                                }else{
                                  echo '<i class="bi bi-star text-warning"></i>';  
                                }
                            }
                            ?>                            
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>
<?php
}

include_once('inc/footer.php');

?>