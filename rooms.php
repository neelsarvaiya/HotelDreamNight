<?php
include_once('inc/header.php');
?>
<style>
    .custom-bg {
        background-color: var(--teal);
        border: 1px solid var(--teal);
    }

    .slide-top {
        opacity: 0;
        transform: translateY(-100%);
        animation: slideTop 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
    }

    @keyframes slideTop {
        from {
            opacity: 0;
            transform: translateY(-300%);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center slide-top">Our Rooms</h2>
    <div class="h-line bg-dark"></div>
</div>

<script>
    $(document).ready(function() {
        function submitForm() {
            let formData = $("#bookingForm").serialize(); // Serialize form data

            $.ajax({
                type: "POST",
                url: "booking_field_validate.php", // Change this to your validation script
                data: formData,
                dataType: "json",
                success: function(response) {
                    $(".error").text("").hide(); // Clear previous errors

                    if (response.status === "error") {
                        if (response.errors.checkin1) {
                            $("#checkin1Error").text(response.errors.checkin1).show();
                        }
                        if (response.errors.checkout1) {
                            $("#checkout1Error").text(response.errors.checkout1).show();
                        }
                        if (response.errors.adults) {
                            $("#adultsError").text(response.errors.adults).show();
                        }
                        if (response.errors.children) {
                            $("#childrenError").text(response.errors.children).show();
                        }
                    } else if (response.status === "success") {
                        fetch_rooms();
                        document.querySelector('#reset').classList.remove('d-none');
                    }
                },
                error: function() {
                    alert("An error occurred while processing your request.");
                }
            });
        }

        // Trigger validation when a field loses focus
        $("#bookingForm input").on("blur change", function() {
            let allFilled = $("#checkin1").val() && $("#checkout1").val() && $("#adults").val() && $("#children").val();
            if (allFilled) {
                submitForm();
            }
        });
    });
</script>

<div class="container-fluid">
    <div class="row">

        <div class="col-lg-3 mb-lg-0 col-md-12 mb-4 ps-4">
            <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                <div class="container-fluid flex-lg-column align-items-stretch">
                    <h4 class="d-flex align-items-center justify-content-between mt-2 h-font fs-5">
                        <span>CHECK BOOKING AVAILABILITY :</span>
                        <button onclick="reset_form();" id="reset" class="btn btn-lg text-secondary shadow-none d-none">Reset</button>
                    </h4>
                    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                        data-bs-target="#filterDrowpdown" aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDrowpdown">
                        <form action="rooms.php" id="bookingForm" method="post">
                            <div class="border bg-light p-3 rounded mb-3">
                                <label for="checkin1" class="form-label">Check-in: </label>
                                <input type="date" id="checkin1" name="checkin1" onchange="chk_avail_filter();" class="form-control shadow-none mb-3" data-validation="required">
                                <div class="error" id="checkin1Error"></div>

                                <label for="checkout1" class="form-label">Check-Out: </label>
                                <input type="date" id="checkout1" name="checkout1" onchange="chk_avail_filter();" class="form-control shadow-none" data-validation="required">
                                <div class="error" id="checkout1Error"></div>
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3 h-font" style="font-size: 18px;">FACILITIES: </h5>
                                <div class="mb-2">
                                    <input type="checkbox" id="f1" name="facilities[]" data-validation="required terms" value="Facility 1" class="form-check-input shadow-none me-1">
                                    <label for="f1" class="form-check-label">Wifi</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="" name="facilities[]" value="Facility 2" class="form-check-input shadow-none me-1">
                                    <label for="f2" class="form-check-label">Room Heater</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="" name="facilities[]" value="Facility 3" class="form-check-input shadow-none me-1">
                                    <label for="f3" class="form-check-label">Air Conditioner</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="" name="facilities[]" value="Facility 3" class="form-check-input shadow-none me-1">
                                    <label for="f3" class="form-check-label">Spa</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="" name="facilities[]" value="Facility 3" class="form-check-input shadow-none me-1">
                                    <label for="f3" class="form-check-label">Television</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="" name="facilities[]" value="Facility 3" class="form-check-input shadow-none me-1">
                                    <label for="f3" class="form-check-label">Geyser</label>
                                </div>
                                <div class="error" id="facilities[]Error"></div>
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3 h-font" style="font-size: 18px;">GUESTS: </h5>
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
                            <!-- <button type="submit" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-3 fs-5">Check</button> -->
                        </form>
                    </div>
                </div>
            </nav>
        </div>

        <div class="col-lg-9 col-md-12 px-4" id="room-data"></div>

    </div>
</div>

<script>
    let room_data = document.querySelector('#room-data');
    let check_in = document.querySelector('#checkin1');
    let check_out = document.querySelector('#checkout1');

    function fetch_rooms() {

        let chk_avail = JSON.stringify({
            checkin: check_in.value,
            checkout: check_out.value
        });

        let xhr = new XMLHttpRequest();
        xhr.open("GET", "check_booking_availability.php?fetch_rooms&chk_avail=" + chk_avail, true);

        xhr.onprogress = function() {
            room_data.innerHTML = ` <div class="spinner-border text-info mb-3 d-block mx-auto" id="loader">
                <span class="visually-hidden">Loading...</span>
            </div>`;
        }

        xhr.onload = function() {
            room_data.innerHTML = this.responseText;
        }

        xhr.send();
    }

    fetch_rooms();
</script>

<?php
include_once('inc/footer.php');
?>


<script>
    function checkLogin(event) {
        <?php if (!isset($_SESSION['user'])) { ?>
            event.preventDefault();
            alert("⚠ You must log in to book a room!");
            window.location.href = "rooms.php";
            return false;
        <?php } ?>
        return true;
    }
</script>


<script>
    function reset_form() {
        document.querySelector('#checkin1').value = "";
        document.querySelector('#checkout1').value = "";
        document.querySelector('#adults').value = "";
        document.querySelector('#children').value = "";
        document.querySelector('#reset').classList.add('d-none');
        fetch_rooms();
    };
</script>