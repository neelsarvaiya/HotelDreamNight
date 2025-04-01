<?php
include_once('inc/header.php');

if (isset($_GET['room_id'])) {
    $room_id = $_GET['room_id'];

    $select = "SELECT * FROM `room_categories` WHERE `id` = '$room_id'";
    $result = mysqli_fetch_array(mysqli_query($conn, $select));
}
?>

<div class="container py-5">
    <div class="row g-4 align-items-center">
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="card shadow-sm">
                <img src="img/rooms/<?= $result['image'] ?>" alt="Simple Room" class="card-img-top rounded p-3">
                <div class="card-body text-center">
                    <h5 class="card-title"><?= $result['name'] ?></h5>
                    <!-- <p class="card-text"><?= $result['final_price'] ?></p> -->
                </div>
            </div>
        </div>

        <div class=" col-xl-6 col-lg-6 col-md-12">
            <div class="card shadow-sm p-4">
                <form action="user-payment.php" method="post" id="book">
                    <div class="border p-3 rounded mb-3">
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" id="email1" name="email1" class="form-control" data-validation="required email">
                            <div class="error" id="email1Error"></div>
                        </div>
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
                    <div class="mb-3">
                        <label for="checkin" class="form-label">Check-in</label>
                        <input type="date" id="checkin" name="checkin" class="form-control" data-validation="required">
                        <div class="error" id="checkinError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="checkout" class="form-label">Check-out</label>
                        <input type="date" id="checkout" name="checkout" class="form-control" data-validation="required">
                        <div class="error" id="checkoutError"></div>
                    </div>
                    <input type="hidden" value="<?= $result['id'] ?>" name="room_id">
                    <button type="submit" class="btn btn-success custom-bg w-100" name="pay">Pay Now</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once("inc/footer.php");
?>
