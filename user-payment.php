<?php
include_once('inc/header.php');

$price = 0;
$room_id = 0;
$booking_ready = false;
$error = "";
$discount_msg = "";

if (isset($_POST['pay_btn'])) {

    $room_id = $_POST['room_id'];
    $email = $_POST['email1'];
    $adults = $_POST['adults'];
    $child = $_POST['children'];
    $check_in = $_POST['checkin1'];
    $check_out = $_POST['checkout1'];
    $coupon_code = strtoupper(trim($_POST['coupon_code']));

    // 1. Check availability
    $booking_sql = "SELECT COUNT(*) AS total_booking FROM bookings WHERE room_id = $room_id AND check_out_date > '$check_in' AND check_in_date < '$check_out'";
    $booking_result = mysqli_fetch_assoc(mysqli_query($conn, $booking_sql));

    $room_sql = "SELECT actual_price, quantity_value FROM room_categories WHERE id = $room_id";
    $room_result = mysqli_fetch_assoc(mysqli_query($conn, $room_sql));

    if (($room_result['quantity_value'] - $booking_result['total_booking']) <= 0) {
        echo "<script>alert('Room not available for this check-in date.'); window.location.href = 'rooms.php';</script>";
        exit;
    }

    // 2. Calculate total nights
    $date1 = new DateTime($check_in);
    $date2 = new DateTime($check_out);
    $nights = $date1->diff($date2)->days;

    if ($nights <= 0) {
        $error = "Invalid date range.";
    } else {
        $original_price = $nights * $room_result['actual_price'];
        $final_price = $original_price;

        // 3. Apply coupon if any
        if (!empty($coupon_code)) {
            $today = date("Y-m-d");
            $coupon_sql = "SELECT * FROM discount 
                           WHERE coupon_code = '$coupon_code' 
                             AND room_id = '$room_id' 
                             AND status = 'active' 
                             AND '$today' BETWEEN start_date AND end_date  
                           LIMIT 1";
            $coupon_result = mysqli_query($conn, $coupon_sql);
            if (mysqli_num_rows($coupon_result) > 0) {
                $coupon = mysqli_fetch_assoc($coupon_result);
                $discount = $original_price * $coupon['discount_percentage'] / 100;
                $final_price -= $discount;
                $discount_msg = "Coupon applied! You saved ₹" . number_format($discount, 2);
            } else {
                $discount_msg = "Invalid or expired coupon!";
            }
        }

        $price = max(0, $final_price);
        $booking_ready = true;

        $_SESSION['booking'] = [
            'room_id' => $room_id,
            'coupon_code' => $coupon_code,
            'email' => $email,
            'adults' => $adults,
            'children' => $child,
            'checkin' => $check_in,
            'checkout' => $check_out,
            'total_price' => $price
        ];
    }
}

// Final Payment Submission
if (isset($_POST['payment'])) {
    if (isset($_SESSION['booking'])) {
        $data = $_SESSION['booking'];

        $sql = "SELECT r.id
                FROM rooms r
                WHERE r.room_id = '{$data['room_id']}'
                AND r.status_available = 1
                AND r.id NOT IN (
                    SELECT b.room_id
                    FROM bookings b
                    WHERE NOT (
                        b.check_out_date <= '{$data['checkin']}' OR
                        b.check_in_date >= '{$data['checkout']}'      
                    )
                )
                LIMIT 1
                ";

        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_assoc();
        $room_number_id = $row['id'];

        $user_sql = "SELECT id FROM register WHERE Email = '{$data['email']}'";
        $user_res = mysqli_query($conn, $user_sql);
        $user = mysqli_fetch_assoc($user_res);
        $user_id = $user['id'] ?? 0;

        if (!empty($data['coupon_code'])) {
            $discount_id_sql = "SELECT id FROM `discount` WHERE coupon_code = '{$data['coupon_code']}' LIMIT 1";
            $discount_res = mysqli_query($conn, $discount_id_sql);
            if ($discount_row = mysqli_fetch_assoc($discount_res)) {
                $coupon_id = $discount_row['id'];
            }

            $insert_booking = "INSERT INTO bookings (room_number_id ,room_id, user_id, applied_discount_id, adult, child, check_in_date, check_out_date, total_price)
                               VALUES ($room_number_id, '{$data['room_id']}', '$user_id', '$coupon_id', '{$data['adults']}', '{$data['children']}', '{$data['checkin']}', '{$data['checkout']}', '{$data['total_price']}')";
        } else {
            $insert_booking = "INSERT INTO bookings (room_number_id ,room_id, user_id, adult, child, check_in_date, check_out_date, total_price)
            VALUES ($room_number_id, '{$data['room_id']}', '$user_id', '{$data['adults']}', '{$data['children']}', '{$data['checkin']}', '{$data['checkout']}', '{$data['total_price']}')";
        }

        mysqli_query($conn, $insert_booking);

        $insert_payment = "INSERT INTO payment (room_id, amount) VALUES ('{$data['room_id']}', '{$data['total_price']}')";
        mysqli_query($conn, $insert_payment);

        unset($_SESSION['booking']); // Clear session

        echo "<script>alert('Payment successful! Your booking has been confirmed.'); window.location.href = 'rooms.php';</script>";
        exit;
    } else {
        echo "<script>alert('Booking session expired. Please book again.'); window.location.href = 'rooms.php';</script>";
        exit;
    }
}
?>

<div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4 mt-5 bg-white">
        <form action="user-payment.php" method="post">
            <div class="container">
                <h2 class="text-center mt-5 p-3 h-font">Payment</h2>
                <?php if ($booking_ready): ?>
                    <div id="discount-error" class="alert alert-info"><?= $discount_msg ?></div>
                    <label for="pay" class="form-label">Amount : </label>
                    <input type="text" name="price" id="pay" class="form-control mb-5" value="<?= $price ?>" readonly>
                    <button class="btn btn-success mb-4 w-100" name="payment">Confirm Payment</button>
                <?php elseif (!empty($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php else: ?>
                    <p class="text-center fw-bold">No booking data received.</p>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <div class="col-lg-4"></div>
</div>

<?php include_once('inc/footer.php'); ?>

<script>
    error = document.querySelector('#discount-error');
    if (error.innerText == "") {
        error.classList.add('d-none');
    }
</script>