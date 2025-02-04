<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamNights Hotel | Discounts</title>
    <?php
    require('inc/admin-header.php');
    ?>
</head>

<body class="bg-light">

    <div class="card container mt-5 p-4 border-2 mb-4">
        <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Room Discounts
            <div>
                <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#discount">
                    Add
                </button>
                <a href="#" class="btn btn-danger text-light"><i class="bi bi-trash"></i> Delete all</a>
            </div>
        </div>

        <div class="table-responsive-md table-responsive-sm">
            <div class="container mt-3">
                <table class="table table-striped table-bordered text-center">
                    <thead class="sticky-top">
                        <tr>
                            <th scope="col" class="bg-dark text-white">#</th>
                            <th scope="col" class="bg-dark text-white">Room Name</th>
                            <th scope="col" class="bg-dark text-white">Offer Name</th>
                            <th scope="col" class="bg-dark text-white">Discount</th>
                            <th scope="col" class="bg-dark text-white">Price</th>
                            <th scope="col" class="bg-dark text-white">Discounted Price</th>
                            <th scope="col" class="bg-dark text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Simple Room</td>
                            <td> on Weekdays</td>
                            <td>10%</td>
                            <td>₹3000</td>
                            <td>₹2700</td>
                            <td>
                                <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#discount">
                                    Edit
                                </button>
                                <button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Deluxe Room</td>
                            <td>on Diwali Offer</td>
                            <td>15%</td>
                            <td>₹6000</td>
                            <td>₹5100</td>
                            <td>
                                <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#discount">
                                    Edit
                                </button>
                                <button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Luxury Room</td>
                            <td>for Long Stays (7+ nights)</td>
                            <td>20%</td>
                            <td>₹8000</td>
                            <td>₹6400</td>
                            <td>
                                <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#discount">
                                    Edit
                                </button>
                                <button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Supreme Deluxe Room</td>
                            <td>for Early Bookings (30+ days in advance)</td>
                            <td>25%</td>
                            <td>₹10000</td>
                            <td>₹7500</td>
                            <td>
                                <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#discount">
                                    Edit
                                </button>
                                <button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Supreme Deluxe Room</td>
                            <td>for Summer Vaction</td>
                            <td>35%</td>
                            <td>₹10000</td>
                            <td>₹7500</td>
                            <td>
                                <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#discount">
                                    Edit
                                </button>
                                <button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Supreme Deluxe Room</td>
                            <td>on Holly Offer</td>
                            <td>50%</td>
                            <td>₹10000</td>
                            <td>₹7500</td>
                            <td>
                                <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#discount">
                                    Edit
                                </button>
                                <button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="discount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center h-font">
                        <i class="bi bi-person-circle fs-3 me-2"></i> Room Discounts
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="discount_form" method="post">
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="room" class="form-label fw-bold">Choose room : </label>
                            <select name="room" id="room" class="form-control">
                                <option value="">Select Room : </option>
                                <option value="simple">Simple Room</option>
                                <option value="deluxe">Deluxe Room</option>
                                <option value="luxury">Luxury Room</option>
                                <option value="supreme">Supreme Deluxe Room</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="dis_name">Offer Name : </label>
                            <input type="text" name="dis_name" id="dis_name" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="dis">Discount (in % ) : </label>
                            <input type="number" name="dis" id="dis" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="price" class="form-lable">Price : </label>
                            <input type="text" name="price" id="price" placeholder="₹10000" class="form-control" readonly>
                        </div>
                        <div class="mb-2">
                            <label for="dis_price">Discounted Price : </label>
                            <input type="number" name="dis_price" id="dis_price" class="form-control">
                        </div>
                        <div class="d-flex align-items-end justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow" name="login">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function() {

        $("#discount_form").validate({
            rules: {
                dis_name: {
                    required: true,
                    maxlength: 50,
                },
                dis_price: {
                    required: true,
                    maxlength: 10,
                },
                room: {
                    required: true,
                },
                dis: {
                    required: true,
                },
            },
            messages: {
                dis_name: {
                    required: "Offer name is required.",
                    maxlength: "Maximum length is 50.",
                },
                dis_price: {
                    required: "Offer Price is required.",
                    maxlength: "Maximum length is 10.",
                },
                room: {
                    required: "Choose One Room",
                },
                dis: {
                    required: "Enter Discount (in %).",
                },
            }
        })
    });
</script>
<?php
include_once('inc/admin-footer.php');
?>