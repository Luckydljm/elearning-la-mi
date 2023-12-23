<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h2>Discussion Forum</h2>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="?page=discuss">Discuss</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Discussion Forum</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-start">
                <div class="mx-3 fs-5"><i class="bi bi-chat-square-text"></i></div>
                <?php
                    if(isset($_GET['get_id'])){
                        $get_id = $_GET['get_id'];
                    }
                    $select_course = $conn->prepare("SELECT * FROM `course` WHERE id_course = ?");
                    $select_course->execute([$get_id]);
                    $fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)
                ?>
                <div class="fs-5">Discussion Forum : <?= $fetch_course['title']; ?></div>
            </div>
        </div>

        <?php
            $select_courses = $conn->prepare("SELECT * FROM `course` WHERE id_course = ?");
            $select_courses->execute([$get_id]);
            if($select_courses->rowCount() > 0){
                while($fetch_courses = $select_courses->fetch(PDO::FETCH_ASSOC)){
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
                                        $select_discuss = $conn->prepare("SELECT * FROM `discuss`, `users` WHERE discuss.id_users = users.id_users &&id_course = ? ORDER BY id_discuss ASC");
                                        $select_discuss->execute([$get_id]);
                                        if($select_discuss->rowCount() > 0){
                                            while($fetch_discuss = $select_discuss->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                            <div class="chat-content">
                                <div class="chat chat-left">
                                    <div class="chat-body d-flex flex-column align-items-start">
                                        <div class="profile d-flex justify-content-between mb-1">
                                            <img src="../uploaded_profile/<?= $fetch_discuss['photo']; ?>" alt=""
                                                class="avatar avatar-sm" width="35" style="margin-right: 0.5rem;" />
                                            <div class="info d-flex flex-column">
                                                <small><?= $fetch_discuss['first_name']; ?>
                                                    <?= $fetch_discuss['last_name']; ?>
                                                </small>
                                                <small style="font-size: 0.6rem;"><?= $fetch_discuss['date']; ?></small>
                                            </div>
                                        </div>
                                        <div class="chat-message" style="max-width:1rem">
                                            <?= $fetch_discuss['discuss']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                        } }
                                    ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
            } }
        ?>
    </section>
</div>