<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h2>Discuss</h2>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="?page=dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Discuss</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-start">
                <div class="mx-3 fs-5"><i class="bi bi-stack"></i></div>
                <div class="fs-5">List Courses</div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            $id = $_SESSION['id_instructor'] ?? '';
            $select_course = $conn->prepare("SELECT * FROM `course` WHERE status = 'active' && id_instructor = ? ORDER BY date_added DESC");
            $select_course->execute([$id]);
            if($select_course->rowCount() > 0){
                while($fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)){
                    $course_id = $fetch_course['id_course'];
                    $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE id_course = ?");
                    $select_likes->execute([$course_id]);
                    $total_likes = $select_likes->rowCount(); 
            ?>
            <div class="col">
                <div class="card h-100 shadow">
                    <img src="../uploaded_thumbnail/<?= $fetch_course['thumbnail']; ?>" class="card-img-top"
                        alt="Thumbnail">
                    <div class="card-body">
                        <h5 class="card-title"><?= $fetch_course['title']; ?></h5>
                        <p class="card-text"><?= $fetch_course['short_desc']; ?></p>
                        <p class="card-text"><i class="icon dripicons dripicons-heart"
                                style="font-size: 12px;margin-right:10px"></i><?= $total_likes; ?> Likes
                        </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a href="?page=discuss_detail&get_id=<?= $course_id; ?>" class="btn btn-success w-75"><i
                                class="bi bi-chat-dots"></i> Discussion Forum</a>
                    </div>
                </div>
            </div>
            <?php
                } } 
            ?>
        </div>
    </section>
</div>