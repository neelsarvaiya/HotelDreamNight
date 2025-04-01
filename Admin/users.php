<?php
include_once('inc/admin-header.php');
?>

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
    <div class="card-header fs-3 fw-bold h-font">
        Users
    </div>


    <div class="table-responsive table-responsive-md table-responsive-sm" style="z-index: 1;">
        <div class="container mt-3">
            <table id="user" class="table table-striped table-bordered text-center" style="min-width: 1100px;">
                <thead class="sticky-top">
                    <tr>
                        <th scope="col" class="bg-dark text-white">#</th>
                        <th scope="col" class="bg-dark text-white">Name</th>
                        <th scope="col" class="bg-dark text-white">Profile Image</th>
                        <th scope="col" class="bg-dark text-white">Email</th>
                        <th scope="col" class="bg-dark text-white">Phone no.</th>
                        <th scope="col" class="bg-dark text-white">Address</th>
                        <th scope="col" class="bg-dark text-white">DOB</th>
                        <th scope="col" class="bg-dark text-white">state</th>
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
                            <td><img src="../img/userProfile/<?= $row['Profile_pic'] ?>" style="width: 40px; height: 40px; border-radius: 50px;"></td>
                            <td><?= $row['Email'] ?></td>
                            <td><?= $row['Phone_number'] ?></td>
                            <td><?= $row['Address'] ?></td>
                            <td><?= $row['DOB'] ?></td>
                            <td><?= $row['state'] ?></td>
                            <td><?= $row['role'] ?></td>
                            <td class="align-middle"><button class="btn btn-<?= ($row['status'] === "active") ? 'success' : 'danger' ?> btn-md mx-1"><?= $row['status'] ?></button></td>
                            <td><?= $row['created_at'] ?></td>
                            <td>
                                <a href="?user_edit=<?= $row['id'] ?>" class="btn btn-warning shadow-none"><i class="bi bi-pencil-square"></i></a>
                                <a href="usersCRUD.php?id=<?= $row['id']; ?>"><button onclick="return confirm('Are you sure you want to delete this user?');" class="btn btn-danger btn-md mx-1 mt-1"><i class="bi bi-trash"></i></button></a>
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
        $('#user').DataTable({
            "paging": true, // Enable pagination
            "searching": true, // Enable search
            "ordering": true, // Enable sorting
            "info": true // Show table info
        });
    });
</script>

<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="userModalLabel">User Details</h5>
                <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="usersCRUD.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-6 mb-3  ">
                                <label for="img" class="form-label">User Profile</label> <br>
                                <img src="" id="profile" style="width: 150px; height: 150px; border-radius: 80px;">
                                <input type="file" class="form-control mt-2" id="profile" data-validation="file filesize" name="profile">
                                <div class="error" id="profileError"></div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" data-validation="required alpha" name="name">
                            <div class="error" id="nameError"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" data-validation="required email" name="email">
                            <div class="error" id="emailError"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone No.</label>
                            <input type="text" class="form-control" id="phone" name="phone" data-validation="required numeric">
                            <div class="error" id="phoneError"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="1" data-validation="required"></textarea>
                            <div class="error" id="addressError"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="dob" class="form-label">Date of Birth (DOB)</label>
                            <input type="date" class="form-control" id="dob" name="dob" data-validation="required">
                            <div class="error" id="dobError"></div> 
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="state" class="form-label">state</label>
                            <input type="text" class="form-control" id="state" name="state" data-validation="required">
                            <div class="error" id="stateError"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" class="form-control" id="role" name="role" data-validation="required">
                            <div class="error" id="roleError"></div>
                        </div>
                        <input type="hidden" name="user_id" id="user_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="save_btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

if (isset($_GET['user_edit'])) {

    $sql = "SELECT * FROM `register` WHERE id = $_GET[user_edit]";
    $fetch = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    echo "
    <script>
        var edit_user  = new bootstrap.Modal(document.getElementById('userModal'), {
            keyboard: false
        })
        document.querySelector('#profile').src = `../img/userProfile/$fetch[Profile_pic]`;
        document.querySelector('#name').value = `$fetch[Full_Name]`;
        document.querySelector('#email').value = `$fetch[Email]`;
        document.querySelector('#phone').value = `$fetch[Phone_number]`;
        document.querySelector('#address').value = `$fetch[Address]`;
        document.querySelector('#dob').value = `$fetch[DOB]`;
        document.querySelector('#state').value = `$fetch[state]`;
        document.querySelector('#role').value = `$fetch[role]`;
        document.querySelector('#user_id').value = `$fetch[id]`;
        edit_user.show();
    </script>
";
}
?>