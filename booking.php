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
                    <p class="card-text">₹300 per night</p>
                </div>
            </div>
        </div>

        <div class=" col-xl-6 col-lg-6 col-md-12">
            <div class="card shadow-sm p-4">
                <form action="booking.php" method="post" id="book">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" id="phone" name="phone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" id="address" name="address" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="checkin" class="form-label">Check-in</label>
                        <input type="date" id="checkin" name="checkin" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="checkout" class="form-label">Check-out</label>
                        <input type="date" id="checkout" name="checkout" class="form-control">
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

<script>
    $(document).ready(function() {

        $.validator.addMethod("nameValidation", function(value, element) {
            return this.optional(element) || /^[A-Za-z\s]+$/.test(value);
        }, "Name can only contain letters and spaces.");

        $.validator.addMethod("phoneValidation", function(value, element) {
            const phonepattern = /^(?:\d{10})$/;
            return this.optional(element) || phonepattern.test(value);
        }, "Please Enter a valid Indian phone number.");

        $("#book").validate({
            rules: {
                name: {
                    required: true,
                    nameValidation: true,
                    maxlength: 15,
                    minlength: 2
                },
                phone: {
                    required: true,
                    phoneValidation: true
                },
                address: {
                    required: true,
                    maxlength: 40
                },
                checkin: {
                    required: true,
                    date: true
                },
                checkout: {
                    required: true,
                    date: true
                },
            },
            messages: {

                name: {
                    required: "FullName is required",
                    pattern: "Name can only contain letters and spaces",
                    minlength: "Please atlest 2 Character"
                },
                phone: {
                    required: "Phone number is required",
                    pattern: "Please enter a valid Indian phone number",
                },
                address: {
                    required: "Address is required",
                    maxlength: "Maximum lenth of Address is 40 Characters "
                },
                checkin: {
                    required: "Please Enter Your Check-in date ",
                    date: "Please enter valid date"
                },
                checkout: {
                    required: "Please Enter Your Check-Out date ",
                    date: "Please enter valid date"
                },
            }
        })
    });
</script>