<?php
include_once('inc/header.php');
?>

<style>
    .pop {
        transition: all ease 0.5s;
    }

    .pop:hover {
        border-top-color: var(--teal) !important;
        transform: scale(1.1);
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
    <h2 class="fw-bold h-font text-center slide-top">OUR FACILITIES</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
        At Dream Night Hotel, we offer world-class facilities to ensure a comfortable and enjoyable stay. Experience elegant rooms, airport transfers, exceptional dining options, a fully-equipped gym, relaxing spa, rooftop pool, free high-speed Wi-Fi, Swimming Pool meeting rooms.
    </p>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                <div class="d-flex align-iteams-center mb-2 ">
                    <img src="img/facilities/wifi.svg" width="40px">
                    <h5 class="m-0 ms-3"><b>Wifi</b></h5>
                </div>
                <p>At Dream Night Hotel, we understand the importance of staying connected. Our high-speed Wi-Fi service is available throughout the hotel, streaming, and communication. </p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                <div class="d-flex align-iteams-center mb-2 ">
                    <img src="img/facilities/wifi2.svg" width="40px">
                    <h5 class="m-0 ms-3"><b>Room Heater</b></h5>
                </div>
                <p>At Dream Night Hotel, we prioritize your comfort. Our rooms are equipped with modern room heaters to ensure a cozy and warm environment, especially during colder months. </p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                <div class="d-flex align-iteams-center mb-2 ">
                    <img src="img/facilities/wifi3.svg" width="40px">
                    <h5 class="m-0 ms-3"><b>Air Conditioner</b></h5>
                </div>
                <p>At Dream Night Hotel, every room is equipped Each room at Dream Night Hotel is equipped with a televisionwith modern air conditioning to ensure a cool and comfortable stay. </p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                <div class="d-flex align-iteams-center mb-2 ">
                    <img src="img/facilities/wifi4.svg" width="40px">
                    <h5 class="m-0 ms-3"><b>Spa</b></h5>
                </div>
                <p>Indulge in relaxation and rejuvenation at Dream Night Hotel's luxurious spa. Our professional therapists offer a range of soothing treatments and spirit Each room at Dream Night Hotel. </p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                <div class="d-flex align-iteams-center mb-2 ">
                    <img src="img/facilities/wifi5.svg" width="40px">
                    <h5 class="m-0 ms-3"><b>Television</b></h5>
                </div>
                <p>Each room at Dream Night Hotel is equipped with a high-definition television, Each room at Dream Night Hotel is equipped with a high-definition televisionoffering a wide range.</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                <div class="d-flex align-iteams-center mb-2 ">
                    <img src="img/facilities/wifi6.svg" width="40px">
                    <h5 class="m-0 ms-3"><b> Geyser</b></h5>
                </div>
                <p>Every room at Dream Night Hotel features a modern geyser,Each room at Dream Night Hotel with high-definition television providing you with hot water whenever you need it. </p>
            </div>
        </div>
    </div>
</div>

<?php
include_once('inc/footer.php');
?>