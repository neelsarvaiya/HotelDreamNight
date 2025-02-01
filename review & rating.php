<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Review</title>
    <?php
    require('inc/header.php');
    require('inc/link.php');
    ?>
    <style>
        .review-form {
            background: #ffffff;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem auto;
            max-width: 500px;
        }

        .review-form h4 {
            color: #444;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .star-rating {
            display: flex;
            justify-content: space-around;
            max-width: 300px;
        }

        .star-rating label {
            font-size: 2.5rem;
            color: #ddd;
            transition: color 0.3s ease;
            cursor: pointer;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating input[type="radio"]:checked~label,
        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #ffcc00;
        }

        .form-control {
            border-radius: 10px;
        }

        .star-rating {
            display: flex;
            justify-content: space-around;
            max-width: 300px;
            direction: rtl;
            /* Reverses the order of stars */
        }

        .star-rating label {
            font-size: 2.5rem;
            color: #ddd;
            transition: color 0.3s ease;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div>
                        <img src="img/rooms/1.jpg" class="w-100" height="400px">
                    </div>
                </div>
            </div>
        </div>

        <form class="mt-4 p-4 border rounded bg-light">
            <h4>RATING</h4>
            <div class="star-rating my-4">
                <input type="radio" id="star1" name="rating" value="1">
                <label for="star1" title="1 star">★</label>
                <input type="radio" id="star2" name="rating" value="2">
                <label for="star2" title="2 stars">★</label>
                <input type="radio" id="star3" name="rating" value="3">
                <label for="star3" title="3 stars">★</label>
                <input type="radio" id="star4" name="rating" value="4">
                <label for="star4" title="4 stars">★</label>
                <input type="radio" id="star5" name="rating" value="5">
                <label for="star5" title="5 stars">★</label>
            </div>
            <div class="mb-3">
                <label for="review" class="form-label">Write Your Review</label>
                <textarea class="form-control" id="review" name="review" rows="4" placeholder="Share your experience..."></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit Review</button>
        </form>
    </div>

</body>

</html>
<?php
require('inc/footer.php');
?>