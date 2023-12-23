<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h2>Report</h2>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="?page=dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Report</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-start">
                <div class="mx-3 fs-5"><i class="bi bi-archive-fill"></i></div>
                <div class="fs-5">Course Results</div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3 header-title">Course Results</h5>
                        <table class="table table-striped text-gray-900" id="resultsTable">
                            <thead>
                                <tr style="font-size: 0.9rem;">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Quiz Name</th>
                                    <th>Total Questions</th>
                                    <th>Correct Answers</th>
                                    <th>Score</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <!-- List for Admin -->
                            <?php
                                if ($_SESSION['user_type']=="admin" || $_SESSION['user_type']=="direktur"){
                            ?>
                            <tbody>
                                <?php
                                    $no = 0;
                                    $select_users = $conn->prepare("SELECT * FROM `users`");
                                    $select_users->execute();
                                    if($select_users->rowCount() > 0){
                                        while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
                                        $users_id = $fetch_users['id_users'];
                                        $select_lesson = $conn->prepare("SELECT * FROM `lesson` WHERE lesson_type = 'quiz'");
                                        $select_lesson->execute();
                                        if($select_lesson->rowCount() > 0){
                                            while($fetch_lesson = $select_lesson->fetch(PDO::FETCH_ASSOC)){
                                            $lesson_id = $fetch_lesson['id_lesson'];
                                            $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_lesson = ?");
                                            $select_question->execute([$lesson_id]);
                                            $total_question = $select_question->rowCount();
                                            $select_results = $conn->prepare("SELECT * FROM `results` WHERE results = 'True' && id_lesson = ? && id_users = ?");
                                            $select_results->execute([$lesson_id, $users_id]);
                                            $total_results = $select_results->rowCount();
                                            $score = $total_results * 20;
                                            $no++;
                                ?>
                                <tr style="font-size: 0.8rem;">
                                    <td><?= $no; ?></td>
                                    <td>
                                        <strong><a href="#"><?= $fetch_users['first_name']; ?>
                                                <?= $fetch_users['last_name']; ?></a></strong><br>
                                        <small class="text-muted">Position: <?= $fetch_users['position']; ?></small>
                                    </td>

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
                                    }}}}
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
                                $select_course = $conn->prepare("SELECT * FROM `course` WHERE id_instructor = ? ");
                                $select_course->execute([$id]);
                                if($select_course->rowCount() > 0){
                                    while($fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)){
                                        $id_course = $fetch_course['id_course'];
                                        $select_users = $conn->prepare("SELECT * FROM `users`");
                                        $select_users->execute();
                                        if($select_users->rowCount() > 0){
                                            while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
                                            $users_id = $fetch_users['id_users'];
                                            $select_lesson = $conn->prepare("SELECT * FROM `lesson` WHERE lesson_type = 'quiz' && id_course = ?");
                                            $select_lesson->execute([$id_course]);
                                            if($select_lesson->rowCount() > 0){
                                                while($fetch_lesson = $select_lesson->fetch(PDO::FETCH_ASSOC)){
                                                $lesson_id = $fetch_lesson['id_lesson'];
                                                $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_lesson = ?");
                                                $select_question->execute([$lesson_id]);
                                                $total_question = $select_question->rowCount();
                                                $select_results = $conn->prepare("SELECT * FROM `results` WHERE results = 'True' && id_lesson = ? && id_users = ?");
                                                $select_results->execute([$lesson_id, $users_id]);
                                                $total_results = $select_results->rowCount();
                                                $score = $total_results * 20;
                                                $no++;
                                ?>
                                <tr style="font-size: 0.8rem;">
                                    <td><?= $no; ?></td>
                                    <td>
                                        <strong><a href="#"><?= $fetch_users['first_name']; ?>
                                                <?= $fetch_users['last_name']; ?></a></strong><br>
                                        <small class="text-muted">Position: <?= $fetch_users['position']; ?></small>
                                    </td>
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
                                <?php } } } } } } } ?>
                            </tbody>
                            <!-- End List for Instruktur -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>