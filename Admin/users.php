<?php
include_once('inc/admin-header.php');
?>

<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between"> Users
        <a href="#" class="btn btn-danger text-light"><i class="bi bi-trash"></i> Delete all</a>
    </div>

    <div class="table-responsive table-responsive-md table-responsive-sm">
        <div class="container mt-3">
            <table class="table table-striped table-bordered text-center" style="min-width: 1400px;">
                <thead class="sticky-top">
                    <tr>
                        <th scope="col" class="bg-dark text-white">#</th>
                        <th scope="col" class="bg-dark text-white">Name</th>
                        <th scope="col" class="bg-dark text-white">Email</th>
                        <th scope="col" class="bg-dark text-white">Phone no.</th>
                        <th scope="col" class="bg-dark text-white">Address</th>
                        <th scope="col" class="bg-dark text-white">DOB</th>
                        <th scope="col" class="bg-dark text-white">varified</th>
                        <th scope="col" class="bg-dark text-white">Date</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>kirit</td>
                        <td>kirit@example.com</td>
                        <td>9067874546</td>
                        <td>Raiya road</td>
                        <td>10-3-2007</td>
                        <td><span class="badge bg-success"><i class="bi bi-check-lg"></i></span></td>
                        <td>11-5-2025</td>
                        <td>
                            <button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Neel</td>
                        <td>neel@example.com</td>
                        <td>9067874546</td>
                        <td>University road</td>
                        <td>7-11-2006</td>
                        <td><span class="badge bg-success"><i class="bi bi-check-lg"></i></span></td>
                        <td>11-10-2024</td>
                        <td>
                            <button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Meet</td>
                        <td>meett@example.com</td>
                        <td>9067874546</td>
                        <td>Kothariya road</td>
                        <td>10-5-2008</td>
                        <td><span class="badge bg-danger"><i class="bi bi-x-lg"></i></span></td>
                        <td>9-6-2024</td>
                        <td>
                            <button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Rohitt</td>
                        <td>rohit@example.com</td>
                        <td>9067874546</td>
                        <td>Nepal</td>
                        <td>1-7-2007</td>
                        <td><span class="badge bg-danger"><i class="bi bi-x-lg"></i></span></td>
                        <td>3-6-2023</td>
                        <td>
                            <button class="btn btn-danger btn-md mx-1"><i class="bi bi-trash"></i> Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php
include_once('inc/admin-footer.php');
?>