<?php
include_once('inc/admin-header.php');
?>

<div class="container mt-5">
    <h2 class="mb-4 h-font  ">Booking Analytics</h2>

    <div class="row">
        <!-- Total Bookings -->
        <?php
        $result =  mysqli_query($conn, "SELECT COUNT(*) AS total_room FROM room_categories");
        $data = mysqli_fetch_assoc($result);
        ?>
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="fa-solid fa-calendar-check"></i> Total Rooms</h5>
                    <h3><?= $data['total_room'] ?></h3>
                </div>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="col-md-3">
            <?php
            $result =  mysqli_query($conn, "SELECT COUNT(*) AS total_bookings FROM bookings");
            $data = mysqli_fetch_assoc($result);
            ?>
            <div class="card text-white bg-info mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-bookmark-fill"></i> Total Bookings</h5>
                    <h3><?= $data['total_bookings'] ?></h3>
                </div>
            </div>
        </div>

        <!-- Active Bookings -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-bookmark-check-fill"></i> Active Bookings</h5>
                    <h3>180</h3>
                </div>
            </div>
        </div>

        <!-- Pending Bookings -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="fa-solid fa-clock"></i> Pending Bookings</h5>
                    <h3>40</h3>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mb-4 h-font">Users Analytics</h2>

    <div class="row">
        <?php
        $result =  mysqli_query($conn, "SELECT COUNT(*) AS total_users FROM register");
        $data = mysqli_fetch_assoc($result);
        ?>
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-people-fill"></i> Total Users</h5>
                    <h3><?= $data['total_users'] ?></h3>
                </div>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="col-md-3">
            <?php
            $result =  mysqli_query($conn, "SELECT COUNT(*) AS active_users FROM register WHERE status = 'active'");
            $data = mysqli_fetch_assoc($result);
            ?>
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-person-check"></i> Active User</h5>
                    <h3><?= $data['active_users'] ?></h3>
                </div>
            </div>
        </div>

        <!-- Active Bookings -->
        <div class="col-md-3">
            <?php
            $result =  mysqli_query($conn, "SELECT COUNT(*) AS inactive_users FROM register WHERE status = 'inactive'");
            $data = mysqli_fetch_assoc($result);
            ?>
            <div class="card text-white bg-danger mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-person-x"></i> Inactive User</h5>
                    <h3><?= $data['inactive_users'] ?></h3>
                </div>
            </div>
        </div>

        <!-- Pending Bookings -->
        <div class="col-md-3">
            <?php
            $date = date('Y-m-d');
            $result =  mysqli_query($conn, "SELECT count(*) AS new_users FROM register WHERE date(created_at) = '$date'");
            $data = mysqli_fetch_assoc($result);
            ?>
            <div class="card text-white bg-warning mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-person-plus"></i> New Users Today</h5>
                    <h3><?= $data['new_users'] ?></h3>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mb-4 h-font  ">Queries & Reviews Analytics</h2>

    <div class="row">
        <!-- Total Bookings -->
        <div class="col-md-3">
            <?php
            $result =  mysqli_query($conn, "SELECT COUNT(review_text) AS total_review FROM review_and_rating");
            $data = mysqli_fetch_assoc($result);
            ?>
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-chat-left-text"></i> Reviews</h5>
                    <h3><?= $data['total_review'] ?></h3>
                </div>
            </div>
        </div>

        <!-- Active Bookings -->
        <div class="col-md-3">
            <?php
            $result =  mysqli_query($conn, "SELECT COUNT(rating) AS total_rating FROM review_and_rating");
            $data = mysqli_fetch_assoc($result);
            ?>
            <div class="card text-white bg-warning mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-star-fill"></i> Ratings</h5>
                    <h3><?= $data['total_rating'] ?></h3>
                </div>
            </div>
        </div>

        <?php
        $result =  mysqli_query($conn, "SELECT COUNT(*) AS total_query FROM user_query");
        $data = mysqli_fetch_assoc($result);
        ?>
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-patch-question-fill"></i> Total Queries</h5>
                    <h3><?= $data['total_query'] ?></h3>
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <?php
            $result =  mysqli_query($conn, "SELECT COUNT(*) AS resolved_query FROM user_query WHERE response = 1");
            $data = mysqli_fetch_assoc($result);
            ?>
            <div class="card text-white bg-info mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-patch-check-fill"></i> Resolved Queries</h5>
                    <h3><?= $data['resolved_query'] ?></h3>
                </div>
            </div>
        </div>
    </div>

</div>