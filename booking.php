<?php
include_once('inc/header.php');
?>

<div class="container py-5">
    <div class="row g-4 align-items-center">
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="card shadow-sm">
                <img src="img/rooms/3.png" alt="Simple Room" class="card-img-top rounded p-3">
                <div class="card-body text-center">
                    <h5 class="card-title">Simple Room</h5>
                    <p class="card-text">₹2700 per night</p>
                </div>
            </div>
        </div>

        <div class=" col-xl-6 col-lg-6 col-md-12">
            <div class="card shadow-sm p-4">
                <form action="booking.php" method="post" id="book">
                    <div class="mb-3">
                        <label for="name1" class="form-label">Name</label>
                        <input type="text" id="name1" name="name1" class="form-control" data-validation="required alpha min" data-min="2">
                        <div class="error" id="name1Error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="phone1" class="form-label">Phone Number</label>
                        <input type="number" id="phone1" name="phone1" class="form-control" data-validation="required numeric min max" data-min="10" data-max="10">
                        <div class="error" id="phone1Error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="address1" class="form-label">Address</label>
                        <input type="text" id="address1" name="address1" class="form-control" data-validation="required min max" data-min="10" data-max="50">
                        <div class="error" id="address1Error"></div>
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
                    <button type="submit" class="btn btn-success custom-bg w-100" name="pay">Pay Now</button>
                </form>
                <?php
                if (isset($_POST['pay'])) {
                    echo "<script>
                                window.location.href = 'user-payment.php';
                             </script>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include_once("inc/footer.php");
?>