<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h2>Questions</h2>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="?page=course">Courses</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Questions</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-start">
                <div class="mx-3 fs-5"><i class="icon dripicons dripicons-toggles"></i></div>
                <div class="fs-5">Manage Quiz Questions</div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <?php
                            if(isset($_GET['get_id_lesson'])){
                                $get_id_lesson = $_GET['get_id_lesson'];
                            }
                            $select_lesson = $conn->prepare("SELECT * FROM `lesson`WHERE id_lesson = ? ");
                            $select_lesson->execute([$get_id_lesson]);
                            if($select_lesson->rowCount() > 0){
                                while($fetch_lesson = $select_lesson->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <div class="fs-5">Questions Of : <?= $fetch_lesson['title']; ?></div>
                        <?php
                            }
                            }
                        ?>
                        <a href="#" class="btn btn-outline-primary rounded-5 mx-1 modal-btn" data-bs-toggle="modal"
                            data-bs-target="#modalAddQuestion"><i class="bi bi-plus-lg"></i>
                            Add New Question</a>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                            <div class="row">
                                <?php
                                $i = 0;
                                if(isset($_GET['get_id_lesson'])){
                                    $get_id_lesson = $_GET['get_id_lesson'];
                                }
                                $show_question = $conn->prepare("SELECT * FROM `question` WHERE id_lesson = ? ");
                                $show_question->execute([$get_id_lesson]);
                                if($show_question->rowCount() > 0){
                                    while($fetch_question = $show_question->fetch(PDO::FETCH_ASSOC)){
                                        $question_id = $fetch_question['id_question'];
                                        $i++;
                                ?>
                                <div class="col-xl-12">
                                    <div class="card mb-5" style="background-color: #e3eaef;"
                                        id="question-<?= $fetch_question['id_question']; ?>">
                                        <div class="card-body">
                                            <h5 class="card-title d-flex justify-content-between" class="mb-3"
                                                style="min-height: 35px; font-size: 1rem;">
                                                <div class="question">
                                                    <span class="fw-lighter">Soal <?= $i; ?></span> :
                                                </div>
                                                <div class="row"
                                                    id="widgets-of-question-<?= $fetch_question['id_question']; ?>">
                                                    <?php
                                                        if ($_SESSION['user_type']=="instruktur"){
                                                    ?>
                                                    <div class="col-xl-12 text-center">
                                                        <button type="button"
                                                            class="btn btn-outline-secondary rounded-5 btn-sm modal-btn btn-edit-question"
                                                            id="btnEditQuestion" data-bs-toggle="modal"
                                                            data-bs-target="#modalEditQuestion"
                                                            data-id="<?= $fetch_question['id_question']; ?>"
                                                            data-title="<?= $fetch_question['title']; ?>"
                                                            data-option_a="<?= $fetch_question['option_a']; ?>"
                                                            data-option_b="<?= $fetch_question['option_b']; ?>"
                                                            data-option_c="<?= $fetch_question['option_c']; ?>"
                                                            data-option_d="<?= $fetch_question['option_d']; ?>"
                                                            data-correct_answers="<?= $fetch_question['correct_answers']; ?>">Edit</button>
                                                        <button type=" button"
                                                            class="btn btn-outline-secondary rounded-5 btn-sm modal-btn btn-delete-question"
                                                            id="btnDeleteQuestion" data-bs-toggle="modal"
                                                            data-bs-target="#modalDeleteQuestion"
                                                            data-id="<?= $fetch_question['id_question']; ?>"
                                                            data-title="<?= $fetch_question['title']; ?>">Delete</button>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </h5>
                                            <div class="col-md-12">
                                                <!-- Portlet card -->
                                                <div class="card text-secondary mb-2">
                                                    <div class="card-body p-3 d-flex justify-content-between">
                                                        <h5 class="card-title mb-0" style="font-size: 1rem;">
                                                            <span class="fw-lighter">
                                                            </span><?= $fetch_question['title']; ?>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="card text-secondary mb-2">
                                                    <div class="card-body p-3">
                                                        <h5 class="card-title mb-3" style="font-size: 1rem;">
                                                            Option A:
                                                            <span
                                                                class="fw-lighter"><?= $fetch_question['option_a']; ?></span>
                                                        </h5>
                                                        <h5 class="card-title mb-3" style="font-size: 1rem;">
                                                            Option B:
                                                            <span
                                                                class="fw-lighter"><?= $fetch_question['option_b']; ?></span>
                                                        </h5>
                                                        <h5 class="card-title mb-3" style="font-size: 1rem;">
                                                            Option C:
                                                            <span
                                                                class="fw-lighter"><?= $fetch_question['option_c']; ?></span>
                                                        </h5>
                                                        <h5 class="card-title mb-0" style="font-size: 1rem;">
                                                            Option D:
                                                            <span
                                                                class="fw-lighter"><?= $fetch_question['option_d']; ?></span>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="card text-secondary mb-2">
                                                    <div class="card-body p-3 d-flex justify-content-between">
                                                        <h5 class="card-title mb-0" style="font-size: 1rem;">
                                                            Correct Answers:
                                                            <span
                                                                class="fw-lighter"><?= $fetch_question['correct_answers']; ?></span>
                                                        </h5>
                                                    </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<!-- modals -->
<!-- add question -->
<div class=" modal text-gray-900" id="modalAddQuestion" tabindex="-1">
    <form action="../page/course/action_course.php" method="POST" class="modal-form" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Question</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Question Title</label>
                        <textarea class="form-control" id="textEditor" name="title" aria-describedby="emailHelp"
                            required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="option_a" class="form-label">Option A</label>
                        <input type="text" id="option_a" class="form-control" name="option_a"
                            data-parsley-required="true" />
                    </div>
                    <div class="mb-3">
                        <label for="option_b" class="form-label">Option B</label>
                        <input type="text" id="option_b" class="form-control" name="option_b"
                            data-parsley-required="true" />
                    </div>
                    <div class="mb-3">
                        <label for="option_c" class="form-label">Option C</label>
                        <input type="text" id="option_c" class="form-control" name="option_c"
                            data-parsley-required="true" />
                    </div>
                    <div class="mb-3">
                        <label for="option_d" class="form-label">Option D</label>
                        <input type="text" id="option_d" class="form-control" name="option_d"
                            data-parsley-required="true" />
                    </div>
                    <div class="mb-3">
                        <label for="correct_answers" class="form-label">Correct Answers</label>
                        <input type="text" id="correct_answers" class="form-control" name="correct_answers"
                            data-parsley-required="true" />
                    </div>
                </div>
                <?php
                    if(isset($_GET['get_id_lesson'])){
                        $get_id_lesson = $_GET['get_id_lesson'];
                    }  
                ?>
                <input class="id_lesson" type="hidden" name="id_lesson" value="<?= $get_id_lesson; ?>">
                <input class="id_question" type="hidden" name="id_question">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary modal-btn" name="submit_question">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- edit question-->
<div class="modal text-gray-900" id="modalEditQuestion" tabindex="-1">
    <form action="../page/course/action_course.php" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Question</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Question Title</label>
                        <textarea class="form-control title" id="title" name="title" aria-describedby="emailHelp"
                            required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="option_a" class="form-label">Option A</label>
                        <input type="text" id="option_a" class="form-control option_a" name="option_a"
                            data-parsley-required="true" />
                    </div>
                    <div class="mb-3">
                        <label for="option_b" class="form-label">Option B</label>
                        <input type="text" id="option_b" class="form-control option_b" name="option_b"
                            data-parsley-required="true" />
                    </div>
                    <div class="mb-3">
                        <label for="option_c" class="form-label">Option C</label>
                        <input type="text" id="option_c" class="form-control option_c" name="option_c"
                            data-parsley-required="true" />
                    </div>
                    <div class="mb-3">
                        <label for="option_d" class="form-label">Option D</label>
                        <input type="text" id="option_d" class="form-control option_d" name="option_d"
                            data-parsley-required="true" />
                    </div>
                    <div class="mb-3">
                        <label for="correct_answers" class="form-label">Correct Answers</label>
                        <input type="text" id="correct_answers" class="form-control correct_answers"
                            name="correct_answers" data-parsley-required="true" />
                    </div>
                    <input class="id_question" type="hidden" name="id_question">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary modal-btn" name="update_question">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- delete question -->
<div class="modal text-gray-900" id="modalDeleteQuestion" tabindex="-1">
    <form action="../page/course/action_course.php" method="POST" class="modal-form" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Question</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this question <b class="title"></b>?</p>

                </div>
                <input type="hidden" class="id_question" name="id_question">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger modal-btn" name="delete_question">Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>