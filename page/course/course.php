<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h2>Courses</h2>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="?page=dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Courses</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="d-flex justify-content-between">
                <div class="card-header d-flex justify-content-start">
                    <div class="mx-3 fs-5"><i class="bi bi-archive-fill"></i></div>
                    <div class="fs-5">Courses</div>
                </div>
                <?php
	                if ($_SESSION['user_type']=="instruktur"){
	            ?>
                <div class="card-header">
                    <a href="?page=add_course" class="btn btn-outline-primary rounded-5"><i class="bi bi-plus-lg"></i>
                        Add New Course</a>
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

        <?php
        if (isset($_SESSION['img_size'])) {
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed!</strong> <?= $_SESSION['img_size']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            unset($_SESSION['img_size']);
        }
        ?>

        <!-- Info Data Course for Admin -->
        <?php
            if ($_SESSION['user_type']=="admin"|| $_SESSION['user_type']=="direktur"){
        ?>
        <div class="card-group text-center">
            <div class="card border">
                <div class="card-body">
                    <i class="icon dripicons dripicons-link text-muted" style="font-size: 20px;"></i>
                    <?php
                       $select_course_active = $conn->prepare("SELECT * FROM `course`WHERE status = 'active' ");
                       $select_course_active->execute();
                       $total_course_active =  $select_course_active->rowCount();
                    ?>
                    <h5 class="card-title"><?= $total_course_active; ?></h5>
                    <p class="card-text"><small class="text-body-secondary">Active Courses</small></p>
                </div>
            </div>
            <div class="card border">
                <div class="card-body">
                    <i class="icon dripicons dripicons-link-broken text-muted" style="font-size: 20px;"></i>
                    <?php
                       $select_course_pending = $conn->prepare("SELECT * FROM `course`WHERE status = 'pending' ");
                       $select_course_pending->execute();
                       $total_course_pending =  $select_course_pending->rowCount();
                    ?>
                    <h5 class="card-title"><?= $total_course_pending; ?></h5>
                    <p class="card-text"><small class="text-body-secondary">Pending Courses</small></p>
                </div>
            </div>
            <div class="card border">
                <div class="card-body">
                    <i class="icon dripicons dripicons-clock text-muted" style="font-size: 20px;"></i>
                    <?php
                       $select_course_pending_approval = $conn->prepare("SELECT * FROM `course`WHERE approval = 'pending approval' ");
                       $select_course_pending_approval->execute();
                       $total_course_pending_approval =  $select_course_pending_approval->rowCount();
                    ?>
                    <h5 class="card-title"><?= $total_course_pending_approval; ?></h5>
                    <p class="card-text"><small class="text-body-secondary">Pending Approval</small></p>
                </div>
            </div>
            <div class="card border">
                <div class="card-body">
                    <i class="icon dripicons dripicons-thumbs-up text-muted" style="font-size: 20px;"></i>
                    <?php
                       $select_course_approved = $conn->prepare("SELECT * FROM `course`WHERE approval = 'approved' ");
                       $select_course_approved->execute();
                       $total_course_approved =  $select_course_approved->rowCount();
                    ?>
                    <h5 class="card-title"><?= $total_course_approved; ?></h5>
                    <p class="card-text"><small class="text-body-secondary">Approved</small></p>
                </div>
            </div>
            <div class="card border">
                <div class="card-body">
                    <i class="icon dripicons dripicons-thumbs-down text-muted" style="font-size: 20px;"></i>
                    <?php
                       $select_course_not_approved = $conn->prepare("SELECT * FROM `course`WHERE approval = 'not approved' ");
                       $select_course_not_approved->execute();
                       $total_course_not_approved =  $select_course_not_approved->rowCount();
                    ?>
                    <h5 class="card-title"><?= $total_course_not_approved; ?></h5>
                    <p class="card-text"><small class="text-body-secondary">Not Approved</small></p>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- End of Info Data Course Admin-->

        <!-- Info Data Course for Instruktur -->
        <?php
            if ($_SESSION['user_type']=="instruktur"){
        ?>
        <div class="card-group text-center">
            <div class="card border">
                <div class="card-body">
                    <i class="icon dripicons dripicons-link text-muted" style="font-size: 20px;"></i>
                    <?php
                       $id = $_SESSION['id_instructor'] ?? '';
                       $select_course_active = $conn->prepare("SELECT * FROM `course`WHERE status = 'active' && id_instructor = ? ");
                       $select_course_active->execute([$id]);
                       $total_course_active =  $select_course_active->rowCount();
                    ?>
                    <h5 class="card-title"><?= $total_course_active; ?></h5>
                    <p class="card-text"><small class="text-body-secondary">Active Courses</small></p>
                </div>
            </div>
            <div class="card border">
                <div class="card-body">
                    <i class="icon dripicons dripicons-link-broken text-muted" style="font-size: 20px;"></i>
                    <?php
                       $id = $_SESSION['id_instructor'] ?? '';
                       $select_course_pending = $conn->prepare("SELECT * FROM `course`WHERE status = 'pending' && id_instructor = ? ");
                       $select_course_pending->execute([$id]);
                       $total_course_pending =  $select_course_pending->rowCount();
                    ?>
                    <h5 class="card-title"><?= $total_course_pending; ?></h5>
                    <p class="card-text"><small class="text-body-secondary">Pending Courses</small></p>
                </div>
            </div>
            <div class="card border">
                <div class="card-body">
                    <i class="icon dripicons dripicons-clock text-muted" style="font-size: 20px;"></i>
                    <?php
                       $id = $_SESSION['id_instructor'] ?? '';
                       $select_course_pending_approval = $conn->prepare("SELECT * FROM `course`WHERE approval = 'pending approval' && id_instructor = ? ");
                       $select_course_pending_approval->execute([$id]);
                       $total_course_pending_approval =  $select_course_pending_approval->rowCount();
                    ?>
                    <h5 class="card-title"><?= $total_course_pending_approval; ?></h5>
                    <p class="card-text"><small class="text-body-secondary">Pending Approval</small></p>
                </div>
            </div>
            <div class="card border">
                <div class="card-body">
                    <i class="icon dripicons dripicons-thumbs-up text-muted" style="font-size: 20px;"></i>
                    <?php
                       $id = $_SESSION['id_instructor'] ?? '';
                       $select_course_approved = $conn->prepare("SELECT * FROM `course`WHERE approval = 'approved' && id_instructor = ? ");
                       $select_course_approved->execute([$id]);
                       $total_course_approved =  $select_course_approved->rowCount();
                    ?>
                    <h5 class="card-title"><?= $total_course_approved; ?></h5>
                    <p class="card-text"><small class="text-body-secondary">Approved</small></p>
                </div>
            </div>
            <div class="card border">
                <div class="card-body">
                    <i class="icon dripicons dripicons-thumbs-down text-muted" style="font-size: 20px;"></i>
                    <?php
                       $id = $_SESSION['id_instructor'] ?? '';
                       $select_course_not_approved = $conn->prepare("SELECT * FROM `course`WHERE approval = 'not approved' && id_instructor = ? ");
                       $select_course_not_approved->execute([$id]);
                       $total_course_not_approved =  $select_course_not_approved->rowCount();
                    ?>
                    <h5 class="card-title"><?= $total_course_not_approved; ?></h5>
                    <p class="card-text"><small class="text-body-secondary">Not Approved</small></p>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- End of Info Data Course Instruktur-->

        <div class="row mt-4">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3 header-title">Course List</h5>
                        <table class="table table-striped text-gray-900" id="courseTable">
                            <thead>
                                <tr style="font-size: 0.9rem;">
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Lesson & Section</th>
                                    <th>Enrolled Employee</th>
                                    <th>Approval</th>
                                    <th>Schedule</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <!-- List for Admin -->
                            <?php
                                if ($_SESSION['user_type']=="admin" || $_SESSION['user_type']=="direktur"){
                            ?>
                            <tbody>
                                <?php
                                $no = 0;
                                $show_course = $conn->prepare("SELECT * FROM `course`, `instructors`, `sub_category` WHERE course.id_instructor = instructors.id_instructor && course.id_sub_category = sub_category.id_sub_category ORDER BY date_added DESC");
                                $show_course->execute();
                                if($show_course->rowCount() > 0){
                                    while($fetch_course = $show_course->fetch(PDO::FETCH_ASSOC)){
                                        $course_id = $fetch_course['id_course'];
                                        $no++;
                                ?>
                                <tr style="font-size: 0.8rem;">
                                    <td><?= $no; ?></td>
                                    <td>
                                        <strong><a href="#"><?= $fetch_course['title']; ?></a></strong><br>
                                        <small class="text-muted">Instructor: <?= $fetch_course['first_name']; ?>
                                            <?= $fetch_course['last_name']; ?></small>
                                    </td>
                                    <td>
                                        <span class="badge text-bg-secondary"><?= $fetch_course['name_sub']; ?></span>
                                    </td>
                                    <td>
                                        <?php
                                        $select_section = $conn->prepare("SELECT * FROM `section`WHERE id_course = ? ");
                                        $select_section->execute([$course_id]);
                                        $total_section =  $select_section->rowCount();
                                        ?>
                                        <small class="text-muted">Total Section: <?= $total_section; ?></small><br>
                                        <?php
                                        $select_lesson = $conn->prepare("SELECT * FROM `lesson`WHERE id_course = ? ");
                                        $select_lesson->execute([$course_id]);
                                        $total_lesson =  $select_lesson->rowCount();
                                        ?>
                                        <small class="text-muted">Total Lesson: <?= $total_lesson; ?></small><br>
                                    </td>
                                    <td>
                                        <?php
                                        $select_enrol = $conn->prepare("SELECT * FROM `enrol`WHERE id_course = ? ");
                                        $select_enrol->execute([$course_id]);
                                        $total_enrol =  $select_enrol->rowCount();
                                        ?>
                                        <small class="text-muted">Total Enrollment: <?= $total_enrol; ?></small>
                                    </td>
                                    <td>
                                        <?php if ($fetch_course['approval'] == 'pending approval'): ?>
                                        <span class="badge text-bg-warning">Pending Approval</span>
                                        <?php elseif ($fetch_course['approval'] == 'approved'): ?>
                                        <span class="badge text-bg-success">Approved</span>
                                        <?php else: ?>
                                        <span class="badge text-bg-danger">Not Approved</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <small class="text-muted">Start: <?= $fetch_course['start_date']; ?></small><br>
                                        <small class="text-muted">End: <?= $fetch_course['end_date']; ?></small><br>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($fetch_course['status'] == 'pending'): ?>
                                        <span class="badge text-bg-danger">Pending</span>
                                        <?php elseif ($fetch_course['status'] == 'active'):?>
                                        <span class="badge text-bg-success">Active</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary rounded-4" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                style="font-size: 0.8rem;">
                                                <i class="bi bi-three-dots-vertical" style="font-size: 0.8rem;"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" style="font-size: 0.9rem;">
                                                <li><a class="dropdown-item"
                                                        href="?page=update_course&get_id=<?= $course_id; ?>">
                                                        Edit This Course</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                    }
                                    }
                                ?>
                            </tbody>
                            <?php } ?>
                            <!-- End List for Admin -->

                            <!-- List for instruktur -->
                            <?php
                                if ($_SESSION['user_type']=="instruktur"){
                            ?>
                            <tbody>
                                <?php
                                $no = 0;
                                $id = $_SESSION['id_instructor'] ?? '';
                                $show_course = $conn->prepare("SELECT * FROM `course`, `sub_category` WHERE course.id_sub_category = sub_category.id_sub_category && id_instructor = ? ORDER BY date_added DESC");
                                $show_course->execute([$id]);
                                if($show_course->rowCount() > 0){
                                    while($fetch_course = $show_course->fetch(PDO::FETCH_ASSOC)){
                                        $course_id = $fetch_course['id_course'];
                                        $no++;
                                ?>
                                <tr style="font-size: 0.8rem;">
                                    <td><?= $no; ?></td>
                                    <td>
                                        <strong><a href="#"><?= $fetch_course['title']; ?></a></strong>
                                    </td>
                                    <td>
                                        <span class="badge text-bg-secondary"><?= $fetch_course['name_sub']; ?></span>
                                    </td>
                                    <td>
                                        <?php
                                        $select_section = $conn->prepare("SELECT * FROM `section`WHERE id_course = ? ");
                                        $select_section->execute([$course_id]);
                                        $total_section =  $select_section->rowCount();
                                        ?>
                                        <small class="text-muted">Total Section:<?= $total_section; ?></small><br>
                                        <?php
                                        $select_lesson = $conn->prepare("SELECT * FROM `lesson`WHERE id_course = ? ");
                                        $select_lesson->execute([$course_id]);
                                        $total_lesson =  $select_lesson->rowCount();
                                        ?>
                                        <small class="text-muted">Total Lesson:<?= $total_lesson; ?></small><br>
                                    </td>
                                    <td>
                                        <?php
                                        $select_enrol = $conn->prepare("SELECT * FROM `enrol`WHERE id_course = ? ");
                                        $select_enrol->execute([$course_id]);
                                        $total_enrol =  $select_enrol->rowCount();
                                        ?>
                                        <small class="text-muted">Total Enrollment:<?= $total_enrol; ?></small>
                                    </td>
                                    <td>
                                        <?php if ($fetch_course['approval'] == 'pending approval'): ?>
                                        <span class="badge text-bg-warning">Pending Approval</span>
                                        <?php elseif ($fetch_course['approval'] == 'approved'): ?>
                                        <span class="badge text-bg-success">Approved</span>
                                        <?php else: ?>
                                        <span class="badge text-bg-danger">Not Approved</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <small class="text-muted">Start:<?= $fetch_course['start_date']; ?></small><br>
                                        <small class="text-muted">End:<?= $fetch_course['end_date']; ?></small><br>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($fetch_course['status'] == 'pending'): ?>
                                        <span class="badge text-bg-danger">Pending</span>
                                        <?php elseif ($fetch_course['status'] == 'active'):?>
                                        <span class="badge text-bg-success">Active</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary rounded-4" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                style="font-size: 0.8rem;">
                                                <i class="bi bi-three-dots-vertical" style="font-size: 0.8rem;"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" style="font-size: 0.9rem;">
                                                <li><a class="dropdown-item"
                                                        href="?page=update_course&get_id=<?= $course_id; ?>">
                                                        Edit This Course</a></li>
                                                <li><a href="?page=update_course&get_id=<?= $course_id; ?>"
                                                        class="dropdown-item">Section &
                                                        Lesson</a>
                                                </li>
                                                <li><button class="dropdown-item modal-btn btn-delete-course"
                                                        id="btnDeleteCourse" data-bs-toggle="modal"
                                                        data-bs-target="#modalDeleteCourse" data-id="<?= $course_id; ?>"
                                                        data-title="<?= $fetch_course['title']; ?>">Delete</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                    }
                                    }
                                ?>
                            </tbody>
                            <?php } ?>
                            <!-- End List for Instruktur -->
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<!-- Modal --
<!-- delete course -->
<div class="modal text-gray-900" id="modalDeleteCourse" tabindex="-1">
    <form action="../page/course/action_course.php" method="POST" class="modal-form" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Course</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this course <b class="title"></b>?</p>

                </div>
                <input type="hidden" class="id_course" name="id_course">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger modal-btn" name="delete_course">Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>>