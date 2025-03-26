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
                    <p class="card-text"><?= $result['final_price'] ?></p>
                    <p><?= $result['description'] ?></p>
                </div>
            </div>
        </div>

        <div class=" col-xl-6 col-lg-6 col-md-12">
            <div class="card shadow-sm p-4">
                <form action="booking.php" method="post" id="book">
                    <div class="border p-3 rounded mb-3">
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
                <?php
                if (isset($_POST['pay'])) {
                    $room_id = $_POST['room_id'];
                    $adults = $_POST['adults'];
                    $child = $_POST['children'];
                    $check_in = $_POST['checkin'];
                    $check_out = $_POST['checkout'];

                    $select = "SELECT final_price FROM room_categories WHERE id = $room_id";
                    $data = mysqli_fetch_assoc(mysqli_query($conn,$select));
                    
                    // Step 2️⃣: Calculate Number of Nights
                    $date1 = new DateTime($check_in);
                    $date2 = new DateTime($check_out);
                    $nights = $date1->diff($date2)->days;
                    
                    // Step 3️⃣: Calculate Total Price
                    $total_price = $nights * $data['final_price'];
                    
                    // Step 4️⃣: Insert Booking into Database
                    $insert = "INSERT INTO `bookings`(`adult`, `chid`, `check_in_date`, `check_out_date`, `total_price`) VALUES ('$adults','$child','$check_in','$check_out','$total_price')";
                    mysqli_query($conn,$insert);
                    
                    // $booking_id = $conn->insert_id;

                    // // Step 5️⃣: Process Payment
                    // $transaction_id = uniqid("PAY_");
                    // $stmt = $conn->prepare("INSERT INTO payments (booking_id, payment_method, transaction_id, amount, payment_status) 
                    //         VALUES (?, ?, ?, ?, 'completed')");
                    // $stmt->bind_param("issd", $booking_id, $payment_method, $transaction_id, $total_price);
                    // $stmt->execute();

                    // echo "Booking successful! Total price: ₹" . number_format($total_price, 2);

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