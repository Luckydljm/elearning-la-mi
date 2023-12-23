<section class="course-header-area">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="course-header-wrap">
                    <?php
                    if(isset($_GET['get_id'])){
                        $get_id = $_GET['get_id'];
                    }
                    $select_course = $conn->prepare("SELECT * FROM `course`, `instructors`, `sub_category` WHERE course.id_instructor = instructors.id_instructor && course.id_sub_category = sub_category.id_sub_category && id_course = ?");
                    $select_course->execute([$get_id]);
                    if($select_course->rowCount() > 0){
                        while($fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)){
                            $id_course = $fetch_course['id_course'];
                            $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE id_course = ?");
                            $select_likes->execute([$id_course]);
                            $total_likes = $select_likes->rowCount();  
                            
                    ?>
                    <h1 class="title"><?= $fetch_course['title']; ?></h1>
                    <p class="subtitle"><?= $fetch_course['short_desc']; ?></p>
                    <div class="rating-row">
                        <span
                            class="course-badge badge rounded-pill text-bg-warning"><?= $fetch_course['name_sub']; ?></span>
                        <i class="bi bi-heart-fill text-danger fs-5"></i>
                        (<?= $total_likes; ?> Likes)</span>
                        <span class="enrolled-num mx-3">
                            <?php
                            $select_enrol = $conn->prepare("SELECT * FROM `enrol` WHERE id_course = ?");
                            $select_enrol->execute([$get_id]);
                            $total_enrol =  $select_enrol->rowCount();
                            ?>
                            <?= $total_enrol; ?> Employees Enrolled
                        </span>
                        <span class="last-updated-date"><i class="bi bi-clock fs-5" style="margin-right: 5px;"></i>
                            <?= $fetch_course['start_date']; ?> s/d <?= $fetch_course['end_date']; ?></span>
                    </div>
                    <div class="created-row mb-1">
                        <span class="created-by">
                            Created by
                            <a href=""><?= $fetch_course['first_name']; ?>
                                <?= $fetch_course['last_name']; ?></a>
                        </span>
                        <?php if ($fetch_course['last_modified'] > 0): ?>
                        <span class="last-updated-date">Last Updated
                            <?= $fetch_course['last_modified']; ?></span>
                        <?php else: ?>
                        <span class="last-updated-date">Last Updated
                            <?= $fetch_course['date_added']; ?></span>
                        <?php endif; ?>
                    </div>
                    <?php
                                        }
                                        }
                                    ?>
                </div>
            </div>
            <div class="col-lg-4">

            </div>
        </div>
    </div>
</section>


