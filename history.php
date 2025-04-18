<?php
include_once('inc/header.php');
$user_email = $_SESSION['user'];
?>

<style>
    .booking-card {
        transition: transform 0.3s;
        border-radius: 10px;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .booking-card:hover {
        transform: translateY(-5px);
    }

    .room-type {
        font-weight: 600;
        color: #2c3e50;
    }

    .price {
        font-weight: 700;
        color: rgb(0, 0, 0);
    }

    .status-badge {
        position: absolute;
        top: 15px;
        right: 15px;
    }

    .nav-pills .nav-link.active {
        background-color: #2c3e50;
    }

    .nav-pills .nav-link {
        color: #2c3e50;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="col-12 my-5 mb-4 px-4">
    <h2 class="fw-bold">Booking History</h2>
    <div style="font-size: 14px;">
        <a href="index.php" class="text-secondary text-decoration-none">Home</a>
        <span class="text-secondary"> > </span>
        <a href="history.php" class="text-secondary text-decoration-none">Booking</a>
    </div>
</div>

<div class="row container mx-auto mb-5">
    <?php
    $select = "SELECT 
    r.room_number, 
    b.id as booking_id,
    b.adult, 
    b.child, 
    b.check_in_date, 
    b.check_out_date, 
    b.total_price, 
    date(b.created_at) as c_date, 
    rc.id,
    rc.name, 
    rc.actual_price, 
    re.Email 
FROM bookings b
JOIN register re ON b.user_id = re.id
JOIN rooms r ON b.room_number_id = r.id
JOIN room_categories rc ON r.room_id = rc.id
WHERE re.Email = '$user_email'
ORDER BY b.id DESC
";

    $res = mysqli_query($conn, $select);

    while ($data = mysqli_fetch_assoc($res)) {
    ?>
        <div class="col-md-6">
            <div class="card booking-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title room-type"><?= $data['name'] ?></h5>
                        <div class="price">₹<?= $data['actual_price'] ?> per night</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="text-muted small">Guests</div>
                            <div><i class="fas fa-user me-2"></i> <?= $data['adult'] ?> Adults</div>
                            <div><i class="fas fa-child me-2"></i> <?= $data['child'] ?> Child</div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">Room No.</div>
                            <div><i class="fas fa-door-open me-2"></i><?= $data['room_number'] ?></div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="text-muted small">Check-in</div>
                            <div><i class="fas fa-calendar-check me-2"></i><?= $data['check_in_date'] ?></div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">Check-out</div>
                            <div><i class="fas fa-calendar-times me-2"></i> <?= $data['check_out_date'] ?></div>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small">Booking Date</div>
                            <div><?= $data['c_date'] ?></div>
                        </div>
                        <div class="text-end">
                            <div class="text-muted small">Total Amount</div>
                            <h5 class="mb-0">₹<?= $data['total_price'] ?></h5>
                        </div>
                    </div>

                    <div class="gap-2 d-flex mt-3">
                        <a href="downloadPDF.php?r_id=<?= $data['booking_id'] ?>&u_email=<?= $user_email ?>" class="btn btn-primary"><i class="fas fa-download"></i> Download PDF</a>
                        <?php
                        $get_user_id = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM register WHERE Email = '$user_email'"));
                        $user_id = $get_user_id['id'];
                        $room_id = $data['id'];

                        // Check if this user has already given a review for this room
                        $check_review_sql = "SELECT * FROM review_and_rating WHERE user_id = $user_id AND room_id = $room_id";
                        $check_review = mysqli_query($conn, $check_review_sql);

                        // If no review yet, show button
                        if (mysqli_num_rows($check_review) === 0) {
                        ?>
                            <div class="col-lg-6 me-3">
                                <form action="review & rating.php" method="post">
                                    <button class="btn btn-outline-success me-md-2" name="review"><i class="fas fa-star me-1"></i> Rate & Review</button>
                                    <input type="hidden" name="id" value="<?= $room_id ?>">
                                </form>
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
    ?>

</div>

<?php
include_once('inc/footer.php');
?>