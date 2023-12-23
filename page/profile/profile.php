<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h2>Profile</h2>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="?page=dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-start">
                <div class="mx-3 fs-5"><i class="icon dripicons dripicons-toggles"></i></div>
                <div class="fs-5">Manage Profile</div>
            </div>
        </div>

        <!-- Notifikasi Upload -->
        <?php
        if (isset($_SESSION['update'])) {
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> <?= $_SESSION['update']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            unset($_SESSION['update']);
        }
        ?>

        <?php
        if (isset($_SESSION['failed'])) {
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed!</strong> <?= $_SESSION['failed']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            unset($_SESSION['failed']);
        }
        ?>

        <?php
        if (isset($_SESSION['warning'])) {
        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> <?= $_SESSION['warning']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            unset($_SESSION['warning']);
        }
        ?>

        <div class="row ">
            <div class="col-xl-7">
                <div class="card">
                    <div class="card-header">Basic Info</div>
                    <div class="card-body">
                        <form action="../page/profile/action_profile.php" method="post" enctype="multipart/form-data"
                            data-parsley-validate>
                            <?php
                                $id = $_SESSION['id_instructor'] ?? '';
                                $select_instructors = $conn->prepare("SELECT * FROM `instructors` WHERE id_instructor = ?");
                                $select_instructors->execute([$id]);
                                if($select_instructors->rowCount() > 0){
                                    while($fetch_instructors = $select_instructors->fetch(PDO::FETCH_ASSOC)){
                                ?>
                            <div class="form-group">
                                <label for="first_name" class="form-text">First Name</label>
                                <input type="text" id="first_name" class="form-control" name="first_name"
                                    placeholder="<?= $fetch_instructors['first_name']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="form-text">Last Name</label>
                                <input type="text" id="last_name" class="form-control" name="last_name"
                                    placeholder="<?= $fetch_instructors['last_name']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-text">Email</label>
                                <input type="email" id="email" class="form-control" name="email"
                                    placeholder="<?= $fetch_instructors['email']; ?>" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="photo" class="form-text mb-2">Photo <small>(The Image Size Should Be Any
                                        Square Image)</small>
                                </label>
                                <div class="d-flex justify-content-between">
                                    <img src="../uploaded_profile/<?= $fetch_instructors['photo']; ?>" alt="photo"
                                        class="avatar avatar-lg" width="40" style="margin-right: 1rem;">
                                    <input type="file" name="photo" class="form-control" id="photo" accept="image/*">
                                </div>
                            </div>
                            <?php
                                    }
                                }
                                ?>
                            <div class="row justify-content-center">
                                <button type="submit" name="update_profile" class="btn btn-primary w-25">Update
                                    Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="card">
                    <div class="card-body">
                        <form action="../page/profile/action_profile.php" method="post" enctype="multipart/form-data"
                            data-parsley-validate>
                            <div class="form-group">
                                <label for="old_pass" class="form-text">Current Password</label>
                                <input type="password" id="old_pass" class="form-control" name="old_pass"
                                    data-parsley-required="true" />
                            </div>
                            <div class="form-group">
                                <label for="new_pass" class="form-text">New Password</label>
                                <input type="password" id="new_pass" class="form-control" name="new_pass"
                                    data-parsley-required="true" />
                            </div>
                            <div class="form-group">
                                <label for="cpass" class="form-text">Confirm New Password</label>
                                <input type="password" id="cpass" class="form-control" name="cpass"
                                    data-parsley-required="true" />
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" name="update_password" class="btn btn-primary w-50">Update
                                    Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>