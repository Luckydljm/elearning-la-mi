<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <?php
                if(isset($_GET['get_id'])){
                    $get_id = $_GET['get_id'];
                }
                $select_course = $conn->prepare("SELECT * FROM `course` WHERE id_course = ?");
                $select_course->execute([$get_id]);
                if($select_course->rowCount() > 0){
                    while($fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)){         
                ?>
            <div class="text-center" style="margin-top: 10px;">
                <h4><?= $fetch_course['title']; ?></h4>
            </div>
            <div class="accordion" id="accordionExample">
                <?php
                    $section_counter = 0;
                    $select_section = $conn->prepare("SELECT * FROM `section` WHERE id_course = ?");
                    $select_section->execute([$get_id]);
                    if($select_section->rowCount() > 0){
                        while($fetch_section = $select_section->fetch(PDO::FETCH_ASSOC)){
                            $section_id = $fetch_section['id_section'];
                            $section_counter++;
                ?>
                <div class="accordion-item border shadow mb-3">
                    <h5 class="accordion-header">
                        <button class="accordion-button d-flex flex-column text-center" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse-<?= $section_id; ?>"
                            aria-expanded="true" aria-controls="collapse-<?= $section_id; ?>">
                            <h6 style="color: #686f7a; font-size: 15px;">Section <?= $section_counter;?></h6>
                            <?= $fetch_section['title']; ?>
                        </button>
                    </h5>
                    <div id="collapse-<?= $section_id; ?>" class="accordion-collapse collapse"
                        data-bs-parent="#accordionExample">
                        <?php
                            $select_lesson = $conn->prepare("SELECT * FROM `lesson` WHERE id_section = ?");
                            $select_lesson->execute([$section_id]);
                            if($select_lesson->rowCount() > 0){
                                while($fetch_lesson = $select_lesson->fetch(PDO::FETCH_ASSOC)){
                                    $lesson_id = $fetch_lesson['id_lesson'];
                        ?>
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-1">
                                    <a href="?user=lesson&get_id=<?= $get_id; ?>&get_id_lesson=<?= $lesson_id; ?>"
                                        id="<?= $lesson_id; ?>">
                                        <i class="bi bi-play-fill fs-5" style="font-size: 12px;color: #909090;"></i>
                                    </a>
                                </div>
                                <div class="col-8">
                                    <a href="?user=lesson&get_id=<?= $get_id; ?>&get_id_lesson=<?= $lesson_id; ?>"
                                        id="<?= $lesson_id; ?>">
                                        <?php if ($fetch_lesson['lesson_type'] != 'video-url' && $fetch_lesson['lesson_type'] != 'quiz'):?>
                                        <?= $fetch_lesson['title']; ?> <i class="icon dripicons dripicons-paperclip"
                                            style="font-size: 12px; margin-right: 0.5rem;"></i>
                                        <?php else: ?>
                                        <?= $fetch_lesson['title']; ?>
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <div class="col-3">
                                    <span class="lesson_duration">
                                        <?php if ($fetch_lesson['lesson_type'] == 'video-url' || $fetch_lesson['lesson_type'] == '' || $fetch_lesson['lesson_type'] == NULL): ?>
                                        <?= $fetch_lesson['duration']; ?>
                                        <?php elseif($fetch_lesson['lesson_type'] == 'quiz'): ?>
                                        <i class="bi bi-question-circle"></i>
                                        <?php else:
                                                        $tmp           = explode('.', $fetch_lesson['attachment']);
                                                        $fileExtension = strtolower(end($tmp));?>

                                        <?php if ($fileExtension == 'jpg' || $fileExtension == 'jpeg' || $fileExtension == 'png' || $fileExtension == 'bmp' || $fileExtension == 'svg'): ?>
                                        <i class="bi bi-camera"></i>
                                        <?php elseif($fileExtension == 'pdf'): ?>
                                        <i class="bi bi-file-earmark-pdf"></i>
                                        <?php elseif($fileExtension == 'doc' || $fileExtension == 'docx'): ?>
                                        <i class="bi bi-file-earmark-word"></i>
                                        <?php elseif($fileExtension == 'txt'): ?>
                                        <i class="bi bi-file-earmark-text"></i>
                                        <?php else: ?>
                                        <i class="bi bi-file-earmark-ruled"></i>
                                        <?php endif; ?>

                                        <?php endif; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php
                            } }
                        ?>
                    </div>
                </div>
                <?php
                    } }
                ?>
            </div>
            <?php
                } }
            ?>
        </div>
        <div class="col-lg-9" id="video_player_area">
            <?php
                if(isset($_GET['get_id_lesson'])){
                    $get_id_lesson = $_GET['get_id_lesson'];
                }
                    $select_lesson = $conn->prepare("SELECT * FROM `lesson` WHERE id_lesson = ?");
                    $select_lesson->execute([$get_id_lesson]);
                    if($select_lesson->rowCount() > 0){
                        while($fetch_lesson = $select_lesson->fetch(PDO::FETCH_ASSOC)){
                            $video_url = $fetch_lesson['video_url'];
            ?>
            <div class="text-center">
                <?php if($fetch_lesson['lesson_type'] == 'video-url' || $fetch_lesson['lesson_type'] == '' || $fetch_lesson['lesson_type'] == NULL): ?>
                <div class="mt-5">
                    <a href="<?= $video_url; ?>" target="_blank" class="btn btn-danger">
                        <i class="bi bi-play-btn-fill" style="font-size: 20px;"></i> Watch
                        <?= $fetch_lesson['title']; ?>
                    </a>
                </div>
                <?php elseif ($fetch_lesson['lesson_type'] == 'quiz'): ?>
                <div class="mt-5">
                    <div class="" style="margin: 20px 0;" id="lesson-summary">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?= $fetch_lesson['lesson_type'] == 'quiz' ? "Instruction" : "Note"; ?>:
                                </h5>
                                <?php if ($fetch_lesson['summary'] == ""): ?>
                                <p class="card-text">
                                    <?= $fetch_lesson['lesson_type'] == 'quiz' ? "No Instruction Found" : "No Summary Found"; ?>
                                </p>
                                <?php else: ?>
                                <p class="card-text"><?= $fetch_lesson['summary']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php include 'quiz_view.php'; ?>
                </div>
                <?php else: ?>
                <div class="mt-5">
                    <a href="../uploaded_attachment/<?= $fetch_lesson['attachment']; ?>" class="btn btn-primary"
                        download>
                        <i class="bi bi-cloud-arrow-down-fill" style="font-size: 20px;"></i> Download
                        <?= $fetch_lesson['title']; ?>
                    </a>
                </div>
                <?php endif;?>
            </div>

            <?php if ($fetch_lesson['lesson_type'] != 'quiz'): ?>
            <div class="" style="margin: 20px 0;" id="lesson-summary">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $fetch_lesson['lesson_type'] == 'quiz' ? "Instruction" : "Note"; ?>:
                        </h5>
                        <?php if ($fetch_lesson['summary'] == ""): ?>
                        <p class="card-text">
                            <?= $fetch_lesson['lesson_type'] == 'quiz' ? "No Instruction Found" : "No Summary Found"; ?>
                        </p>
                        <?php else: ?>
                        <p class="card-text"><?= $fetch_lesson['summary']; ?></p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            <?php endif;?>
            <?php
                } }
            ?>
        </div>
    </div>
</div>