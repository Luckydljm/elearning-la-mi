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

<section class="my-courses-area my-5">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4 g-5">
            <?php
            $id = $_SESSION['id_users'] ?? '';
            $select_enrol = $conn->prepare("SELECT * FROM `enrol` WHERE id_users = ?");
            $select_enrol->execute([$id]);
            if($select_enrol->rowCount() > 0){
                while($fetch_enrol = $select_enrol->fetch(PDO::FETCH_ASSOC)){
                    $course_id = $fetch_enrol['id_course'];
                    $select_course = $conn->prepare("SELECT * FROM `course`, `instructors` WHERE status = 'active' && course.id_instructor = instructors.id_instructor && id_course = ? ORDER BY date_added DESC");
                    $select_course->execute([$course_id]);
                    if($select_course->rowCount() > 0){
                        while($fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)){
                            $id_course = $fetch_course['id_course'];
                            $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE id_course = ?");
                            $select_likes->execute([$id_course]);
                            $total_likes = $select_likes->rowCount();  
                
                            $verify_likes = $conn->prepare("SELECT * FROM `likes` WHERE id_users = ? AND id_course = ?");
                            $verify_likes->execute([$id, $id_course]);
            ?>
            <div class="col">
                <div class="card h-100 shadow">
                    <img src="../uploaded_thumbnail/<?= $fetch_course['thumbnail']; ?>" class="card-img-top"
                        alt="Thumbnail">
                    <div class="card-body">
                        <small style="font-style: italic;">
                            <p class="card-text text-primary mb-2"><?= $fetch_course['first_name']; ?>
                                <?= $fetch_course['last_name']; ?>
                            </p>
                        </small>
                        <h5 class="card-title"><?= $fetch_course['title']; ?></h5>
                        <p class="card-text"><i class="icon dripicons dripicons-heart"
                                style="font-size: 12px;margin-right:10px"></i><?= $total_likes; ?> Likes
                        </p>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="?user=course&get_id=<?= $course_id; ?>" class="btn btn-warning"><i
                                class="icon dripicons dripicons-information" style="font-size: 12px;"></i></a>
                        <form action="../page_user/course/action_course.php" method="post">
                            <input type="hidden" name="id_course" value="<?= $id_course; ?>">
                            <?php
                                if($verify_likes->rowCount() > 0){
                            ?>
                            <button type="submit" name="like_course" class="btn btn-danger"><i
                                    class="bi bi-heart-fill"></i></button>
                            <?php
                                }else{
                                ?>
                            <button type="submit" name="like_course" class="btn btn-danger"><i
                                    class="bi bi-heart"></i></button>
                            <?php
                                }
                            ?>
                        </form>
                        <a href="?user=discuss&get_id=<?= $course_id; ?>" class="btn btn-secondary"><i
                                class="bi bi-chat-dots"></i></a>
                        <a href="?user=lesson&get_id=<?= $course_id; ?>" class="btn btn-primary"><i
                                class="icon dripicons dripicons-media-play" style="font-size: 12px;"></i></a>
                    </div>
                </div>
            </div>
            <?php
                } } } }
            ?>
        </div>
    </div>
</section>