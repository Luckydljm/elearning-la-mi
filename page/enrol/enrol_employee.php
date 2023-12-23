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
                        <li class="breadcrumb-item active" aria-current="page">Enrol an Employee</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-start">
                <div class="mx-3 fs-5"><i class="icon dripicons dripicons-toggles"></i></div>
                <div class="fs-5">Enrol An Employee</div>
            </div>
        </div>

        <!-- Notifikasi Upload -->
        <?php
        if (isset($_SESSION['fail'])) {
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed!</strong> <?= $_SESSION['fail']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            unset($_SESSION['fail']);
        }
        ?>

        <div class="row justify-content-center">
            <div class="card w-50">
                <div class="card-header">Enrolment Form</div>
                <div class="card-body">
                    <form action="../page/enrol/action_enrol.php" method="post" enctype="multipart/form-data"
                        data-parsley-validate>
                        <div class="form-group mb-3">
                            <label for="id_users" class="form-text">User<span class="text-danger">*)</span></label>
                            <select id="id_users" class="form-select" aria-label="Default select example"
                                name="id_users" data-parsley-required="true">
                                <option selected disabled>Choose User</option>
                                <?php
                                $select_users = $conn->prepare("SELECT * FROM `users`");
                                $select_users->execute();
                                if($select_users->rowCount() > 0){
                                    while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <option value="<?= $fetch_users['id_users']; ?>"><?= $fetch_users['first_name']; ?>
                                    <?= $fetch_users['last_name']; ?> - <?= $fetch_users['position']; ?>
                                </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="id_course" class="form-text">Course To Enrol<span
                                    class="text-danger">*)</span></label>
                            <select id="id_course" class="form-select" aria-label="Default select example"
                                name="id_course" data-parsley-required="true">
                                <option selected disabled>Choose Course</option>
                                <?php
                                $select_course = $conn->prepare("SELECT * FROM `course`");
                                $select_course->execute();
                                if($select_course->rowCount() > 0){
                                    while($fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <option value="<?= $fetch_course['id_course']; ?>"><?= $fetch_course['title']; ?>
                                </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <input class="created_at" type="hidden" name="created_at" value="<?php echo date('Y-m-d')?>">
                        <button type="submit" name="enrol" class="btn btn-primary">Enrol Employee</button>
                    </form>
                </div>
            </div>
        </div>

    </section>
</div>