<?php
include 'connection.php';

if (isset($_POST['add_discount'])) {
    $room_id = $_POST['room_id'];
    $offer_name = $_POST['offer_name'];
    $coupon_code = $_POST['coupon_code_add'];
    $discount = $_POST['discount'];
    $offer_start = $_POST['start'];
    $offer_end = $_POST['end'];

    $sql = "INSERT INTO `discount`(offer ,coupon_code ,room_id ,discount_percentage, start_date, end_date) 
                VALUES ('$offer_name','$coupon_code','$room_id', '$discount', '$offer_start', '$offer_end')";

    if (mysqli_query($conn, $sql)) {
        setcookie("success", "Add Successfull.", time() + 3, "/");
    } else {
        setcookie("error", "Not add successfull.", time() + 3, "/");
    }
?>
    <script>
        window.location.href = 'discount.php';
    </script>
<?php
    exit;
}
?>

<?php
if (isset($_GET['delete_id'])) {

    $delete = "DELETE FROM `discount` WHERE id = $_GET[delete_id]";
    if (mysqli_query($conn, $delete)) {
        setcookie("success", "Deleted Successfull.", time() + 3, "/");
    } else {
        setcookie("error", "Not Deleted successfull.", time() + 3, "/");
    }
?>
    <script>
        window.location.href = 'discount.php';
    </script>
<?php
    exit;
}
?>

<?php
if (isset($_POST['edt_discount'])) {
    $room = $_POST['room'];
    $discount_id = $_POST['discount_id'];
    $offer_name = $_POST['offer_name'];
    $coupon_code = $_POST['coupon_code'];
    $discount = $_POST['discount'];
    $offer_start = $_POST['start'];
    $offer_end = $_POST['end'];


    $update = "UPDATE `discount` SET `offer`='$offer_name',`coupon_code`='$coupon_code',`room_id`='$room',`discount_percentage`='$discount',`start_date`='$offer_start',`end_date`='$offer_end' WHERE id = $discount_id ";

    if (mysqli_query($conn, $update)) {
        setcookie("success", "updated Successfull.", time() + 3, "/");
    } else {
        setcookie("error", "Not updated successfull.", time() + 3, "/");
    }
?>
    <script>
        window.location.href = 'discount.php';
    </script>
<?php
    exit;
}
?>


