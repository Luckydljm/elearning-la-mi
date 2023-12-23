<div class="page-heading">
    <h2>Dashboard</h2>
</div>
<div class="page-content">
    <?php
    if (isset($_SESSION['sukses'])) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Hello <?php echo $_SESSION['first_name']; ?>!</strong> <?= $_SESSION['sukses']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        unset($_SESSION['sukses']);
    }
    ?>

    <!-- Dashboard Instruktur -->
    <?php
	    if ($_SESSION['user_type']=="instruktur"){
	?>
    <div class="row">
        <div class="col-6 col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon purple mb-2">
                                <i class="icon dripicons dripicons-network-3"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Categories</h6>
                            <?php
                            $id = $_SESSION['id_instructor'] ?? '';
                            $select_categories = $conn->prepare("SELECT * FROM `category` WHERE id_instructor = ? ");
                            $select_categories->execute([$id]);
                            $total_categories =  $select_categories->rowCount();
                            ?>
                            <h6 class="font-extrabold mb-0"><?= $total_categories; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon blue mb-2">
                                <i class="icon dripicons dripicons-archive"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Course</h6>
                            <?php
                            $id = $_SESSION['id_instructor'] ?? '';
                            $select_course = $conn->prepare("SELECT * FROM `course` WHERE id_instructor = ? ");
                            $select_course->execute([$id]);
                            $total_course =  $select_course->rowCount();
                            ?>
                            <h6 class="font-extrabold mb-0"><?= $total_course; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon green mb-2">
                                <i class="icon dripicons dripicons-user-group"></i>
                            </div>
                        </div>
                        <div class=" col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Enrolled Employee</h6>
                            <?php
                            $id = $_SESSION['id_instructor'] ?? '';
                            $select_enrol = $conn->prepare("SELECT * FROM `enrol`, `course` WHERE enrol.id_course = course.id_course && id_instructor = ?");
                            $select_enrol->execute([$id]);
                            $total_enrol =  $select_enrol->rowCount();
                            ?>
                            <h6 class="font-extrabold mb-0"><?= $total_enrol; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- Dashboard Admin -->
    <?php
	    if ($_SESSION['user_type']=="admin" || $_SESSION['user_type']=="direktur"){
	?>
    <div class="row">
        <div class="col-6 col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon purple mb-2">
                                <i class="icon dripicons dripicons-network-3"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Categories</h6>
                            <?php
                            $select_categories = $conn->prepare("SELECT * FROM `category`");
                            $select_categories->execute();
                            $total_categories =  $select_categories->rowCount();
                            ?>
                            <h6 class="font-extrabold mb-0"><?= $total_categories; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon blue mb-2">
                                <i class="icon dripicons dripicons-archive"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Course</h6>
                            <?php
                            $select_course = $conn->prepare("SELECT * FROM `course`");
                            $select_course->execute();
                            $total_course =  $select_course->rowCount();
                            ?>
                            <h6 class="font-extrabold mb-0"><?= $total_course; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon green mb-2">
                                <i class="icon dripicons dripicons-user-group"></i>
                            </div>
                        </div>
                        <div class=" col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Enrolled Employee</h6>
                            <?php
                            $select_enrol = $conn->prepare("SELECT * FROM `enrol`");
                            $select_enrol->execute();
                            $total_enrol =  $select_enrol->rowCount();
                            ?>
                            <h6 class="font-extrabold mb-0"><?= $total_enrol; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <div class="row">
        <?php
            if ($_SESSION['user_type']=="instruktur"){
        ?>
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Total Course Participants</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php
            if ($_SESSION['user_type']=="admin" || $_SESSION['user_type']=="direktur"){
        ?>
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Total Course Participants</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="adminChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h4>Total Users</h4>
                </div>
                <div class="card-body">
                    <canvas id="totalUsers"></canvas>
                </div>
            </div>
        </div>
        <?php
            if ($_SESSION['user_type']=="instruktur"){
        ?>
        <div class="row">
            <div class="col-12 col-xl">
                <div class="card">
                    <div class="card-header">
                        <h4>Latest Discussions</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-lg">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Chat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id = $_SESSION['id_instructor'] ?? '';
                                    $select_discuss = $conn->prepare("SELECT * FROM `discuss`, `users` WHERE discuss.id_users = users.id_users && id_instructor = ? ORDER BY id_discuss DESC LIMIT 3");
                                    $select_discuss->execute([$id]);
                                    if($select_discuss->rowCount() > 0){
                                        while($fetch_discuss = $select_discuss->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                    <tr>
                                        <td class="col-3">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-md">
                                                    <img src="../uploaded_profile/<?= $fetch_discuss['photo']; ?>" />
                                                </div>
                                                <p class="font-bold ms-3 mb-0"><?= $fetch_discuss['first_name']; ?>
                                                    <?= $fetch_discuss['last_name']; ?></p>
                                            </div>
                                        </td>
                                        <td class="col-auto">
                                            <p class="mb-0"><?= $fetch_discuss['discuss']; ?></p>
                                        </td>
                                    </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <!-- Counting for Data Chart -->
    <?php
    $select_users = $conn->prepare("SELECT * FROM `users`");
    $select_users->execute();
    $total_users =  $select_users->rowCount();
    
    $select_instructors = $conn->prepare("SELECT * FROM `instructors`");
    $select_instructors->execute();
    $total_instructors =  $select_instructors->rowCount();
    
?>

    <script>
    // Bar Chart
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php 
                    $id = $_SESSION['id_instructor'] ?? '';
                    $select_course = $conn->prepare("SELECT * FROM `course` WHERE id_instructor = ? ");
                    $select_course->execute([$id]);
                    if($select_course->rowCount() > 0){
                        while($fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)){   
                            $title = $fetch_course['title'];
                            echo '"' . $title . '"' . ',';
                        }
                    }
                ?>],
            datasets: [{
                label: 'Total Enrolled',
                data: [<?php 
                   $id = $_SESSION['id_instructor'] ?? '';
                   $select_course = $conn->prepare("SELECT * FROM `course` WHERE id_instructor = ? ");
                   $select_course->execute([$id]);
                   if($select_course->rowCount() > 0){
                       while($fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)){  
                           $course_id = $fetch_course['id_course'];
                           $select_enrol = $conn->prepare("SELECT * FROM `enrol` WHERE id_course = ?");
                           $select_enrol->execute([$course_id]);
                           $total_enrol =  $select_enrol->rowCount();
                           echo $total_enrol . ',';
                       }
                   }
                    ?>],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const otx = document.getElementById('adminChart');

    new Chart(otx, {
        type: 'bar',
        data: {
            labels: [<?php 
                   $select_courses = $conn->prepare("SELECT * FROM `course`");
                   $select_courses->execute();
                   if($select_courses->rowCount() > 0){
                       while($fetch_courses = $select_courses->fetch(PDO::FETCH_ASSOC)){    
                            $title = $fetch_courses['title'];
                            echo '"' . $title . '"' . ',';
                        }
                    }
                ?>],
            datasets: [{
                label: 'Total Enrolled',
                data: [<?php 
                    $select_courses = $conn->prepare("SELECT * FROM `course`");
                    $select_courses->execute();
                    if($select_courses->rowCount() > 0){
                        while($fetch_courses = $select_courses->fetch(PDO::FETCH_ASSOC)){  
                            $courses_id = $fetch_courses['id_course'];
                            $select_enrols = $conn->prepare("SELECT * FROM `enrol` WHERE id_course = ?");
                            $select_enrols->execute([$courses_id]);
                            $total_enrols =  $select_enrols->rowCount();
                            echo $total_enrols . ',';
                        }
                    }
                    ?>],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Doughnut Chart
    const dtx = document.getElementById('totalUsers');

    new Chart(dtx, {
        type: 'doughnut',
        data: {
            labels: [
                'Employee',
                'Instructor'
            ],
            datasets: [{
                label: 'Total',
                data: [<?= $total_users; ?>, <?= $total_instructors; ?>],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)'
                ],
                hoverOffset: 4
            }]
        }
    });
    </script>