<div class="container-lg">
    <h2 class="container-title mt-4">Courses</h2>
    <div class="col-12">
        <nav aria-label="breadcrumb" class="breadcrumb-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="?user=home"><i class="bi bi-house-door-fill"></i></a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Courses</a>
                </li>
                <?php
                if(isset($_GET['get_id_sub'])){
                    $get_id_sub = $_GET['get_id_sub'];
                }
                    $select_sub_category = $conn->prepare("SELECT * FROM `sub_category` WHERE id_sub_category = ?");
                    $select_sub_category->execute([$get_id_sub]);
                    if($select_sub_category->rowCount() > 0){
                        while($fetch_sub_category = $select_sub_category->fetch(PDO::FETCH_ASSOC)){
                ?>
                <li class="breadcrumb-item active" aria-current="page"><?= $fetch_sub_category['name_sub']; ?></li>
                <?php
                    }
                    }
                ?>
            </ol>
        </nav>
    </div>
    <hr>
    <?php
        if(isset($_GET['get_id_sub'])){
            $get_id_sub = $_GET['get_id_sub'];
        }
        $select_course = $conn->prepare("SELECT * FROM `course`, `instructors` WHERE status = 'active' && course.id_instructor = instructors.id_instructor && id_sub_category = ? ORDER BY date_added DESC");
        $select_course->execute([$get_id_sub]);
        if($select_course->rowCount() > 0){
            while($fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)){
                $course_id = $fetch_course['id_course'];
                $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE id_course = ?");
                $select_likes->execute([$course_id]);
                $total_likes = $select_likes->rowCount(); 
    ?>
    <div class="row justify-content-center">
        <div class="card my-5 shadow" style="max-width: 55rem;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="../uploaded_thumbnail/<?= $fetch_course['thumbnail']; ?>" class="img-fluid rounded-start"
                        alt="Thumbnail" style="height: 100%;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <a href="?user=course&get_id=<?= $course_id; ?>">
                            <h5 class="card-title"><?= $fetch_course['title']; ?></h5>
                        </a>
                        <small style="font-style: italic;">
                            <p class="card-text text-primary mb-2"><?= $fetch_course['first_name']; ?>
                                <?= $fetch_course['last_name']; ?>
                            </p>
                        </small>
                        <p class="card-text"><?= $fetch_course['short_desc']; ?></p>
                        <div class="row">
                            <div class="col-6">
                                <p class="card-text"><small class="text-body-secondary"><i class="bi bi-clock fs-6"
                                            style="margin-right:0.1rem"></i>
                                        <?= $fetch_course['start_date']; ?> s/d
                                        <?= $fetch_course['end_date']; ?></small>
                                </p>
                            </div>
                            <div class="col-3">
                                <?php
                                $select_lesson = $conn->prepare("SELECT * FROM `lesson` WHERE id_course = ?");
                                $select_lesson->execute([$course_id]);
                                $total_lesson =  $select_lesson->rowCount();
                                ?>
                                <p class="card-text"><small class="text-body-secondary"><i
                                            class="bi bi-play-circle-fill fs-6"
                                            style="margin-right:0.3rem"></i><?= $total_lesson; ?> Lessons</small>
                                </p>
                            </div>
                            <div class="col-3">
                                <p class="card-text"><small class="text-body-secondary">
                                        <i class="bi bi-heart-fill text-danger fs-6"></i>
                                        <span class="d-inline-block average-rating">
                                            <?= $total_likes; ?></span></small>
                                </p>
                            </div>
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