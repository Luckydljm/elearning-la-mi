<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h2>Enrol History</h2>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="?page=dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Enrol History</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-start">
                <div class="mx-3 fs-5"><i class="icon dripicons dripicons-toggles"></i></div>
                <div class="fs-5">Enrol History</div>
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

        <div class="row mt-4">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3 header-title">Enrol Histories</h5>
                        <table class="table table-striped text-gray-900" id="enrolTable">
                            <thead>
                                <tr style="font-size: 0.9rem;">
                                    <th>Photo</th>
                                    <th>User Name</th>
                                    <th>Enrolled Course</th>
                                    <th>Enrolment Date</th>
                                    <?php
                                    if ($_SESSION['user_type']=="admin"){
                                    ?>
                                    <th>Action</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <!-- For Instruktur -->
                            <?php
                            if ($_SESSION['user_type']=="instruktur"){
                            ?>
                            <tbody>
                                <?php
                                $id = $_SESSION['id_instructor'] ?? '';
                                $show_enrol = $conn->prepare("SELECT * FROM `enrol`, `users`, `course` WHERE enrol.id_users = users.id_users && enrol.id_course = course.id_course && id_instructor = ?");
                                $show_enrol->execute([$id]);
                                if($show_enrol->rowCount() > 0){
                                    while($fetch_enrol = $show_enrol->fetch(PDO::FETCH_ASSOC)){  
                                        $photo = $fetch_enrol['photo'];
                                ?>
                                <tr style="font-size: 0.9rem;">
                                    <td>
                                        <?php  
                                        if(!empty($photo)){
                                        ?>
                                        <img src="../uploaded_profile/<?= $fetch_enrol['photo']; ?>" alt="Avatar"
                                            class="avatar" width="40" />
                                        <?php }else{ ?>
                                        <img src="../public/assets/images/faces/9.png" alt="Avatar" width="40" />
                                        <?php
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <b><?= $fetch_enrol['first_name']; ?> <?= $fetch_enrol['last_name']; ?></b><br>
                                        <small>Email:<?= $fetch_enrol['email']; ?></small>
                                    </td>
                                    <td><strong><a href="?page=update_course&get_id=<?= $fetch_enrol['id_course']; ?>"
                                                target="_blank"><?= $fetch_enrol['title']; ?></a></strong>
                                    </td>
                                    <td><?= $fetch_enrol['date_added']; ?></td>
                                </tr>
                                <?php
                                    }
                                    }
                                ?>
                            </tbody>
                            <?php } else{ ?>
                            <tbody>
                                <?php
                                $show_enrol = $conn->prepare("SELECT * FROM `enrol`, `users`, `course` WHERE enrol.id_users = users.id_users && enrol.id_course = course.id_course");
                                $show_enrol->execute();
                                if($show_enrol->rowCount() > 0){
                                    while($fetch_enrol = $show_enrol->fetch(PDO::FETCH_ASSOC)){  
                                        $photo = $fetch_enrol['photo'];
                                ?>
                                <tr style="font-size: 0.9rem;">
                                    <td>
                                        <?php  
                                        if(!empty($photo)){
                                        ?>
                                        <img src="../uploaded_profile/<?= $fetch_enrol['photo']; ?>" alt="Avatar"
                                            class="avatar" width="40" />
                                        <?php }else{ ?>
                                        <img src="../public/assets/images/faces/9.png" alt="Avatar" width="40" />
                                        <?php
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <b><?= $fetch_enrol['first_name']; ?> <?= $fetch_enrol['last_name']; ?></b><br>
                                        <small>Email:<?= $fetch_enrol['email']; ?></small>
                                    </td>
                                    <td><strong><a href="?page=update_course&get_id=<?= $fetch_enrol['id_course']; ?>"
                                                target="_blank"><?= $fetch_enrol['title']; ?></a></strong>
                                    </td>
                                    <td><?= $fetch_enrol['created_at']; ?></td>
                                    <?php
                                    if ($_SESSION['user_type']=="admin"){
                                    ?>
                                    <td>
                                        <button class="btn btn-outline-danger modal-btn btn-delete-enrol"
                                            id="btnDeleteEnrol" data-bs-toggle="modal"
                                            data-bs-target="#modalDeleteEnrol"
                                            data-id="<?= $fetch_enrol['id_enrol']; ?>"
                                            data-title="<?= $fetch_enrol['title']; ?>"
                                            data-first_name="<?= $fetch_enrol['first_name']; ?>"
                                            data-last_name="<?= $fetch_enrol['last_name']; ?>"><i
                                                class="bi bi-trash-fill"></i></button>
                                    </td>
                                    <?php } ?>
                                </tr>
                                <?php
                                    }
                                    }
                                ?>
                            </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<!-- Modal -->
<!-- delete enrol -->
<div class="modal text-gray-900" id="modalDeleteEnrol" tabindex="-1">
    <form action="../page/enrol/action_enrol.php" method="POST" class="modal-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Enrol</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <b class="first_name"></b> <b class="last_name"></b> from <b
                            class="title"></b> course?</p>

                </div>
                <input class="id_enrol" type="hidden" name="id_enrol">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger modal-btn" name="delete">Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>