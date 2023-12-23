<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h2>Employee</h2>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="?page=dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Employee</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="d-flex justify-content-between">
                <div class="card-header d-flex justify-content-start">
                    <div class="mx-3 fs-5"><i class="bi bi-people-fill"></i></div>
                    <div class="fs-5">Employee</div>
                </div>
                <?php
	                if ($_SESSION['user_type']=="admin"){
	            ?>
                <div class="card-header">
                    <a href="?page=add_course" class="btn btn-outline-primary rounded-5 modal-btn"
                        data-bs-toggle="modal" data-bs-target="#modalAddUser"><i class="bi bi-plus-lg"></i>
                        Add Employee</a>
                </div>
                <?php } ?>
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

        <div class="card">
            <div class="card-header">Employee Table</div>
            <div class="card-body">
                <table class="table table-striped text-gray-900" id="userTable">
                    <thead>
                        <tr style="font-size: 0.9rem;">
                            <th>#</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Enrolled Courses</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=0;
                        $show_users = $conn->prepare("SELECT * FROM `users`");
                        $show_users->execute();
                        if($show_users->rowCount() > 0){
                            while($fetch_users = $show_users->fetch(PDO::FETCH_ASSOC)){  
                                $users_id = $fetch_users['id_users'];
                                $photo = $fetch_users['photo'];
                                $no++;
                        ?>
                        <tr style="font-size: 0.9rem;">
                            <td><?= $no; ?></td>
                            <td>
                                <?php  
                                if(!empty($photo)){
                                ?>
                                <img src="../uploaded_profile/<?= $fetch_users['photo']; ?>" alt="Avatar" class="avatar"
                                    width="40" />
                                <?php }else{ ?>
                                <img src="../public/assets/images/faces/9.png" alt="Avatar" width="40" />
                                <?php
                                    }
                                ?>
                            </td>
                            <td><?= $fetch_users['first_name']; ?> <?= $fetch_users['last_name']; ?>
                            </td>
                            <td><?= $fetch_users['email']; ?></td>
                            <td><?= $fetch_users['position']; ?></td>
                            <td>
                                <?php
                            $show_enrol = $conn->prepare("SELECT * FROM `enrol`, `course` WHERE enrol.id_course = course.id_course && id_users = ?");
                            $show_enrol->execute([$users_id]);
                            if($show_enrol->rowCount() > 0){
                                while($fetch_enrol = $show_enrol->fetch(PDO::FETCH_ASSOC)){  
                            ?>
                                <ul>
                                    <li><?= $fetch_enrol['title']; ?></li>
                                </ul>
                                <?php
                                }
                                }
                            ?>
                            </td>
                            <td>
                                <button class="btn btn-outline-danger modal-btn btn-delete-user" id="btnDeleteUser"
                                    data-bs-toggle="modal" data-bs-target="#modalDeleteUser"
                                    data-id="<?= $fetch_users['id_users']; ?>"
                                    data-email="<?= $fetch_users['email']; ?>"><i class="bi bi-trash-fill"></i></button>
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
</div>

<!-- Modal -->
<!-- add user -->
<div class=" modal text-gray-900" id="modalAddUser" tabindex="-1">
    <form action="../page/account/action_account.php" method="POST" class="modal-form" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
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
                        <label for="position" class="form-label">Position</label>
                        <input autocomplete="off" type="text" class="form-control" id="position" name="position"
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
                <input class="id_users" type="hidden" name="id_users">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary modal-btn" name="submit_user">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- delete user -->
<div class="modal text-gray-900" id="modalDeleteUser" tabindex="-1">
    <form action="../page/account/action_account.php" method="POST" class="modal-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this account <b class="email"></b>?</p>

                </div>
                <input class="id_users" type="hidden" name="id_users">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger modal-btn" name="delete_user">Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>