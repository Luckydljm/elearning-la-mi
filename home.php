<section class="home-banner-area">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <div class="home-banner-wrap">
                    <h2>Learn on Your Schedule</h2>
                    <p>Study any topic, anytime. Explore thousands of courses to become quality human resources!</p>
                    <form class="" action="" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="query"
                                placeholder="What Do You Want to Learn?">
                            <div class="input-group-append">
                                <button class="btn" type="submit"><i class="bi bi-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="home-fact-area">
    <div class="container-lg p-2">
        <div class="row">
            <div class="col-md-4 d-flex">
                <div class="home-fact-box d-flex justify-content-between">
                    <i class="bi bi-bullseye"></i>
                    <div class="text-box">
                        <?php
                        $select_course = $conn->prepare("SELECT * FROM `course`");
                        $select_course->execute();
                        $total_course =  $select_course->rowCount();
                        ?>
                        <h4><?= $total_course; ?> Online Courses</h4>
                        <p>Explore A Variety Of Fresh Topics</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="home-fact-box d-flex justify-content-between">
                    <i class="bi bi-check-circle-fill"></i></i>
                    <div class="text-box">
                        <h4>Expert Instruction</h4>
                        <p>Provide The Right Course For Your Position</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="home-fact-box d-flex justify-content-between">
                    <i class="bi bi-universal-access-circle"></i>
                    <div class="text-box">
                        <h4>Limited Access</h4>
                        <p>Specifically For Company Employees</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="course-carousel-area mb-5">
    <div class="container-lg">
        <h2 class="container-title mb-3">Latest Courses</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            $select_course = $conn->prepare("SELECT * FROM `course`, `instructors` WHERE status = 'active' && course.id_instructor = instructors.id_instructor ORDER BY date_added DESC");
            $select_course->execute();
            if($select_course->rowCount() > 0){
                while($fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)){
                    $course_id = $fetch_course['id_course'];
                    $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE id_course = ?");
                    $select_likes->execute([$course_id]);
                    $total_likes = $select_likes->rowCount();  
            ?>
            <div class="col">
                <a href="?user=course&get_id=<?= $course_id; ?>">
                    <div class="card h-100 shadow">
                        <img src="../uploaded_thumbnail/<?= $fetch_course['thumbnail']; ?>" class="card-img-top"
                            alt="Thumbnail">
                        <div class="card-body">
                            <small style="font-style: italic;">
                                <p class="card-text text-primary mb-2">Instruktur: <?= $fetch_course['first_name']; ?>
                                    <?= $fetch_course['last_name']; ?>
                                </p>
                            </small>
                            <h5 class="card-title"><?= $fetch_course['title']; ?></h5>
                            <p class="card-text"><?= $fetch_course['short_desc']; ?></p>
                            <div class="rating">
                                <i class="bi bi-heart-fill text-danger fs-5"></i>
                                <?= $total_likes; ?> Likes
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary"><i class="bi bi-clock fs-5"
                                    style="margin-right: 5px;"></i> <?= $fetch_course['start_date']; ?> s/d
                                <?= $fetch_course['end_date']; ?></small>
                        </div>
                    </div>
                </a>
            </div>
            <?php
                }
                }
            ?>
        </div>
    </div>
</section>