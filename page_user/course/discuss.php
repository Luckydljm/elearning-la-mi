<?php 

    session_start();

    if(isset($_COOKIE['id_users'])){
        $id_users = $_COOKIE['id_users'];
     }else{
        $id_users = '';
        header('location:../../index.php');
     }

if(isset($_POST['send'])){
   
    $discuss = $_POST['discuss'];
    $discuss = filter_var($discuss, FILTER_SANITIZE_STRING);
    $id_course = $_POST['id_course'];
    $id_course = filter_var($id_course, FILTER_SANITIZE_STRING);

    $select_course = $conn->prepare("SELECT * FROM `course` WHERE id_course = ? LIMIT 1");
    $select_course->execute([$id_course]);
    $fetch_course = $select_course->fetch(PDO::FETCH_ASSOC);

    $id_instructor = $fetch_course['id_instructor'];

    if($select_course->rowCount() > 0){
          $insert_discuss = $conn->prepare("INSERT INTO `discuss`(id_course, id_users, id_instructor, discuss) VALUES(?,?,?,?)");
          $insert_discuss->execute([$id_course, $id_users, $id_instructor, $discuss]);

    }

}

?>

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

                <section class="section mt-3">
                    <div class="row">
                        <div class="col">
                            <div class="card shadow">
                                <div class="card-header">
                                    <div class="media d-flex align-items-center">
                                        <div class="avatar me-3">
                                            <img src="../uploaded_thumbnail/<?= $fetch_courses['thumbnail']; ?>" alt=""
                                                srcset="" />
                                            <span class="avatar-status bg-success"></span>
                                        </div>
                                        <div class="name flex-grow-1">
                                            <h6 class="mb-0">Discussion Forum</h6>
                                            <span class="text-xs">Online</span>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body pt-4 bg-grey">
                                    <?php
                                        $id = $_SESSION['id_users'] ?? '';
                                        $select_discuss = $conn->prepare("SELECT * FROM `discuss`, `users` WHERE discuss.id_users = users.id_users && id_course = ? ORDER BY id_discuss ASC");
                                        $select_discuss->execute([$get_id]);
                                        if($select_discuss->rowCount() > 0){
                                            while($fetch_discuss = $select_discuss->fetch(PDO::FETCH_ASSOC)){   
                                            $select_users = $conn->prepare("SELECT * FROM `users` WHERE id_users = ?");
                                            $select_users->execute([$fetch_discuss['id_users']]);
                                            $fetch_users = $select_users->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <div class="chat-content">
                                        <?php if($fetch_discuss['id_users'] == $id) : ?>
                                        <div class="chat">
                                            <div class="chat-body d-flex flex-column align-items-end">
                                                <div class="profile d-flex justify-content-between mb-1">
                                                    <img src="../uploaded_profile/<?= $fetch_discuss['photo']; ?>"
                                                        alt="" class="avatar avatar-sm" width="35"
                                                        style="margin-right: 0.5rem;" />
                                                    <div class="info d-flex flex-column">
                                                        <small><?= $fetch_discuss['first_name']; ?>
                                                            <?= $fetch_discuss['last_name']; ?>
                                                        </small>
                                                        <small
                                                            style="font-size: 0.6rem;"><?= $fetch_discuss['date']; ?></small>
                                                    </div>
                                                </div>
                                                <div class="chat-message" style="max-width:1rem">
                                                    <?= $fetch_discuss['discuss']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php else: ?>
                                        <div class="chat chat-left">
                                            <div class="chat-body d-flex flex-column align-items-start">
                                                <div class="profile d-flex justify-content-between mb-1">
                                                    <img src="../uploaded_profile/<?= $fetch_discuss['photo']; ?>"
                                                        alt="" class="avatar avatar-sm" width="35"
                                                        style="margin-right: 0.5rem;" />
                                                    <div class="info d-flex flex-column">
                                                        <small><?= $fetch_discuss['first_name']; ?>
                                                            <?= $fetch_discuss['last_name']; ?>
                                                        </small>
                                                        <small
                                                            style="font-size: 0.6rem;"><?= $fetch_discuss['date']; ?></small>
                                                    </div>
                                                </div>
                                                <div class="chat-message" style="max-width:1rem">
                                                    <?= $fetch_discuss['discuss']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                        } }
                                    ?>
                                </div>
                                <div class="card-footer">
                                    <form action="" method="post">
                                        <div class="message-form d-flex flex-direction-column align-items-center">
                                            <div class="d-flex flex-grow-1 ml-4">
                                                <input class="id_course" type="hidden" name="id_course"
                                                    value="<?= $get_id; ?>">
                                                <!-- <input class="id_users" type="hidden" name="id_users"
                                                    value="<?= $id; ?>"> -->
                                                <textarea name="discuss" class="form-control" id="" rows="1"
                                                    placeholder="Type your message.."></textarea>
                                                <button class="btn btn-primary" style="margin-left: 0.5rem;"
                                                    type="submit" name="send"><i class="bi bi-send"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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
                                        style="margin-right:0.5rem;"></i><?= $total_lessons; ?>
                                    Lessons
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