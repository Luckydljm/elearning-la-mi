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
                            <a href="?page=course">Courses</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Course</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-start">
                <div class="mx-3 fs-5"><i class="icon dripicons dripicons-toggles"></i></div>
                <?php
                    if(isset($_GET['get_id'])){
                        $get_id = $_GET['get_id'];
                    }
                    $select_course = $conn->prepare("SELECT * FROM `course`WHERE id_course = ? ");
                    $select_course->execute([$get_id]);
                    if($select_course->rowCount() > 0){
                        while($fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)){
                ?>
                <div class="fs-5">Update: <?= $fetch_course['title']; ?></div>
                <?php
                    }
                    }
                ?>
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

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <h5 class="header-title">Course Manager</h5>
                        <a href="?page=course" class="btn btn-outline-primary rounded-5"><i
                                class="bi bi-arrow-left"></i>
                            Back to Course List</a>
                    </div>
                    <form action="../page/course/action_course.php" method="post" enctype="multipart/form-data">
                        <div id="smartwizard">
                            <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#curriculum">
                                        <i class="icon dripicons dripicons-network-3"
                                            style="font-size: 12px; margin-right: 0.5rem;"></i>
                                        <span class="d-none d-sm-inline">Curriculum</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#basic">
                                        <i class="icon dripicons dripicons-pin"
                                            style="font-size: 12px; margin-right: 0.5rem;"></i>
                                        <span class="d-none d-sm-inline">Basic</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#requirements">
                                        <i class="icon dripicons dripicons-paperclip"
                                            style="font-size: 12px; margin-right: 0.5rem;"></i>
                                        <span class="d-none d-sm-inline">Requirements</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#outcomes">
                                        <i class="icon dripicons dripicons-export"
                                            style="font-size: 12px; margin-right: 0.5rem;"></i>
                                        <span class="d-none d-sm-inline">Outcomes</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#media">
                                        <i class="icon dripicons dripicons-media-play"
                                            style="font-size: 12px; margin-right: 0.5rem;"></i>
                                        <span class="d-none d-sm-inline">Media</span>
                                    </a>
                                </li>
                                <?php
                                    if ($_SESSION['user_type']=="admin"){
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#activation">
                                        <i class="icon dripicons dripicons-bell"
                                            style="font-size: 12px; margin-right: 0.5rem;"></i>
                                        <span class="d-none d-sm-inline">Activation</span>
                                    </a>
                                </li>
                                <?php } ?>

                                <?php
                                    if ($_SESSION['user_type']=="direktur"){
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#aprroval">
                                        <i class="icon dripicons dripicons-bell"
                                            style="font-size: 12px; margin-right: 0.5rem;"></i>
                                        <span class="d-none d-sm-inline">Aprroval</span>
                                    </a>
                                </li>
                                <?php } ?>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#finish">
                                        <i class="icon dripicons dripicons-checkmark"
                                            style="font-size: 12px; margin-right: 0.5rem;"></i>
                                        <span class="d-none d-sm-inline">Finish</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <!-- Tab Content for Admin-->
                            <?php
                                if ($_SESSION['user_type']=="admin" || $_SESSION['user_type']=="direktur"){
                            ?>
                            <div class="tab-content">
                                <div id="curriculum" class="tab-pane" role="tabpanel" aria-labelledby="curriculum">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="row">
                                                <?php
                                                if(isset($_GET['get_id'])){
                                                    $get_id = $_GET['get_id'];
                                                }
                                                $no = 0;
                                                $show_section = $conn->prepare("SELECT * FROM `section` WHERE id_course = ? ");
                                                $show_section->execute([$get_id]);
                                                if($show_section->rowCount() > 0){
                                                    while($fetch_section = $show_section->fetch(PDO::FETCH_ASSOC)){
                                                        $section_id = $fetch_section['id_section'];
                                                        $no++;
                                                ?>
                                                <div class="col-xl-12">
                                                    <div class="card mb-5" style="background-color: #e3eaef;"
                                                        id="section-<?= $fetch_section['id_section']; ?>">
                                                        <div class="card-body">
                                                            <h5 class="card-title" class="mb-3"
                                                                style="min-height: 35px; font-size: 1rem;">
                                                                <div class="section">
                                                                    <span class="fw-lighter">Section
                                                                        <?= $no; ?></span> :
                                                                    <?= $fetch_section['title']; ?>
                                                                </div>
                                                            </h5>
                                                            <?php
                                                                $lesson_counter = 0;
                                                                $quiz_counter = 0;
                                                                $show_lesson = $conn->prepare("SELECT * FROM `lesson` WHERE id_section = ? ");
                                                                $show_lesson->execute([$section_id]);
                                                                if($show_lesson->rowCount() > 0){
                                                                    while($fetch_lesson = $show_lesson->fetch(PDO::FETCH_ASSOC)){
                                                                        $lesson_id = $fetch_lesson['id_lesson'];
                                                            ?>
                                                            <div class="col-md-12">
                                                                <!-- Portlet card -->
                                                                <div class="card text-secondary mb-2"
                                                                    id="lesson-<?= $fetch_lesson['id_lesson']; ?>">
                                                                    <div
                                                                        class="card-body p-3 d-flex justify-content-between">
                                                                        <h5 class="card-title mb-0"
                                                                            style="font-size: 1rem;">
                                                                            <span class="fw-lighter">
                                                                                <?php
                                                                                    if ($fetch_lesson['lesson_type'] == 'quiz') {
                                                                                        $quiz_counter++; // Keeps track of number of quiz
                                                                                        $lesson_type = $fetch_lesson['lesson_type'];
                                                                                    }else {
                                                                                        $lesson_counter++; // Keeps track of number of lesson
                                                                                        if ($fetch_lesson['attachment_type'] == 'txt' || $fetch_lesson['attachment_type'] == 'pdf' || $fetch_lesson['attachment_type'] == 'docx' || $fetch_lesson['attachment_type'] == 'jpg' || $fetch_lesson['attachment_type'] == 'jpeg' || $fetch_lesson['attachment_type'] == 'png') {
                                                                                            $lesson_type = $fetch_lesson['attachment_type'];
                                                                                        }else {
                                                                                            $lesson_type = 'video';
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                                <img src="../public/assets/lesson_icon/<?= $lesson_type.'.png'; ?>"
                                                                                    alt="" height="16">
                                                                                <?php
                                                                                    if ($fetch_lesson['lesson_type'] == 'quiz'){
                                                                                ?>
                                                                                Quiz <?= $quiz_counter; ?></span> :
                                                                            <?= $fetch_lesson['title']; ?>
                                                                            <?php }else{ ?>
                                                                            Lesson <?= $lesson_counter; ?></span> :
                                                                            <?= $fetch_lesson['title']; ?>
                                                                            <?php } ?>
                                                                        </h5>
                                                                        <div class="card-widgets display-none"
                                                                            id="widgets-of-lesson-<?= $fetch_lesson['id_lesson']; ?>">
                                                                            <!-- Quiz Widget -->
                                                                            <?php
                                                                                if ($fetch_lesson['lesson_type'] == 'quiz'){
                                                                            ?>
                                                                            <a href="?page=add_question&get_id_lesson=<?= $lesson_id; ?>"
                                                                                class="mx-1"><i
                                                                                    class="icon dripicons dripicons-question"></i></a>
                                                                            <?php }?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                                }
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                    }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                    if(isset($_GET['get_id'])){
                                        $get_id = $_GET['get_id'];
                                    }
                                    $select_course = $conn->prepare("SELECT * FROM `course`, `sub_category` WHERE course.id_sub_category = sub_category.id_sub_category && id_course = ? ");
                                    $select_course->execute([$get_id]);
                                    if($select_course->rowCount() > 0){
                                        while($fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <div id="basic" class="tab-pane" role="tabpanel" aria-labelledby="basic">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 form-text" for="title">Course Title
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        placeholder="Enter Course Title"
                                                        value="<?= $fetch_course['title']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 form-text" for="short_desc">Short
                                                    Description</label>
                                                <div class="col-md-10">
                                                    <textarea name="short_desc" id="short_desc" class="form-control"
                                                        readonly><?= $fetch_course['short_desc']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 form-text" for="desciption">Description</label>
                                                <div class="col-md-10">
                                                    <textarea name="description" id="description" class="form-control"
                                                        readonly><?= $fetch_course['description']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 form-text" for="id_sub_category">Category<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-10">
                                                    <select class="form-control select2" data-toggle="select2"
                                                        name="id_sub_category" id="id_sub_category" required>
                                                        <option value="<?= $fetch_course['id_sub_category']; ?>"
                                                            selected><?= $fetch_course['name_sub']; ?>
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="requirements" class="tab-pane" role="tabpanel" aria-labelledby="requirements">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="form-group row mt-2">
                                                <label class="col-md-2 form-text"
                                                    for="requirements">Requirements</label>
                                                <div class="col-md-10">
                                                    <textarea name="requirements" id="requirements" class="form-control"
                                                        readonly><?= $fetch_course['requirements']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="outcomes" class="tab-pane" role="tabpanel" aria-labelledby="outcomes">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="form-group row mt-2">
                                                <label class="col-md-2 form-text" for="outcomes">Outcomes</label>
                                                <div class="col-md-10">
                                                    <textarea name="outcomes" id="outcomes" class="form-control"
                                                        readonly><?= $fetch_course['outcomes']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="media" class="tab-pane" role="tabpanel" aria-labelledby="media">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="form-group row mt-2">
                                                <label class="col-md-2 form-text" for="thumbnail">Current
                                                    Thumbnail</label>
                                                <div class="col-md-10">
                                                    <img src="../uploaded_thumbnail/<?= $fetch_course['thumbnail']; ?>"
                                                        alt="Thumbnail" width="150">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                    if ($_SESSION['user_type']=="admin"){
                                ?>
                                <div id="activation" class="tab-pane" role="tabpanel" aria-labelledby="activation">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="form-group row mt-2">
                                                <label for="status" class="col-md-2 form-text">Status Activation</label>
                                                <div class="col-md-10">
                                                    <select id="status" class="form-select"
                                                        aria-label="Default select example" name="status">
                                                        <option value="<?= $fetch_course['status']; ?>" selected>
                                                            <?= $fetch_course['status']; ?></option>
                                                        <option value="pending">Pending</option>
                                                        <option value="active">Active</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

                                <?php
                                    if ($_SESSION['user_type']=="direktur"){
                                ?>
                                <div id="approval" class="tab-pane" role="tabpanel" aria-labelledby="approval">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="form-group row mt-2">
                                                <label for="approval" class="col-md-2 form-text">Status
                                                    Approval</label>
                                                <div class="col-md-10">
                                                    <select id="approval" class="form-select"
                                                        aria-label="Default select example" name="approval">
                                                        <option value="<?= $fetch_course['approval']; ?>" selected>
                                                            <?= $fetch_course['approval']; ?></option>
                                                        <option value="approved">Approved</option>
                                                        <option value="not approved">Not Approved</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row my-3">
                                                <label class="col-md-2 form-text" for="start_date">Start Date</label>
                                                <div class="col-md-10">
                                                    <input type="date" class="form-control" id="start_date"
                                                        name="start_date" placeholder="Enter Course start_date"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-group row my-3">
                                                <label class="col-md-2 form-text" for="end_date">End Date</label>
                                                <div class="col-md-10">
                                                    <input type="date" class="form-control" id="end_date"
                                                        name="end_date" placeholder="Enter Course end_date" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

                                <div id="finish" class="tab-pane" role="tabpanel" aria-labelledby="finish">
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <h2 class="mt-0"><i class="icon dripicons dripicons-upload"></i>
                                                </h2>
                                                <h3 class="mt-0">Thank You</h3>

                                                <p class="w-75 mb-2 mx-auto">
                                                    You Are Just One Click Away</p>

                                                <div class="mb-3 mt-3">
                                                    <input class="last_modified" type="hidden" name="last_modified"
                                                        value="<?php echo date('Y-m-d')?>">
                                                    <input class="id_course" type="hidden" name="id_course"
                                                        value="<?= $get_id; ?>">
                                                    <button type="submit" class="btn btn-primary text-center"
                                                        name="update">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    }
                                    }
                                ?>
                            </div>
                            <?php } ?>

                            <!-- Tab Content for Instruktur-->
                            <?php
                                if ($_SESSION['user_type']=="instruktur"){
                            ?>
                            <div class="tab-content">
                                <div id="curriculum" class="tab-pane" role="tabpanel" aria-labelledby="curriculum">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-12 mb-4 text-center mt-3">
                                            <a href="#" class="btn btn-outline-primary rounded-5 mx-1 modal-btn"
                                                data-bs-toggle="modal" data-bs-target="#modalAddSection"><i
                                                    class="bi bi-plus-lg"></i>
                                                Add Section</a>
                                            <a href="" class="btn btn-outline-primary rounded-5 mx-1 modal-btn"
                                                data-bs-toggle="modal" data-bs-target="#modalAddLesson"><i
                                                    class="bi bi-plus-lg"></i>
                                                Add Lesson</a>
                                            <a href="" class="btn btn-outline-primary rounded-5 mx-1 modal-btn"
                                                data-bs-toggle="modal" data-bs-target="#modalAddQuiz"><i
                                                    class="bi bi-plus-lg"></i>
                                                Add Quiz</a>
                                        </div>
                                        <div class="col-xl-8">
                                            <div class="row">
                                                <?php
                                                if(isset($_GET['get_id'])){
                                                    $get_id = $_GET['get_id'];
                                                }
                                                $no = 0;
                                                $show_section = $conn->prepare("SELECT * FROM `section` WHERE id_course = ? ");
                                                $show_section->execute([$get_id]);
                                                if($show_section->rowCount() > 0){
                                                    while($fetch_section = $show_section->fetch(PDO::FETCH_ASSOC)){
                                                        $section_id = $fetch_section['id_section'];
                                                        $no++;
                                                ?>
                                                <div class="col-xl-12">
                                                    <div class="card mb-5" style="background-color: #e3eaef;"
                                                        id="section-<?= $fetch_section['id_section']; ?>">
                                                        <div class="card-body">
                                                            <h5 class="card-title d-flex justify-content-between"
                                                                class="mb-3" style="min-height: 35px; font-size: 1rem;">
                                                                <div class="section">
                                                                    <span class="fw-lighter">Section
                                                                        <?= $no; ?></span> :
                                                                    <?= $fetch_section['title']; ?>
                                                                </div>
                                                                <div class="row"
                                                                    id="widgets-of-section-<?= $fetch_section['id_section']; ?>">
                                                                    <div class="col-xl-12 text-center">
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary rounded-5 btn-sm modal-btn btn-edit-section"
                                                                            id="btnEditSection" data-bs-toggle="modal"
                                                                            data-bs-target="#modalEditSection"
                                                                            data-id="<?= $fetch_section['id_section']; ?>"
                                                                            data-title="<?= $fetch_section['title']; ?>">Edit</button>
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary rounded-5 btn-sm modal-btn btn-delete-section"
                                                                            id="btnDeleteSection" data-bs-toggle="modal"
                                                                            data-bs-target="#modalDeleteSection"
                                                                            data-id="<?= $fetch_section['id_section']; ?>"
                                                                            data-title="<?= $fetch_section['title']; ?>">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </h5>
                                                            <?php
                                                                $lesson_counter = 0;
                                                                $quiz_counter = 0;
                                                                $show_lesson = $conn->prepare("SELECT * FROM `lesson` WHERE id_section = ? ");
                                                                $show_lesson->execute([$section_id]);
                                                                if($show_lesson->rowCount() > 0){
                                                                    while($fetch_lesson = $show_lesson->fetch(PDO::FETCH_ASSOC)){
                                                                        $lesson_id = $fetch_lesson['id_lesson'];
                                                            ?>
                                                            <div class="col-md-12">
                                                                <!-- Portlet card -->
                                                                <div class="card text-secondary mb-2"
                                                                    id="lesson-<?= $fetch_lesson['id_lesson']; ?>">
                                                                    <div
                                                                        class="card-body p-3 d-flex justify-content-between">
                                                                        <h5 class="card-title mb-0"
                                                                            style="font-size: 1rem;">
                                                                            <span class="fw-lighter">
                                                                                <?php
                                                                                    if ($fetch_lesson['lesson_type'] == 'quiz') {
                                                                                        $quiz_counter++; // Keeps track of number of quiz
                                                                                        $lesson_type = $fetch_lesson['lesson_type'];
                                                                                    }else {
                                                                                        $lesson_counter++; // Keeps track of number of lesson
                                                                                        if ($fetch_lesson['attachment_type'] == 'txt' || $fetch_lesson['attachment_type'] == 'pdf' || $fetch_lesson['attachment_type'] == 'docx' || $fetch_lesson['attachment_type'] == 'jpg' || $fetch_lesson['attachment_type'] == 'jpeg' || $fetch_lesson['attachment_type'] == 'png') {
                                                                                            $lesson_type = $fetch_lesson['attachment_type'];
                                                                                        }else {
                                                                                            $lesson_type = 'video';
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                                <img src="../public/assets/lesson_icon/<?= $lesson_type.'.png'; ?>"
                                                                                    alt="" height="16">
                                                                                <?php
                                                                                    if ($fetch_lesson['lesson_type'] == 'quiz'){
                                                                                ?>
                                                                                Quiz <?= $quiz_counter; ?></span> :
                                                                            <?= $fetch_lesson['title']; ?>
                                                                            <?php }else{ ?>
                                                                            Lesson <?= $lesson_counter; ?></span> :
                                                                            <?= $fetch_lesson['title']; ?>
                                                                            <?php } ?>
                                                                        </h5>
                                                                        <div class="card-widgets display-none"
                                                                            id="widgets-of-lesson-<?= $fetch_lesson['id_lesson']; ?>">
                                                                            <!-- Quiz Widget -->
                                                                            <?php
                                                                                if ($fetch_lesson['lesson_type'] == 'quiz'){
                                                                            ?>
                                                                            <a href="?page=add_question&get_id_lesson=<?= $lesson_id; ?>"
                                                                                class="mx-1"><i
                                                                                    class="icon dripicons dripicons-question"></i></a>
                                                                            <a href="#"
                                                                                class="mx-1 modal-btn btn-edit-quiz"
                                                                                id="btnEditQuiz" data-bs-toggle="modal"
                                                                                data-bs-target="#modalEditQuiz"
                                                                                data-id="<?= $fetch_lesson['id_lesson']; ?>"
                                                                                data-title="<?= $fetch_lesson['title']; ?>"
                                                                                data-summary="<?= $fetch_lesson['summary']; ?>"><i
                                                                                    class="icon dripicons dripicons-pencil"></i></a>
                                                                            <?php } else{?>

                                                                            <!-- Other Widget -->
                                                                            <a href="#"
                                                                                class="mx-1 modal-btn btn-edit-lesson"
                                                                                id="btnEditLesson"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#modalEditLesson"
                                                                                data-id="<?= $fetch_lesson['id_lesson']; ?>"
                                                                                data-title="<?= $fetch_lesson['title']; ?>"
                                                                                data-summary="<?= $fetch_lesson['summary']; ?>"><i
                                                                                    class="icon dripicons dripicons-pencil"></i></a>
                                                                            <?php }?>
                                                                            <a href="#"
                                                                                class="mx-1 modal-btn btn-delete-lesson"
                                                                                id="btnDeleteLesson"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#modalDeleteLesson"
                                                                                data-id="<?= $fetch_lesson['id_lesson']; ?>"
                                                                                data-title="<?= $fetch_lesson['title']; ?>"><i
                                                                                    class="icon dripicons dripicons-cross"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                                }
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                    }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                    if(isset($_GET['get_id'])){
                                        $get_id = $_GET['get_id'];
                                    }
                                    $select_course = $conn->prepare("SELECT * FROM `course`, `sub_category` WHERE course.id_sub_category = sub_category.id_sub_category && id_course = ? ");
                                    $select_course->execute([$get_id]);
                                    if($select_course->rowCount() > 0){
                                        while($fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <div id="basic" class="tab-pane" role="tabpanel" aria-labelledby="basic">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 form-text" for="title">Course Title
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        placeholder="Enter Course Title"
                                                        value="<?= $fetch_course['title']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 form-text" for="short_desc">Short
                                                    Description</label>
                                                <div class="col-md-10">
                                                    <textarea name="short_desc" id="short_desc"
                                                        class="form-control"><?= $fetch_course['short_desc']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 form-text" for="desciption">Description</label>
                                                <div class="col-md-10">
                                                    <textarea name="description" id="textEditor"
                                                        class="form-control"><?= $fetch_course['description']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 form-text" for="id_sub_category">Category<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-10">
                                                    <select class="form-control select2" data-toggle="select2"
                                                        name="id_sub_category" id="id_sub_category" required>
                                                        <option value="<?= $fetch_course['id_sub_category']; ?>"
                                                            selected><?= $fetch_course['name_sub']; ?>
                                                        </option>
                                                        <?php
                                                        $id = $_SESSION['id_instructor'] ?? '';
                                                        $select_category = $conn->prepare("SELECT * FROM `category` WHERE id_instructor = ?");
                                                        $select_category->execute([$id]);
                                                        if($select_category->rowCount() > 0){
                                                            while($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)){
                                                                $category_id = $fetch_category['id_category'];
                                                        ?>
                                                        <optgroup label="<?= $fetch_category['name']; ?>">
                                                            <?php
                                                            $select_sub_category = $conn->prepare("SELECT * FROM `sub_category`WHERE id_category = ? ");
                                                            $select_sub_category->execute([$category_id]);
                                                            if($select_sub_category->rowCount() > 0){
                                                                while($fetch_sub_category = $select_sub_category->fetch(PDO::FETCH_ASSOC)){
                                                            ?>
                                                            <option
                                                                value="<?= $fetch_sub_category['id_sub_category']; ?>">
                                                                <?= $fetch_sub_category['name_sub']; ?>
                                                            </option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </optgroup>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="requirements" class="tab-pane" role="tabpanel" aria-labelledby="requirements">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="form-group row mt-2">
                                                <label class="col-md-2 form-text"
                                                    for="requirements">Requirements</label>
                                                <div class="col-md-10">
                                                    <textarea name="requirements" id="requirements"
                                                        class="form-control"><?= $fetch_course['requirements']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="outcomes" class="tab-pane" role="tabpanel" aria-labelledby="outcomes">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="form-group row mt-2">
                                                <label class="col-md-2 form-text" for="outcomes">Outcomes</label>
                                                <div class="col-md-10">
                                                    <textarea name="outcomes" id="outcomes"
                                                        class="form-control"><?= $fetch_course['outcomes']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="media" class="tab-pane" role="tabpanel" aria-labelledby="media">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="form-group row mt-2">
                                                <label class="col-md-2 form-text" for="thumbnail">Current
                                                    Thumbnail</label>
                                                <div class="col-md-10">
                                                    <img src="../uploaded_thumbnail/<?= $fetch_course['thumbnail']; ?>"
                                                        alt="Thumbnail" width="150">
                                                </div>
                                            </div>
                                            <div class="form-group row mt-2">
                                                <label class="col-md-2 form-text" for="thumbnail">Course
                                                    Thumbnail<span class="text-danger"> *</span></label>
                                                <div class="col-md-10">
                                                    <!-- <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                                                        class="image-preview-filepond" /> -->
                                                    <input type="file" name="thumbnail" class="form-control"
                                                        id="thumbnail" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="finish" class="tab-pane" role="tabpanel" aria-labelledby="finish">
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <h2 class="mt-0"><i class="icon dripicons dripicons-upload"></i>
                                                </h2>
                                                <h3 class="mt-0">Thank You</h3>

                                                <p class="w-75 mb-2 mx-auto">
                                                    You Are Just One Click Away</p>

                                                <div class="mb-3 mt-3">
                                                    <input class="last_modified" type="hidden" name="last_modified"
                                                        value="<?php echo date('Y-m-d')?>">
                                                    <input class="id_course" type="hidden" name="id_course"
                                                        value="<?= $get_id; ?>">
                                                    <button type="submit" class="btn btn-primary text-center"
                                                        name="update">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    }
                                    }
                                ?>
                            </div>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End of Tab Content -->
        </div>

    </section>
</div>

<!-- modals -->
<!-- add section -->
<div class=" modal text-gray-900" id="modalAddSection" tabindex="-1">
    <form action="../page/course/action_course.php" method="POST" class="modal-form" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Section</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input autocomplete="off" type="text" class="form-control" id="title" name="title"
                            aria-describedby="emailHelp" required>
                        <small class="fw-lighter fst-italic" style="font-size: 0.7rem;">Provide A Section Name</small>
                    </div>
                </div>
                <?php
                    if(isset($_GET['get_id'])){
                        $get_id = $_GET['get_id'];
                    }  
                ?>
                <input class="id_course" type="hidden" name="id_course" value="<?= $get_id; ?>">
                <input class="id_section" type="hidden" name="id_section">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary modal-btn" name="submit_section">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- add lesson -->
<div class=" modal text-gray-900" id="modalAddLesson" tabindex="-1">
    <form action="../page/course/action_course.php" method="POST" class="modal-form" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Lesson</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input autocomplete="off" type="text" class="form-control" id="title" name="title"
                            aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_section" class="form-label">Section</label>
                        <select id="id_section" class="form-select select2" data-toggle="select2"
                            aria-label="Default select example" name="id_section">
                            <?php
                            if(isset($_GET['get_id'])){
                                $get_id = $_GET['get_id'];
                            }
                            $select_section = $conn->prepare("SELECT * FROM `section` WHERE id_course = ? ");
                            $select_section->execute([$get_id]);
                            if($select_section->rowCount() > 0){
                                while($fetch_section = $select_section->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option value="<?= $fetch_section['id_section']; ?>"> <?= $fetch_section['title']; ?>
                            </option>
                            <?php
                                }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="lesson_type" class="form-label">Lesson Type</label>
                        <select id="lesson_type" class="form-select select2" data-toggle="select2"
                            aria-label="Default select example" name="lesson_type"
                            onchange="show_lesson_type_form(this.value)" required>
                            <option value="">Select Type of Lesson</option>
                            <option value="video-url">Video URL</option>
                            <option value="other-txt">Text File</option>
                            <option value="other-pdf">PDF File</option>
                            <option value="other-doc">Document File</option>
                            <option value="other-img">Image File</option>
                        </select>
                    </div>

                    <div class="" id="video" style="display: none;">
                        <div class="mb-3">
                            <label for="video_url" class="form-label">Video URL</label>
                            <input autocomplete="off" type="text" class="form-control" id="video_url" name="video_url">
                        </div>
                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration</label>
                            <input autocomplete="off" type="text" class="form-control" id="duration" name="duration">
                        </div>
                    </div>

                    <div class="" id="other" style="display: none;">
                        <div class="mb-3">
                            <label for="attachment" class="form-label">Attachment</label>
                            <input type="file" name="attachment" class="form-control" id="attachment" accept="*">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="summary" class="form-label">Summary</label>
                        <textarea name="summary" id="summary" class="form-control"></textarea>
                    </div>
                </div>
                <input class="attachment_type" type="hidden" name="attachment_type">
                <input class="date_added" type="hidden" name="date_added" value="<?php echo date('Y-m-d')?>">
                <input class="id_course" type="hidden" name="id_course" value="<?= $get_id; ?>">
                <input class="id_lesson" type="hidden" name="id_lesson">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary modal-btn" name="submit_lesson">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- add quiz -->
<div class=" modal text-gray-900" id="modalAddQuiz" tabindex="-1">
    <form action="../page/course/action_course.php" method="POST" class="modal-form" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Quiz</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Quiz Title</label>
                        <input autocomplete="off" type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_section" class="form-label">Section</label>
                        <select id="id_section" class="form-select select2" data-toggle="select2"
                            aria-label="Default select example" name="id_section">
                            <?php
                            if(isset($_GET['get_id'])){
                                $get_id = $_GET['get_id'];
                            }
                            $select_section = $conn->prepare("SELECT * FROM `section` WHERE id_course = ? ");
                            $select_section->execute([$get_id]);
                            if($select_section->rowCount() > 0){
                                while($fetch_section = $select_section->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option value="<?= $fetch_section['id_section']; ?>"> <?= $fetch_section['title']; ?>
                            </option>
                            <?php
                                }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="summary" class="form-label">Instruction</label>
                        <textarea name="summary" id="summary" class="form-control"></textarea>
                    </div>
                </div>
                <input class="lesson_type" type="hidden" name="lesson_type" value="quiz">
                <input class="date_added" type="hidden" name="date_added" value="<?php echo date('Y-m-d')?>">
                <input class="id_course" type="hidden" name="id_course" value="<?= $get_id; ?>">
                <input class="id_lesson" type="hidden" name="id_lesson">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary modal-btn" name="submit_lesson">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- edit lesson-->
<div class="modal text-gray-900" id="modalEditLesson" tabindex="-1">
    <form action="../page/course/action_course.php" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Lesson</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input autocomplete="off" type="text" class="form-control title" id="title" name="title"
                            aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_section" class="form-label">Section</label>
                        <select id="id_section" class="form-select select2" data-toggle="select2"
                            aria-label="Default select example" name="id_section">
                            <?php
                            if(isset($_GET['get_id'])){
                                $get_id = $_GET['get_id'];
                            }
                            $select_section = $conn->prepare("SELECT * FROM `section` WHERE id_course = ? ");
                            $select_section->execute([$get_id]);
                            if($select_section->rowCount() > 0){
                                while($fetch_section = $select_section->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option value="<?= $fetch_section['id_section']; ?>"> <?= $fetch_section['title']; ?>
                            </option>
                            <?php
                                }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="summary" class="form-label">Summary</label>
                        <textarea name="summary" id="summary" class="form-control summary"></textarea>
                    </div>
                    <input class="attachment_type" type="hidden" name="attachment_type">
                    <input class="last_modified" type="hidden" name="last_modified" value="<?php echo date('Y-m-d')?>">
                    <input class="id_lesson" type="hidden" name="id_lesson">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary modal-btn" name="update_lesson">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- edit quiz-->
<div class="modal text-gray-900" id="modalEditQuiz" tabindex="-1">
    <form action="../page/course/action_course.php" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Quiz</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Quiz Title</label>
                        <input autocomplete="off" type="text" class="form-control title" id="title" name="title"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="id_section" class="form-label">Section</label>
                        <select id="id_section" class="form-select" aria-label="Default select example"
                            name="id_section">
                            <?php
                            if(isset($_GET['get_id'])){
                                $get_id = $_GET['get_id'];
                            }
                            $select_section = $conn->prepare("SELECT * FROM `section` WHERE id_course = ? ");
                            $select_section->execute([$get_id]);
                            if($select_section->rowCount() > 0){
                                while($fetch_section = $select_section->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option value="<?= $fetch_section['id_section']; ?>"> <?= $fetch_section['title']; ?>
                            </option>
                            <?php
                                }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="summary" class="form-label">Instruction</label>
                        <textarea name="summary" id="summary" class="form-control summary"></textarea>
                    </div>
                    <input class="last_modified" type="hidden" name="last_modified" value="<?php echo date('Y-m-d')?>">
                    <input class="id_lesson" type="hidden" name="id_lesson">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary modal-btn" name="update_quiz">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- edit section-->
<div class="modal text-gray-900" id="modalEditSection" tabindex="-1">
    <form action="../page/course/action_course.php" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Section</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input autocomplete="off" type="text" class="form-control title" id="title" name="title"
                            aria-describedby="emailHelp" required>
                        <small class="fw-lighter fst-italic" style="font-size: 0.7rem;">Provide A Section Name</small>
                    </div>
                    <input class="id_section" type="hidden" name="id_section">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary modal-btn" name="update_section">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- delete lesson -->
<div class="modal text-gray-900" id="modalDeleteLesson" tabindex="-1">
    <form action="../page/course/action_course.php" method="POST" class="modal-form" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Lesson</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this lesson <b class="title"></b>?</p>

                </div>
                <input type="hidden" class="id_lesson" name="id_lesson">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger modal-btn" name="delete_lesson">Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- delete section -->
<div class="modal text-gray-900" id="modalDeleteSection" tabindex="-1">
    <form action="../page/course/action_course.php" method="POST" class="modal-form" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Section</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this section <b class="title"></b>?</p>

                </div>
                <input type="hidden" class="id_section" name="id_section">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger modal-btn" name="delete_section">Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// add lesson
function show_lesson_type_form(param) {
    var checker = param.split('-');
    var lesson_type = checker[0];
    if (lesson_type === 'video') {
        $('#other').hide();
        $('#video').show();
    } else if (lesson_type === 'other') {
        $('#video').hide();
        $('#other').show();
    } else {
        $('#video').hide();
        $('#other').hide();
    }
}
</script>