<?php
include_once('inc/admin-header.php');
?>
<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Room Discounts
        <div>
            <button type="button" class="btn btn-success shadow-none" data-bs-toggle="modal" data-bs-target="#add_discount">
                <i class="bi bi-plus-lg"></i> Add
            </button>
        </div>
    </div>

    <div class="table-responsive-md table-responsive-sm" style="z-index: 1;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered text-center">
                <thead class="sticky-top">
                    <tr>
                        <th scope="col" class="bg-dark text-white">#</th>
                        <th scope="col" class="bg-dark text-white">Room</th>
                        <th scope="col" width="10%" class="bg-dark text-white">Offer</th>
                        <th scope="col" class="bg-dark text-white">coupon code</th>
                        <th scope="col" class="bg-dark text-white">Discount</th>
                        <th scope="col" class="bg-dark text-white">Price</th>
                        <th scope="col" class="bg-dark text-white">Discounted Price</th>
                        <th scope="col" class="bg-dark text-white">Start Date</th>
                        <th scope="col" class="bg-dark text-white">End Date</th>
                        <th scope="col" class="bg-dark text-white">Created at</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    $select = "SELECT 
                room_categories.name,
                room_categories.actual_price, 
                discount.offer, 
                discount.coupon_code,
                discount.id,
                discount.start_date, 
                discount.end_date,
                discount.discount_percentage,
                DATE(discount.created_at) AS created_date
                FROM discount 
                JOIN room_categories ON room_categories.id = discount.room_id;";
                    $result = mysqli_query($conn, $select);
                    $i = 1;

                    while ($data = mysqli_fetch_assoc($result)) {
                        $discount = $data['discount_percentage'];
                        $room_price = $data['actual_price'];

                        $final_price = ($room_price - ($room_price * $discount / 100));

                    ?>
                        <tr class=" text-center align-middle">
                            <td><?= $i ?></td>
                            <td><?= $data['name'] ?></td>
                            <td><?= $data['offer'] ?></td>
                            <td><?= $data['coupon_code'] ?></td>
                            <td><?= $data['discount_percentage'] ?></td>
                            <td><?= $data['actual_price'] ?></td>
                            <td><?= $final_price ?></td>
                            <td><?= $data['start_date'] ?></td>
                            <td><?= $data['end_date'] ?></td>
                            <td><?= $data['created_date'] ?></td>
                            <td>
                                <a href="?edt_id=<?= $data['id'] ?>" class="btn btn-warning shadow-none mt-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="?delete_id=<?= $data['id'] ?>" onclick="return confirm('Are you sure you want to delete this Offer ?');" class="btn btn-danger btn-md mx-1 mt-1"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="modal fade" id="add_discount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    <i class="bi bi-person-circle fs-3 me-2"></i> Room Discounts
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="discount.php" method="post">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="room" class="form-label fw-bold">Choose room : </label>
                        <select name="room_id" id="room_add" class="form-control">
                            <?php
                            $select = "SELECT * FROM `room_categories` WHERE status='active'";
                            $result = mysqli_query($conn, $select);
                            while ($data =  $result->fetch_assoc()) {
                            ?>
                                <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="offer_name">Offer Name : </label>
                        <input type="text" name="offer_name" id="offer_name_add" data-validation="required" class="form-control">
                        <div class="error" id="offer_nameError"></div>
                    </div>
                    <div class="mb-2">
                        <label for="offer_name">coupon code : </label>
                        <input type="text" name="coupon_code_add" id="coupon_code_add" data-validation="required" class="form-control">
                        <div class="error" id="coupon_code_addError"></div>
                    </div>
                    <div class="mb-2">
                        <label for="discount">Discount (in % ) : </label>
                        <input type="number" name="discount" id="discount_add" data-validation="required numeric min max" data-min="1" data-max="3" class="form-control">
                        <div class="error" id="discountError"></div>
                    </div>
                    <div class="mb-2">
                        <label for="discount">Offer Start : </label>
                        <input type="date" name="start" id="start_add" data-validation="required" class="form-control">
                        <div class="error" id="startError"></div>
                    </div>
                    <div class="mb-2">
                        <label for="discount">Offer End : </label>
                        <input type="date" name="end" id="end_add" data-validation="required" class="form-control">
                        <div class="error" id="endError"></div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mb-2">
                        <button type="submit" class="btn btn-primary shadow" name="add_discount">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>

<div class="modal fade" id="edt_discount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    <i class="bi bi-person-circle fs-3 me-2"></i> Room Discounts
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="discount.php" method="post">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="room" class="form-label fw-bold">Choose room : </label>
                        <select name="room" id="room" class="form-control">
                            <?php
                            $select = "SELECT * FROM `room_categories` WHERE status='active'";
                            $result = mysqli_query($conn, $select);
                            while ($data =  $result->fetch_assoc()) {
                            ?>
                                <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="offer_name">Offer Name : </label>
                        <input type="text" name="offer_name" id="offer_name" data-validation="required" class="form-control">
                        <div class="error" id="offer_nameError"></div>
                    </div>
                    <div class="mb-2">
                        <label for="offer_name">coupon code : </label>
                        <input type="text" name="coupon_code" id="coupon_code" data-validation="required" class="form-control">
                        <div class="error" id="coupon_codeError"></div>
                    </div>
                    <div class="mb-2">
                        <label for="discount">Discount (in % ) : </label>
                        <input type="number" name="discount" id="discount" data-validation="required numeric min max" data-min="1" data-max="3" class="form-control">
                        <div class="error" id="discountError"></div>
                    </div>
                    <div class="mb-2">
                        <label for="discount">Offer Start : </label>
                        <input type="date" name="start" id="start" data-validation="required" class="form-control">
                        <div class="error" id="startError"></div>
                    </div>
                    <div class="mb-2">
                        <label for="discount">Offer End : </label>
                        <input type="date" name="end" id="end" data-validation="required" class="form-control">
                        <div class="error" id="endError"></div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between">
                        <button type="submit" class="btn btn-primary shadow  mt-2" name="edt_discount">Submit</button>
                        <input type="hidden" name="discount_id" id="discount_id">
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>

</div>
</div>
</div>

<?php

if (isset($_GET['edt_id'])) {

    $sql = "SELECT * FROM `discount` WHERE id = $_GET[edt_id]";
    $fetch = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    echo "
    <script>
        var edt_discount  = new bootstrap.Modal(document.getElementById('edt_discount'), {
            keyboard: false
        })
         document.querySelector('#room').value = `$fetch[room_id]`;
         document.querySelector('#offer_name').value = `$fetch[offer]`;
         document.querySelector('#coupon_code').value = `$fetch[coupon_code]`;
         document.querySelector('#discount').value = `$fetch[discount_percentage]`;
         document.querySelector('#start').value = `$fetch[start_date]`;
         document.querySelector('#end').value = `$fetch[end_date]`;
         document.querySelector('#discount_id').value = `$fetch[id]`;
        edt_discount.show();
    </script>
";
}
?>