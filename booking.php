<?php
include_once('inc/header.php');

if (isset($_GET['room_id'])) {
    $room_id = $_GET['room_id'];

    $select = "SELECT * FROM `room_categories` WHERE `id` = '$room_id'";
    $result = mysqli_fetch_array(mysqli_query($conn, $select));
    $adult_child_max = "SELECT adult_max AS adult, child_max AS child FROM room_categories WHERE id = $room_id";
    $number = mysqli_query($conn, $adult_child_max);
    $data = mysqli_fetch_assoc($number);
}
?>

<div class="container py-5">
    <div class="row g-4 align-items-center">
        <!-- Room Image & Info -->
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="card shadow-sm">
                <img src="img/rooms/<?= $result['image'] ?>" alt="Room" class="card-img-top rounded p-3">
                <div class="card-body text-center">
                    <h5 class="card-title"><?= $result['name'] ?></h5>
                    <h6 class="card-text">Price: ₹<?= $result['actual_price'] ?> / night</h6>
                </div>
            </div>
        </div>

        <!-- Booking Form -->
        <div class="col-xl-6 col-lg-6 col-md-12">
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
                                <select name="adults" id="" class="form-select me-5  shadow-none">
                                    <?php
                                    for ($i = 1; $i <= $data['adult']; $i++) {
                                    ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="children" class="form-label ms-5">Children</label>
                                <select name="children" id="" class="form-select ms-5 shadow-none">
                                    <?php
                                    for ($i = 1; $i <= $data['child']; $i++) {
                                    ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="checkin" class="form-label">Check-in</label>
                        <input type="date" id="checkin1" name="checkin1" class="form-control" data-validation="required">
                        <div class="error" id="checkin1Error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="checkout" class="form-label">Check-out</label>
                        <input type="date" id="checkout1" name="checkout1" class="form-control" data-validation="required">
                        <div class="error" id="checkout1Error"></div>
                    </div>

                    <!-- Coupon Code Input -->
                    <div class="mb-3">
                        <label for="coupon_code" class="form-label">Coupon Code (if any)</label>
                        <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="Enter coupon code">
                    </div>

                    <input type="hidden" value="<?= $result['id'] ?>" name="room_id">

                    <button type="submit" class="btn btn-success w-100" name="pay_btn">Proceed to Payment</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once("inc/footer.php"); ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let checkinInput = document.getElementById("checkin1");
        let checkoutInput = document.getElementById("checkout1");

        // Set the minimum date for check-in (today)
        let today = new Date().toISOString().split("T")[0];
        checkinInput.setAttribute("min", today);

        // Prevent selecting past dates for check-in
        checkinInput.addEventListener("change", function() {
            let checkinDate = checkinInput.value;

            if (checkinDate) {
                // Set the check-out min date as the selected check-in date
                checkoutInput.setAttribute("min", checkinDate);
            } else {
                checkoutInput.removeAttribute("min");
            }
        });

        // Prevent selecting past dates for check-out
        checkoutInput.addEventListener("change", function() {
            let checkinDate = checkinInput.value;
            let checkoutDate = checkoutInput.value;

            if (checkoutDate < checkinDate) {
                alert("Check-out date cannot be before check-in date.");
                checkoutInput.value = "";
            }
        });
    });
</script>