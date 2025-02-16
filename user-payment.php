<?php
include_once('inc/header.php');
?>

<style>
    .custom-bg {
        background-color: var(--teal);
        border: 1px solid var(--teal);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header text-center bg-dark text-white">
                    <h4>Payment Details</h4>
                </div>
                <div class="card-body">
                    <form action="discount.php" method="post" id="payment">
                        <div class="mb-3">
                            <label for="cardName" class="form-label">Cardholder Name</label>
                            <input type="text" id="cardName" name="cardName" class="form-control" placeholder="Enter cardholder name">
                        </div>
                        <div class="mb-3">
                            <label for="cardNumber" class="form-label">Card Number</label>
                            <input type="number" id="cardNumber" name="cardNumber" class="form-control" placeholder="XXXX-XXXX-XXXX-XXXX">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="expiryDate" class="form-label">Expiry Date</label>
                                <input type="month" id="expiryDate" name="expiryDate" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="number" id="cvv" name="cvv" class="form-control" placeholder="XXX" maxlength="3">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="text" id="amount" name="amount" class="form-control" placeholder="₹2700" readonly>
                        </div>
                        <button type="submit" class="btn btn-success custom-bg w-100" name="payment">Pay Now</button>
                    </form>
                    <?php
                    if (isset($_POST['payment'])) {
                        echo "<script>
                                       alert('Pyment Successfull');
                                       window.location.href = 'index.php';
                                     </script>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $.validator.addMethod("nameValidation", function(value, element) {
            return this.optional(element) || /^[A-Za-z\s]+$/.test(value);
        }, "Name can only contain letters and spaces.");

        $("#payment").validate({
            rules: {
                cardName: {
                    required: true,
                    minlength: 3,
                    maxlength: 50,
                    nameValidation: true,
                },
                cardNumber: {
                    required: true,
                    minlength: 16,
                    maxlength: 16,
                    digits: true,
                },
                expiryDate: {
                    required: true,
                },
                cvv: {
                    required: true,
                    minlength: 3,
                    maxlength: 3,
                    digits: true,
                }
            },
            messages: {
                cardName: {
                    required: "Please enter the cardholder's name.",
                    minlength: "Name must be at least 3 characters.",
                    maxlength: "Name cannot exceed 50 characters.",
                    pattern: "Name must only contain letters and spaces.",
                },
                cardNumber: {
                    required: "Please enter the card number.",
                    minlength: "Card number must be exactly 16 digits.",
                    maxlength: "Card number must be exactly 16 digits.",
                    digits: "Card number must contain only numbers.",
                },
                expiryDate: {
                    required: "Please select the card's expiry date.",
                },
                cvv: {
                    required: "Please enter the CVV.",
                    minlength: "CVV must be exactly 3 digits.",
                    maxlength: "CVV must be exactly 3 digits.",
                    digits: "CVV must contain only numbers.",
                }
            },
            errorPlacement: function(error, element) {
                error.addClass("text-danger");
                error.insertAfter(element);
            },
            highlight: function(element) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function(element) {
                $(element).removeClass("is-invalid");
            }
        });
    });
</script>

<?php
include_once('inc/footer.php');
?>