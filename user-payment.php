<?php
include_once('inc/header.php');

?>
<div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4 mt-5 bg-white">
        <form action="">
        <div class="container">
            <h2 class="text-center mt-5 p-3 h-font">Payment</h2>
            <label for="pay" class="form-label">Amount : </label>
            <input type="text" name="pay" id="pay" class="form-control mb-5" readonly>
        </div>
        <button class="btn btn-success text-center mb-4 w-100">Payment</button>
        </form>
    </div>
    <div class="col-lg-4"></div>
</div>
<?php
include_once('inc/footer.php');
?>