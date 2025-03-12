<?php
include_once('inc/admin-header.php');
?>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


<div class="card container mt-5 p-4 border-2 mb-4">
    <div class="card-header fs-3 fw-bold h-font d-flex align-items-center justify-content-between">Users
        <a href="#" class="btn btn-danger text-light"><i class="bi bi-trash"></i> Delete all</a>
    </div>

    <div class="table-responsive table-responsive-md table-responsive-sm" style="z-index: 1;">
        <div class="container mt-3">
            <table id="myTable" class="table table-striped table-bordered text-center" style="min-width: 1100px;">
                <thead class="sticky-top">
                    <tr>
                        <th scope="col" class="bg-dark text-white">#</th>
                        <th scope="col" class="bg-dark text-white">Name</th>
                        <th scope="col" class="bg-dark text-white">Email</th>
                        <th scope="col" class="bg-dark text-white">Phone no.</th>
                        <th scope="col" class="bg-dark text-white">Address</th>
                        <th scope="col" class="bg-dark text-white">DOB</th>
                        <th scope="col" class="bg-dark text-white">Role</th>
                        <th scope="col" class="bg-dark text-white">Status</th>
                        <th scope="col" class="bg-dark text-white">created_at</th>
                        <th scope="col" class="bg-dark text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select = "SELECT * FROM `register`";
                    $result = mysqli_query($conn, $select);
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr class="align-middle">
                            <td><?= $i ?></td>
                            <td><?= $row['Full_Name'] ?></td>
                            <td><?= $row['Email'] ?></td>
                            <td><?= $row['Phone_number'] ?></td>
                            <td><?= $row['Address'] ?></td>
                            <td><?= $row['DOB'] ?></td>
                            <td><?= $row['role'] ?></td>
                            <td class="align-middle"><button class="btn btn-<?= ($row['status'] === "active") ? 'success' : 'danger' ?> btn-md mx-1"><?= $row['status'] ?></button></td>
                            <td><?= $row['created_at'] ?></td>
                            <td>
                                <button type="button" class="btn btn-warning shadow-none mt-1" data-bs-toggle="modal" data-bs-target="#discount">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button class="btn btn-danger btn-md mx-1 mt-1"><i class="bi bi-trash"></i></button>
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
</div>
</div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "paging": true, // Enable pagination
            "searching": true, // Enable search
            "ordering": true, // Enable sorting
            "info": true // Show table info
        });
    });
</script>