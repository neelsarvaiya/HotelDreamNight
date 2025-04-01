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
    $select = "SELECT bookings.adult,bookings.child,bookings.check_in_date,bookings.check_out_date,bookings.total_price,bookings.created_at, room_categories.id,room_categories.name,room_categories.actual_price, register.Full_Name,register.Email FROM bookings JOIN room_categories JOIN register ON bookings.user_id = register.id WHERE bookings.room_id = room_categories.id";

    $res = mysqli_query($conn, $select);

    while ($data = mysqli_fetch_assoc($res)) {
    ?>
        <div class="col-lg-6 p-5">
            <div class="card shadow-sm p-3">
                <div class="container text-center">
                    <h4 class="mt-2">Your Details :</h4>
                </div>
                <h6><strong>Name :</strong> <?= $data['Full_Name'] ?> </h6>
                <h6><strong>Email :</strong> <?= $data['Email'] ?> </h6>
                <div class="container text-center">
                    <h4 class="mt-2">Bokking Details :</h4>
                </div>
                <h5 class="fw-bold"><?= $data['name'] ?></h5>
                <p class="text-muted">₹<?= $data['actual_price'] ?> per night</p>
                <p><strong>Adults :</strong> <?= $data['adult'] ?> </p>
                <p><strong>Childreans :</strong> <?= $data['child'] ?> </p>
                <p><strong>Check in:</strong> <?= $data['check_in_date'] ?></p>
                <p><strong>Check out:</strong> <?= $data['check_out_date'] ?></p>
                <p><strong>Amount:</strong> ₹ <?= $data['total_price'] ?> </p>
                <p><strong>Date:</strong> <?= $data['created_at'] ?> </p>
                <div class="row">
                    <div class="col-lg-4">
                        <button class="btn btn-success">Download PDF</button>
                    </div>
                    <div class="col-lg-6 me-3">
                        <form action="review & rating.php" method="post">
                            <button type="submit" class="btn btn-primary" name="review">Review & Rating</button>
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                        </form>
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