<section class="course-content-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php
                    $select_courses = $conn->prepare("SELECT * FROM `course`, `instructors` WHERE course.id_instructor = instructors.id_instructor && id_course = ?");
                    $select_courses->execute([$get_id]);
                    if($select_courses->rowCount() > 0){
                        while($fetch_courses = $select_courses->fetch(PDO::FETCH_ASSOC)){
                            $instructor_id = $fetch_courses['id_instructor'];
                    ?>
                <div class="what-you-get-box">
                    <div class="what-you-get-title">What Will I Learn?</div>
                    <ul>
                        <li><i class="bi bi-check-lg"
                                style="margin-right:1rem; font-size:1.5rem;"></i><?= $fetch_courses['outcomes']; ?>
                        </li>
                    </ul>
                </div>
                <br>
                <div class="course-curriculum-box">
                    <div class="course-curriculum-title d-flex justify-content-between">
                        <div class="title">Curriculum For This Course</div>
                        <div class="total">
                            <span class="total-lectures">
                                <?php
                                $select_lesson = $conn->prepare("SELECT * FROM `lesson` WHERE id_course = ?");
                                $select_lesson->execute([$get_id]);
                                $total_lesson =  $select_lesson->rowCount();
                                ?>
                                <?= $total_lesson; ?> Lessons
                            </span>
                        </div>
                    </div>
                    <div class="course-curriculum-accordion">
                        <?php
                        $counter = 0;
                        $select_section = $conn->prepare("SELECT * FROM `section` WHERE id_course = ?");
                        $select_section->execute([$get_id]);
                        if($select_section->rowCount() > 0){
                            while($fetch_section = $select_section->fetch(PDO::FETCH_ASSOC)){
                                $section_id = $fetch_section['id_section'];
                        ?>
                        <div class="lecture-group-wrapper">
                            <div class="lecture-group-title d-flex justify-content-between" data-toggle="collapse"
                                data-target="#collapse<?= $section_id; ?>"
                                aria-expanded="<?php if($counter == 0) echo 'true'; else echo 'false' ; ?>">
                                <div class="title">
                                    <?php if($counter == 0) :?>
                                    <i class="bi bi-dash-lg" style="margin-right:0.5rem;"></i>
                                    <?php else: ?>
                                    <i class="bi bi-plus-lg" style="margin-right:0.5rem;"></i>
                                    <?php endif; ?>
                                    <?= $fetch_section['title']; ?>
                                </div>
                                <div class="total">
                                    <span class="total-lectures">
                                        <?php
                                        $select_lessons = $conn->prepare("SELECT * FROM `lesson` WHERE id_section = ?");
                                        $select_lessons->execute([$section_id]);
                                        $total_lessons =  $select_lessons->rowCount();
                                        ?>
                                        <?= $total_lessons; ?> Lessons
                                    </span>
                                </div>
                            </div>

                            <div id="collapse<?= $section_id; ?>"
                                class="lecture-list collapse <?php if($counter == 0) echo 'show'; ?>">
                                <ul>
                                    <?php
                                    $select_lesson = $conn->prepare("SELECT * FROM `lesson` WHERE id_section = ?");
                                    $select_lesson->execute([$section_id]);
                                    if($select_lesson->rowCount() > 0){
                                        while($fetch_lesson = $select_lesson->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                    <li class="lecture has-preview d-flex justify-content-between">
                                        <span class="lecture-title"><i class="bi bi-play-circle-fill"
                                                style="margin-right:0.5rem"></i><?= $fetch_lesson['title']; ?></span>
                                        <span class="lecture-time"><?= $fetch_lesson['duration']; ?></span>
                                    </li>
                                    <?php
                                        }
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                            $counter++;
                            }
                            }
                        ?>
                    </div>
                </div>

                <div class="requirements-box">
                    <div class="requirements-title">Requirements</div>
                    <div class="requirements-content">
                        <ul class="requirements__list">
                            <li><?= $fetch_courses['requirements']; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="description-box view-more-parent">
                    <div class="description-title">Description</div>
                    <div class="description-content-wrap">
                        <div class="description-content">
                            <?= $fetch_courses['description']; ?>
                        </div>
                    </div>
                </div>

                <div class="about-instructor-box">
                    <div class="about-instructor-title">
                        About The Instructor
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="about-instructor-image">
                                <img src="../uploaded_profile/<?= $fetch_courses['photo']; ?>" alt="" class="img-fluid">
                                <b><?= $fetch_courses['first_name']; ?> <?= $fetch_courses['last_name']; ?></b>
                                <ul>
                                    <li><i class="bi bi-play-circle-fill fs-5" style="margin-right:0.5rem"></i><b>
                                            <?php
                                            $select_course = $conn->prepare("SELECT * FROM `course` WHERE id_instructor = ?");
                                            $select_course->execute([$instructor_id]);
                                            $total_course =  $select_course->rowCount();
                                            if($select_course->rowCount() > 0){
                                                while($fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)){
                                                    $course_id = $fetch_course['id_course'];
                                                    $select_employee = $conn->prepare("SELECT * FROM `enrol` WHERE id_course = ?");
                                                    $select_employee->execute([$course_id]);
                                                    $total_employee =  $select_employee->rowCount();
                                            }
                                            }
                                            ?>
                                            <?= $total_course; ?> </b> Courses</li>
                                    <li><i class="bi bi-person-fill fs-5" style="margin-right:0.5rem;"></i></i><b>
                                            <?= $total_employee; ?> </b> Employee</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="course-sidebar natural">
                    <div class="preview-video-box">
                        <img src="../uploaded_thumbnail/<?= $fetch_courses['thumbnail']; ?>" alt="" class="img-fluid">
                    </div>
                    <div class="course-sidebar-text-box">
                        <?php
                            $id = $_SESSION['id_users'] ?? '';
                            $select_enrol = $conn->prepare("SELECT * FROM `enrol` WHERE id_course = ? && id_users = ?");
                            $select_enrol->execute([$get_id, $id]);
                            if($select_enrol->rowCount() > 0){
                                while($fetch_enrol = $select_enrol->fetch(PDO::FETCH_ASSOC)){
                                    $users_id = $fetch_enrol['id_users'];
                        ?>
                        <div class="already_purchased">
                            <a href="?user=mycourse">You Have Enrolled</a>
                        </div>

                        <?php }}?>
                        <?php if($users_id != $id) : ?>
                        <div class="buy-btns">
                            <a href="#" class="btn btn-buy-now">You Don't Have Access</a>
                        </div>
                        <?php endif;?>

                        <div class="includes">
                            <div class="title"><b>Includes:</b></div>
                            <ul>
                                <?php
                                    $select_lesson = $conn->prepare("SELECT * FROM `lesson` WHERE id_course = ?");
                                    $select_lesson->execute([$get_id]);
                                    $total_lessons =  $select_lesson->rowCount();
                                ?>
                                <li><i class="bi bi-file-earmark-pdf"
                                        style="margin-right:0.5rem;"></i><?= $total_lessons; ?> Lessons
                                </li>
                                <li><i class="bi bi-hdd-network" style="margin-right:0.5rem;"></i></i>Employee Only</li>
                                <li><i class="bi bi-phone" style="margin-right:0.5rem;"></i>Access on Mobile & Computer
                                </li>
                            </ul>
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
</section>