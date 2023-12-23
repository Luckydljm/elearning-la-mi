<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h2>Instructor Accounts</h2>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="?page=dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Instructor Accounts</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Notifikasi Upload -->
    <?php
    if (isset($_SESSION['success'])) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> <?= $_SESSION['success']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        unset($_SESSION['success']);
    }
    ?>

    <?php
    if (isset($_SESSION['registered'])) {
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> <?= $_SESSION['registered']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        unset($_SESSION['registered']);
    }
    ?>

    <?php
    if (isset($_SESSION['flash'])) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> <?= $_SESSION['flash']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        unset($_SESSION['flash']);
    }
    ?>

    <?php
    if (isset($_SESSION['flash_fail'])) {
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> <?= $_SESSION['flash_fail']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        unset($_SESSION['flash_fail']);
    }
    ?>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">Instructor Table</div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col d-flex justify-content-start">
                        <button class="btn btn-primary modal-btn" data-bs-toggle="modal"
                            data-bs-target="#modalAddInstructor">Add Instructor</button>
                    </div>
                </div>
                <table class="table table-striped text-gray-900" id="instructorTable">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $show_instructors = $conn->prepare("SELECT * FROM `instructors`");
                        $show_instructors->execute();
                        if($show_instructors->rowCount() > 0){
                            while($fetch_instructors = $show_instructors->fetch(PDO::FETCH_ASSOC)){  
                        ?>
                        <tr>
                            <td><?= $fetch_instructors['first_name']; ?></td>
                            <td><?= $fetch_instructors['last_name']; ?></td>
                            <td><?= $fetch_instructors['email']; ?></td>
                            <td><img src="../uploaded_profile/<?=$fetch_instructors['photo']; ?>" alt="" width="40"
                                    class="avatar avatar-lg">
                            </td>
                            <td>
                                <button class="btn btn-danger modal-btn btn-delete-instructor" id="btnDeleteInstructor"
                                    data-bs-toggle="modal" data-bs-target="#modalDeleteInstructor"
                                    data-id="<?= $fetch_instructors['id_instructor']; ?>"
                                    data-email="<?= $fetch_instructors['email']; ?>"><i
                                        class="bi bi-trash-fill"></i></button>
                            </td>
                        </tr>
                        <?php
                            }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Basic Tables end -->
</div>
<!-- modals -->
<!-- add instructor -->
<div class=" modal text-gray-900" id="modalAddInstructor" tabindex="-1">
    <form action="../page/account/action_account.php" method="POST" class="modal-form" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Instructor</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input autocomplete="off" type="text" class="form-control" id="first_name" name="first_name"
                            aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input autocomplete="off" type="text" class="form-control" id="last_name" name="last_name"
                            aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input autocomplete="off" type="email" class="form-control" id="email" name="email"
                            aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input autocomplete="off" type="password" class="form-control" id="password" name="password"
                            aria-describedby="emailHelp" required>
                    </div>
                </div>
                <input class="id_instructor" type="hidden" name="id_instructor">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary modal-btn" name="submit_instructor">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- delete instructor -->
<div class="modal text-gray-900" id="modalDeleteInstructor" tabindex="-1">
    <form action="../page/account/action_account.php" method="POST" class="modal-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Instructor</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this account <b class="email"></b>?</p>

                </div>
                <input class="id_instructor" type="hidden" name="id_instructor">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger modal-btn" name="delete_instructor">Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>