<?php
include_once('inc/header.php');
?>

<div class="col-12 my-5 mb-4 px-4">
    <h2 class="fw-bold">Booking History</h2>
    <div style="font-size: 14px;">
        <a href="index.php" class="text-secondary text-decoration-none">Home</a>
        <span class="text-secondary"> > </span>
        <a href="history.php" class="text-secondary text-decoration-none">Booking</a>
    </div>
</div>

<div class="row container">
    <?php
    $select = "SELECT 
    r.room_number, 
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
WHERE r.status_available = 'active';
";

    $res = mysqli_query($conn, $select);

    while ($data = mysqli_fetch_assoc($res)) {
    ?>
        <div class="col-lg-6 p-5">
            <div class="card shadow-sm p-3">
                <div class="container text-center">
                    <h4 class="mt-2">Booking Details :</h4>
                </div>
                <h5 class="fw-bold"><?= $data['name'] ?></h5>
                <p class="text-muted">₹<?= $data['actual_price'] ?> per night</p>
                <p><strong>Adults :</strong> <?= $data['adult'] ?> </p>
                <p><strong>Childreans :</strong> <?= $data['child'] ?> </p>
                <p><strong>Room number :</strong> <?= $data['room_number'] ?> </p>
                <p><strong>Check in:</strong> <?= $data['check_in_date'] ?></p>
                <p><strong>Check out:</strong> <?= $data['check_out_date'] ?></p>
                <p><strong>Total amount:</strong> ₹<?= $data['total_price'] ?> </p>
                <p><strong>Booking date:</strong> <?= $data['c_date'] ?> </p>
                <div class="row">
                    <div class="col-lg-4">
                        <button class="btn btn-success">Download PDF</button>
                    </div>
                    <?php
                    $user_email = $data['Email'];
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
                                <button type="submit" class="btn btn-primary shadow-none" name="review">Review & Rating</button>
                                <input type="hidden" name="id" value="<?= $room_id ?>">
                            </form>
                        </div>
                    <?php
                    }
                    ?>
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