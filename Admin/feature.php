<?php
include_once('inc/admin-header.php');
?>
<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Feature
        <div>
            <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#feature">
                Add
            </button>
            <a href="#" class="btn btn-danger text-light"><i class="bi bi-trash"></i> Delete all</a>
        </div>
    </div>

    <div class="table-responsive-md table-responsive-sm" style="overflow-y: scroll; z-index: 1; height: 205px;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered">
                <thead class="sticky-top">
                    <tr>
                        <th scope="col" class="bg-dark text-white">#</th>
                        <th scope="col" class="bg-dark text-white">Name</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Bed Room</td>
                        <td><button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Kitchen</td>
                        <td><button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Balcony</td>
                        <td><button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>BathRooms</td>
                        <td><button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="feature" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    <i class="bi bi-person-circle fs-3 me-2"></i> Features
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="feature_form" method="post">
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="reponse" class="form-label fw-bold">Feature : </label>
                        <input type="text" name="feature" id="feature" data-validation="required alpha" class="form-control" placeholder="Enter Feature :">
                        <div class="error" id="featureError"></div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mb-2">
                        <button type="submit" class="btn btn-success shadow" name="login">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Facilities
        <div>
            <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#facilities">
                Add
            </button>
            <a href="#" class="btn btn-danger text-light"><i class="bi bi-trash"></i> Delete all</a>
        </div>
    </div>
    <div class="table-responsive-md table-responsive-sm" style="overflow-y: scroll; height: 228px;">
        <div class="container mt-3">
            <table class="table table-striped table-bordered">
                <thead class="sticky-top">
                    <tr>
                        <th scope="col" class="bg-dark text-white">#</th>
                        <th scope="col" class="bg-dark text-white">Icons</th>
                        <th scope="col" class="bg-dark text-white">Name</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><img src="img/facilities/wifi6.svg" width="40px"></td>
                        <td>Geyser</td>
                        <td><button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><img src="img/facilities/wifi2.svg" width="40px"></td>
                        <td>Room Heater</td>
                        <td><button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><img src="img/facilities/wifi5.svg" width="40px"></td>
                        <td>Television</td>
                        <td><button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><img src="img/facilities/wifi3.svg" width="40px"></td>
                        <td>Air Conditioner</td>
                        <td><button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><img src="img/facilities/wifi.svg" width="40px"></td>
                        <td>Wi-Fi</td>
                        <td><button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td><img src="img/facilities/wifi4.svg" width="40px"></td>
                        <td>Spa</td>
                        <td><button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="facilities" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center h-font">
                    <i class="bi bi-person-circle fs-3 me-2"></i> Facilities
                </h5>
                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="facilities_form" method="post">
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="facilities_image" class="form-label fw-bold">Choose Facilities icon : </label>
                        <input type="file" name="facilities_image" id="facilities_image" data-validation="required file" class="form-control mb-3">
                        <div class="error" id="facilities_imageError"></div>

                        <label for="reponse" class="form-label fw-bold">Facilities : </label>
                        <input type="text" name="facilities_name" data-validation="required alpha" id="facilities_name" class="form-control mb-3" placeholder="Enter Facilities :">
                        <div class="error" id="facilities_nameError"></div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mb-2">
                        <button type="submit" name="Pic_submit" class="btn btn-success shadow" name="login">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>