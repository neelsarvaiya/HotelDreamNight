<?php
include_once('inc/admin-header.php');
?>
<!-- 
<div class="row mt-5 mb-4 mx-5">
    <h3 class="mb-4 h-font">Booking Analytics</h3>
    <div class="col-md-3 mb-4">
        <div class="card text-center p-3 shadow">
        <h6 class="text-primary fw-bold fs-5"></i><i class="bi bi-bookmark-fill"></i> Total Bookings</h6>
            <h1 class="text-primary">5</h1>
            <h3 class="text-primary">₹15000</h3>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-center p-3 shadow">
            <h6 class="text-success fw-bold fs-5"><i class="bi bi-bookmark-check-fill"></i> Active Bookings</h6>
            <h1 class="text-success">3</h1>
            <h3 class="text-success">₹12000</h3>
        </div>
    </div>
</div>

<div class="row mt-3 mb-4 mx-5">
    <h3 class="mb-4 h-font">Queries & Reviews Analytics</h3>
    <div class="col-md-3 mb-4">
        <div class="card text-center p-3 shadow">
            <h6 class="text-info fw-bold fs-5">Queries</h6>
            <h1 class="text-info">3</h1>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-center p-3 shadow">
            <h6 class="text-success fw-bold fs-5">Reviews</h6>
            <h1 class="text-success">3</h1>
        </div>
    </div>
</div>

<div class="row mt-3 mb-4 mx-5">
    <h3 class="mb-4 h-font">Users</h3>
    <div class="col-md-3 mb-4">
        <div class="card text-center p-3 shadow">
            <h6 class="text-primary fw-bold fs-5">Total</h6>
            <h1 class="text-primary">5</h1>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-center p-3 shadow">
            <h6 class="text-success fw-bold fs-5">Verified</h6>
            <h1 class="text-success">2</h1>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-center p-3 shadow">
            <h6 class="text-danger fw-bold fs-5">Unverified</h6>
            <h1 class="text-danger">3</h1>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-center p-3 shadow">
            <h6 class="text-success fw-bold fs-5">Active</h6>
            <h1 class="text-success">2</h1>
        </div>
    </div>
</div>
</div>
</div>
</div> -->




<div class="container mt-5">
    <h2 class="mb-4 h-font  ">Booking Analytics</h2>

    <div class="row">
        <!-- Total Bookings -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="fa-solid fa-calendar-check"></i> Total Rooms</h5>
                    <h3>250</h3>
                </div>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-bookmark-fill"></i> Total Bookings</h5>
                    <h3>250</h3>
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

    <h2 class="mb-4 h-font  ">Queries & Reviews Analytics</h2>

    <div class="row">
        <!-- Total Bookings -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-patch-question-fill"></i> Queries</h5>
                    <h3>50</h3>
                </div>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-chat-left-text"></i> Reviews</h5>
                    <h3>350</h3>
                </div>
            </div>
        </div>

        <!-- Active Bookings -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-star-fill"></i> Ratings</h5>
                    <h3>210</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-info mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-patch-check-fill"></i> Resolved Queries</h5>
                    <h3>20</h3>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mb-4 h-font">Users Analytics</h2>

    <div class="row">
        <!-- Total Bookings -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-people-fill"></i> Total Users</h5>
                    <h3>200</h3>
                </div>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-person-check"></i> Active User</h5>
                    <h3>130</h3>
                </div>
            </div>
        </div>

        <!-- Active Bookings -->
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-person-x"></i> Inactive User</h5>
                    <h3>70</h3>
                </div>
            </div>
        </div>

        <!-- Pending Bookings -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-person-plus"></i> New Users Today</h5>
                    <h3>40</h3>
                </div>
            </div>
        </div>
    </div>

</div>