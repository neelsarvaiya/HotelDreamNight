<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamNights Hotel | About Us</title>
    <?php
    require('inc/link.php');
    ?>
    <style>
        .box {
            border-top-color: var(--teal);
        }
        .pop {
            transition: all ease 0.5s;
        }

        .pop:hover {
            border-top-color: var(--teal) !important;
            transform: scaleX(0.9) scaleY(1.1);
        }
    </style>
</head>

<body class="bg-light">

    <?php
    require('inc/header.php');
    ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">ABOUT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Dream Night Hotel, we pride ourselves on offering a seamless blend of luxury, and personalized service. Situated in a prime location, our hotel features elegant rooms, state-of-the-art amenities, and a welcoming atmosphere designed for both business and leisure travelers. With our dedicated team, we strive to provide an exceptional experience, ensuring your every need is met.
        </p>
    </div>

    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-6 mb-4 me-md-5 order-lg-1 order-md-1 order-sm-2">
                <h3 class="mb-3 h-font">James Turner</h3>
                <p>
                    James Turner is a highly dedicated and accomplished hospitality professional with over two decades of experience in the industry. As the General Manager of DreamNights Hotel, he oversees daily operations with a commitment to delivering excellence in guest services. Known for his attention to detail and visionary leadership, James ensures every visitor enjoys a seamless and luxurious stay.
                    His expertise lies in building strong teams, improving operational efficiencies, and creating a guest-centric environment. James has a proven track record of exceeding customer expectations and fostering long-term relationships with clients and partners.
                </p>
            </div>
            <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-sm-1">
                <img src="img/about/about.jpg" class="w-100">
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 px-4 mb-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box pop">
                    <img src="img/about/hotel.svg" width="70px">
                    <h4 class="mt-3 h-font">100+ ROOMS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 px-4 mb-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box pop">
                    <img src="img/about/customers.svg" width="70px">
                    <h4 class="mt-3 h-font">200+ CUSTOMERS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 px-4 mb-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box pop">
                    <img src="img/about/rating.svg" width="70px">
                    <h4 class="mt-3 h-font">150+ REVIEWS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 px-4 mb-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box pop">
                    <img src="img/about/staff.svg" width="70px">
                    <h4 class="mt-3 h-font">200+ STAFFS</h4>
                </div>
            </div>
        </div>
    </div>

    <h3 class="my-5 fw-bold h-font text-center">MANAGEMENT TEAM
        <div class="h-line bg-dark mt-2"></div>
    </h3>

    <div class="container px-4">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <img src="img/about/team1.webp" class="w-100 rounded-3 img-fluid">
                <h5 class="mt-2 text-center">Ethan Miller</h5>
            </div>
            <div class="col-lg-3 col-md-6">
                <img src="img/about/team2.webp" class="w-100">
                <h5 class="mt-2 text-center">Daniel Wilson</h5>
            </div>
            <div class="col-lg-3 col-md-6">
                <img src="img/about/team3.webp" class="w-100">
                <h5 class="mt-2 text-center">Alexander Brown</h5>
            </div>
            <div class="col-lg-3 col-md-6">
                <img src="img/about/team4.webp" class="w-100">
                <h5 class="mt-2 text-center">Mia Anderson</h5>
            </div>
        </div>
    </div>

    <?php
    require('inc/footer.php');
    ?>

</body>

</html>