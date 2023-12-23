<section class="page-header-area my-course-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title">My Course</h1>
                <ul>
                    <li class="<?php $p = $_GET['user']; if($p=='mycourse'){echo "active";} ?>"><a
                            href="?user=mycourse">All Courses</a>
                    </li>
                    <li class="<?php $p = $_GET['user']; if($p=='results'){echo "active";} ?>"><a
                            href="?user=results">Results</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="my-courses-area my-5">
    <div class="container">
        <div class="row mt-4">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3 header-title">Quiz Results</h5>
                        <table class="table table-striped text-gray-900" id="resultsTable">
                            <thead>
                                <tr style="font-size: 0.9rem;">
                                    <th>#</th>
                                    <th>Quiz Name</th>
                                    <th>Total Questions</th>
                                    <th>Correct Answers</th>
                                    <th>Score</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 0;
                                    $id = $_SESSION['id_users'] ?? '';
                                    $select_enrol = $conn->prepare("SELECT * FROM `enrol` WHERE id_users = ?");
                                    $select_enrol->execute([$id]);
                                    if($select_enrol->rowCount() > 0){
                                        while($fetch_enrol = $select_enrol->fetch(PDO::FETCH_ASSOC)){
                                            $course_id = $fetch_enrol['id_course'];
                                            $select_course = $conn->prepare("SELECT * FROM `course` WHERE status = 'active' && id_course = ?");
                                            $select_course->execute([$course_id]);
                                            if($select_course->rowCount() > 0){
                                                while($fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)){
                                                    $id_course = $fetch_course['id_course'];
                                                    $select_lesson = $conn->prepare("SELECT * FROM `lesson` WHERE lesson_type = 'quiz' && id_course = ?");
                                                    $select_lesson->execute([$id_course]);
                                                    if($select_lesson->rowCount() > 0){
                                                    while($fetch_lesson = $select_lesson->fetch(PDO::FETCH_ASSOC)){
                                                        $lesson_id = $fetch_lesson['id_lesson'];
                                                        $no++;
                                                        $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_lesson = ?");
                                                        $select_question->execute([$lesson_id]);
                                                        $total_question = $select_question->rowCount();
                                                        $select_results = $conn->prepare("SELECT * FROM `results` WHERE results = 'True' && id_lesson = ? && id_users = ?");
                                                        $select_results->execute([$lesson_id, $id]);
                                                        $total_results = $select_results->rowCount();
                                                        $score = $total_results * 20;
                                ?>
                                <tr style="font-size: 0.8rem;">
                                    <td><?= $no; ?></td>
                                    <td>
                                        <strong><a href="#"><?= $fetch_lesson['title']; ?></a></strong>
                                    </td>
                                    <td>
                                        <small class="text-muted"><?= $total_question; ?></small>
                                    </td>
                                    <td>
                                        <small class="text-muted"><?= $total_results; ?></small>
                                    </td>
                                    <td>
                                        <?php if ($score > 69): ?>
                                        <span class="text-success fw-bold"><?= $score; ?></span>
                                        <?php else: ?>
                                        <span class="text-danger fw-bold"><?= $score; ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($score > 69): ?>
                                        <span class="badge text-bg-success">Lulus</span>
                                        <?php else: ?>
                                        <span class="badge text-bg-danger">Tidak Lulus</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                                    }}}}}}
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>