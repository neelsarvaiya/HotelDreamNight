<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | User-Query</title>
</head>

<body>

    <?php require('inc/admin-header.php'); ?>

    <div class="card container mt-5 p-4 border-2 mb-4">
        <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between">Reviews & Ratings
            <a href="#" class="btn btn-danger text-light"><i class="bi bi-trash"></i> Delete all</a>
        </div>

        <div class="table-responsive-md table-responsive-sm">
            <div class="container mt-3">
                <table class="table table-striped table-bordered text-center">
                    <thead class="sticky-top">
                        <tr>
                            <th scope="col" class="bg-dark text-white">#</th>
                            <th scope="col" class="bg-dark text-white">Room Name</th>
                            <th scope="col" class="bg-dark text-white">User Name</th>
                            <th scope="col" class="bg-dark text-white">Rating</th>
                            <th scope="col" width="40%" class="bg-dark text-white">Review</th>
                            <th scope="col" class="bg-dark text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Simple Room</td>
                            <td>neel</td>
                            <td>2</td>
                            <td>The room was clean, spacious, and well-equipped with all amenities. The staff was friendly, and the view from the balcony was amazing!</td>
                            <td>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Luxury Room</td>
                            <td>Kirit</td>
                            <td>3</td>
                            <td>The room was clean, spacious, and well-equipped with all amenities. The staff was friendly, and the view from the balcony was amazing!</td>
                            <td>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Supreme-deluxe Room</td>
                            <td>Meet</td>
                            <td>4</td>
                            <td>The room was clean, spacious, and well-equipped with all amenities. The staff was friendly, and the view from the balcony was amazing!</td>
                            <td>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>4</td>
                            <td>Deluxe Room</td>
                            <td>Rohit</td>
                            <td>5</td>
                            <td>The room was clean, spacious, and well-equipped with all amenities. The staff was friendly, and the view from the balcony was amazing!</td>
                            <td>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>    
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="response" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center h-font">
                        <i class="bi bi-person-circle fs-3 me-2"></i> User Response
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="user_query" method="post">
                    <div class="modal-body">
                        <div class="mb-4">
                            <label for="reponse" class="form-label fw-bold">Response : </label>
                            <textarea class="form-control shadow-none" id="messages" name="msg" rows="5"
                                style="resize: none" placeholder="Enter Your Text :"></textarea>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow" name="login">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <h6 class="text-center bg-dark text-white p-3 m-0 h-font">@Designed and Developed by DreamNights Hotel</h6>

</body>

</html>

<script>
    $(document).ready(function() {

        $("#user_query").validate({
            rules: {
                msg: {
                    required: true,
                    minlength: 10,
                    maxlength: 50,
                },
            },
            messages: {
                msg: {
                    required: "Message is required.",
                    minlength: "Minimum length is 10.",
                    maxlength: "Maximum length is 50.",
                }
            }
        })
    });
</script>