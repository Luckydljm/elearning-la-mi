<?php 

    session_start();

    if(isset($_COOKIE['id_users'])){
        $id_users = $_COOKIE['id_users'];
     }else{
        $id_users = '';
        header('location:../../index.php');
     }

     if(isset($_GET['get_id_lesson'])){
        $get_id_lesson = $_GET['get_id_lesson'];
    }

     if(isset($_POST['submit'])){
     
        $id_question = $_POST['id_question'];
        $id_question = filter_var($id_question, FILTER_SANITIZE_STRING);
        $id_lesson = $_POST['id_lesson'];
        $id_lesson = filter_var($id_lesson, FILTER_SANITIZE_STRING);
        $answers = $_POST['answers'];
        $answers = filter_var($answers, FILTER_SANITIZE_STRING);

        $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_question = ?");
        $select_question->execute([$id_question]);
        if($select_question->rowCount() > 0){
            while($fetch_question = $select_question->fetch(PDO::FETCH_ASSOC)){
                $correct = $fetch_question['correct_answers'];
        }}

        if($correct == $answers){
            $results = 'True';
        }else{
            $results = 'False';
        }
            
        $insert_answers = $conn->prepare("INSERT INTO `results`(id_users, id_question, id_lesson, answers, results) VALUES(?,?,?,?,?)");
        $insert_answers->execute([$id_users, $id_question, $id_lesson, $answers, $results]);
     }

     if(isset($_POST['submit2'])){
     
        $id_question = $_POST['id_question'];
        $id_question = filter_var($id_question, FILTER_SANITIZE_STRING);
        $id_lesson = $_POST['id_lesson'];
        $id_lesson = filter_var($id_lesson, FILTER_SANITIZE_STRING);
        $answers = $_POST['answers'];
        $answers = filter_var($answers, FILTER_SANITIZE_STRING);

        $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_question = ?");
        $select_question->execute([$id_question]);
        if($select_question->rowCount() > 0){
            while($fetch_question = $select_question->fetch(PDO::FETCH_ASSOC)){
                $correct = $fetch_question['correct_answers'];
        }}

        if($correct == $answers){
            $results = 'True';
        }else{
            $results = 'False';
        }
            
        $insert_answers = $conn->prepare("INSERT INTO `results`(id_users, id_question, id_lesson, answers, results) VALUES(?,?,?,?,?)");
        $insert_answers->execute([$id_users, $id_question, $id_lesson, $answers, $results]);
     }

     if(isset($_POST['submit3'])){
     
        $id_question = $_POST['id_question'];
        $id_question = filter_var($id_question, FILTER_SANITIZE_STRING);
        $id_lesson = $_POST['id_lesson'];
        $id_lesson = filter_var($id_lesson, FILTER_SANITIZE_STRING);
        $answers = $_POST['answers'];
        $answers = filter_var($answers, FILTER_SANITIZE_STRING);

        $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_question = ?");
        $select_question->execute([$id_question]);
        if($select_question->rowCount() > 0){
            while($fetch_question = $select_question->fetch(PDO::FETCH_ASSOC)){
                $correct = $fetch_question['correct_answers'];
        }}

        if($correct == $answers){
            $results = 'True';
        }else{
            $results = 'False';
        }
            
        $insert_answers = $conn->prepare("INSERT INTO `results`(id_users, id_question, id_lesson, answers, results) VALUES(?,?,?,?,?)");
        $insert_answers->execute([$id_users, $id_question, $id_lesson, $answers, $results]);
     }
     
     if(isset($_POST['submit4'])){
     
        $id_question = $_POST['id_question'];
        $id_question = filter_var($id_question, FILTER_SANITIZE_STRING);
        $id_lesson = $_POST['id_lesson'];
        $id_lesson = filter_var($id_lesson, FILTER_SANITIZE_STRING);
        $answers = $_POST['answers'];
        $answers = filter_var($answers, FILTER_SANITIZE_STRING);

        $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_question = ?");
        $select_question->execute([$id_question]);
        if($select_question->rowCount() > 0){
            while($fetch_question = $select_question->fetch(PDO::FETCH_ASSOC)){
                $correct = $fetch_question['correct_answers'];
        }}

        if($correct == $answers){
            $results = 'True';
        }else{
            $results = 'False';
        }
            
        $insert_answers = $conn->prepare("INSERT INTO `results`(id_users, id_question, id_lesson, answers, results) VALUES(?,?,?,?,?)");
        $insert_answers->execute([$id_users, $id_question, $id_lesson, $answers, $results]);
     }
     
     if(isset($_POST['submit5'])){
     
        $id_question = $_POST['id_question'];
        $id_question = filter_var($id_question, FILTER_SANITIZE_STRING);
        $id_lesson = $_POST['id_lesson'];
        $id_lesson = filter_var($id_lesson, FILTER_SANITIZE_STRING);
        $answers = $_POST['answers'];
        $answers = filter_var($answers, FILTER_SANITIZE_STRING);

        $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_question = ?");
        $select_question->execute([$id_question]);
        if($select_question->rowCount() > 0){
            while($fetch_question = $select_question->fetch(PDO::FETCH_ASSOC)){
                $correct = $fetch_question['correct_answers'];
        }}

        if($correct == $answers){
            $results = 'True';
        }else{
            $results = 'False';
        }
            
        $insert_answers = $conn->prepare("INSERT INTO `results`(id_users, id_question, id_lesson, answers, results) VALUES(?,?,?,?,?)");
        $insert_answers->execute([$id_users, $id_question, $id_lesson, $answers, $results]);
     }


?>
<!-- Counting Correct Answers -->
<?php
    $id = $_SESSION['id_users'] ?? '';
    if(isset($_GET['get_id_lesson'])){
        $get_id_lesson = $_GET['get_id_lesson'];
    }
    $select_results = $conn->prepare("SELECT * FROM `results` WHERE results = 'True' && id_users = ? && id_lesson = ?");
    $select_results->execute([$id, $get_id_lesson]);
    $total = $select_results->rowCount(); 
    $total_score = $total * 20;
    if($total_score == 0){
?>
<div class="card bg-primary text-white shadow">
    <div class="card-body">
        <p class="card-title">
            Your Score:
        </p>
        <p class="card-text fs-3 fw-bold">
            -
        </p>
    </div>
</div>
<?php } elseif($total_score > 0 && $total_score < 70){
?>
<div class="card bg-danger text-white shadow">
    <div class="card-body">
        <h3 class="card-title text-white">
            Mohon Maaf Anda Dinyatakan Tidak Lulus Pelatihan!
        </h3>
        <p class="card-title">
            Your Score:
        </p>
        <p class="card-text fs-3 fw-bold">
            <?= $total_score; ?>
        </p>
    </div>
</div>
<?php } else { ?>
<div class="card bg-success text-white shadow">
    <?php
        $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_lesson = ? LIMIT 1");
        $select_question->execute([$get_id_lesson]);
        if($select_question->rowCount() > 0){
            while($fetch_question = $select_question->fetch(PDO::FETCH_ASSOC)){
                $question_id = $fetch_question['id_question'];
                $id = $_SESSION['id_users'] ?? '';
                $select_results = $conn->prepare("SELECT * FROM `results` WHERE id_question = ? && id_users = ?");
                $select_results->execute([$question_id, $id]);
                if($select_results->rowCount() == 0){
        ?>
    <div class="card-body">
        <p class="card-title">
            Your Score:
        </p>
        <p class="card-text fs-3 fw-bold">
            -
        </p>
    </div>
    <?php } else { ?>
    <div class="card-body">
        <h3 class="card-title text-white">
            Selamat Anda Dinyatakan Lulus Pelatihan!
        </h3>
        <p class="card-title">
            Your Score:
        </p>
        <p class="card-text fs-3 fw-bold">
            <?= $total_score; ?>
        </p>
    </div>
    <?php }}} ?>
</div>
<?php } ?>

<div class="card shadow">
    <div class="my-5" id="quiz-header">
        Quiz Title : <strong><?= $fetch_lesson['title']; ?></strong><br>
        Number of Questions :
        <?php
            if(isset($_GET['get_id_lesson'])){
                $get_id_lesson = $_GET['get_id_lesson'];
            }
            $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_lesson = ?");
            $select_question->execute([$get_id_lesson]);
            $total_question = $select_question->rowCount();  
        ?>
        <strong><?= $total_question; ?></strong><br>
    </div>
    <hr class="mt-0">
    <form action="" method="post" enctype="multipart/form-data">
        <div id="smartwizard">
            <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                <?php
                    $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_lesson = ? LIMIT 1");
                    $select_question->execute([$get_id_lesson]);
                    if($select_question->rowCount() > 0){
                        while($fetch_question = $select_question->fetch(PDO::FETCH_ASSOC)){
                            $question_id = $fetch_question['id_question'];
                            $id = $_SESSION['id_users'] ?? '';
                            $select_results = $conn->prepare("SELECT * FROM `results` WHERE id_question = ? && id_users = ?");
                            $select_results->execute([$question_id, $id]);
                            if($select_results->rowCount() > 0){
                ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#question1">
                        <span class="d-none d-sm-inline">Question 1</span>
                    </a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#question1">
                        <span class="d-none d-sm-inline">Question 1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#finish">
                        <i class="icon dripicons dripicons-checkmark"
                            style="font-size: 12px; margin-right: 0.5rem;"></i>
                        <span class="d-none d-sm-inline">Finish</span>
                    </a>
                </li>
                <?php }}} ?>
            </ul>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
            <div class="tab-content">
                <?php
                    $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_lesson = ? LIMIT 1");
                    $select_question->execute([$get_id_lesson]);
                    if($select_question->rowCount() > 0){
                        while($fetch_question = $select_question->fetch(PDO::FETCH_ASSOC)){
                            $question_id = $fetch_question['id_question'];
                ?>

                <div id="question1" class="tab-pane" role="tabpanel" aria-labelledby="question1">
                    <input class="id_question" type="hidden" name="id_question" value="<?= $question_id; ?>">
                    <input class="id_lesson" type="hidden" name="id_lesson" value="<?= $get_id_lesson; ?>">
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                            <div class="card text-left border shadow mt-3">
                                <div class="card-body">
                                    <?php
                                        $select_quiz = $conn->prepare("SELECT * FROM `question` WHERE id_question = ?");
                                        $select_quiz->execute([$question_id]);
                                        if($select_quiz->rowCount() > 0){
                                            while($fetch_quiz = $select_quiz->fetch(PDO::FETCH_ASSOC)){
                                                $id = $_SESSION['id_users'] ?? '';
                                                $select_results = $conn->prepare("SELECT * FROM `results` WHERE id_question = ? && id_users = ?");
                                                $select_results->execute([$question_id, $id]);
                                                if($select_results->rowCount() > 0){
                                                    while($fetch_results = $select_results->fetch(PDO::FETCH_ASSOC)){
                                                       if($fetch_results['results'] == 'True'){ 
                                    ?>
                                    <h2 class="mt-0"><i class="icon dripicons dripicons-checkmark"></i>
                                    </h2>
                                    <h3 class="mt-0">Your Results</h3>
                                    <p class="w-75 mb-2 mx-auto text-success fw-bold">
                                        <?= $fetch_results['results']; ?></p>
                                    <?php } else { ?>
                                    <h2 class="mt-0"><i class="icon dripicons dripicons-cross"></i>
                                    </h2>
                                    <h3 class="mt-0">Your Results</h3>
                                    <p class="w-75 mb-2 mx-auto text-danger fw-bold">
                                        <?= $fetch_results['results']; ?></p>
                                    <?php }}}}} ?>

                                    <?php
                                        $select_quiz = $conn->prepare("SELECT * FROM `question` WHERE id_question = ?");
                                        $select_quiz->execute([$question_id]);
                                        if($select_quiz->rowCount() > 0){
                                            while($fetch_quiz = $select_quiz->fetch(PDO::FETCH_ASSOC)){
                                                $id = $_SESSION['id_users'] ?? '';
                                                $select_results = $conn->prepare("SELECT * FROM `results` WHERE id_question = ? && id_users = ?");
                                                $select_results->execute([$question_id, $id]);
                                                if($select_results->rowCount() == 0){
                                    ?>
                                    <h6 class="card-title">
                                        <strong><?= $fetch_quiz['title']; ?></strong>
                                    </h6>
                                    <hr>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_a"
                                            value="<?= $fetch_quiz['option_a']; ?>">
                                        <label class="form-check-label" for="option_a">
                                            <?= $fetch_quiz['option_a']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_b"
                                            value="<?= $fetch_quiz['option_b']; ?>">
                                        <label class="form-check-label" for="option_b">
                                            <?= $fetch_quiz['option_b']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_c"
                                            value="<?= $fetch_quiz['option_c']; ?>">
                                        <label class="form-check-label" for="option_c">
                                            <?= $fetch_quiz['option_c']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_d"
                                            value="<?= $fetch_quiz['option_d']; ?>">
                                        <label class="form-check-label" for="option_d">
                                            <?= $fetch_quiz['option_d']; ?>
                                        </label>
                                    </div>
                                    <?php
                                        }}}
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }}
                ?>
                <div id="finish" class="tab-pane" role="tabpanel" aria-labelledby="finish">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="text-center">
                                <h2 class="mt-0"><i class="icon dripicons dripicons-upload"></i>
                                </h2>
                                <h3 class="mt-0">Thank You</h3>
                                <p class="w-75 mb-2 mx-auto">
                                    You Are Just One Click Away</p>
                                <div class="mb-3 mt-3">
                                    <button type="submit" class="btn btn-primary text-center"
                                        name="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Question 2 -->
<div class="card shadow">
    <div class="my-5" id="quiz-header">
    </div>
    <hr class="mt-0">
    <form action="" method="post" enctype="multipart/form-data">
        <div id="smartwizard2">
            <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                <?php
                    $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_lesson = ? LIMIT 1");
                    $select_question->execute([$get_id_lesson]);
                    if($select_question->rowCount() > 0){
                        while($fetch_question = $select_question->fetch(PDO::FETCH_ASSOC)){
                            $question_id = $fetch_question['id_question'] + 1;
                            $id = $_SESSION['id_users'] ?? '';
                            $select_results = $conn->prepare("SELECT * FROM `results` WHERE id_question = ? && id_users = ?");
                            $select_results->execute([$question_id, $id]);
                            if($select_results->rowCount() > 0){
                ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#question2">
                        <span class="d-none d-sm-inline">Question 2</span>
                    </a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#question2">
                        <span class="d-none d-sm-inline">Question 2</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#finish">
                        <i class="icon dripicons dripicons-checkmark"
                            style="font-size: 12px; margin-right: 0.5rem;"></i>
                        <span class="d-none d-sm-inline">Finish</span>
                    </a>
                </li>
                <?php }}} ?>
            </ul>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
            <div class="tab-content">
                <?php
                    $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_lesson = ? LIMIT 1");
                    $select_question->execute([$get_id_lesson]);
                    if($select_question->rowCount() > 0){
                        while($fetch_question = $select_question->fetch(PDO::FETCH_ASSOC)){
                            $question_id = $fetch_question['id_question'] + 1;
                ?>

                <div id="question2" class="tab-pane" role="tabpanel" aria-labelledby="question2">
                    <input class="id_question" type="hidden" name="id_question" value="<?= $question_id; ?>">
                    <input class="id_lesson" type="hidden" name="id_lesson" value="<?= $get_id_lesson; ?>">
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                            <div class="card text-left border shadow mt-3">
                                <div class="card-body">
                                    <?php
                                        $select_quiz = $conn->prepare("SELECT * FROM `question` WHERE id_question = ?");
                                        $select_quiz->execute([$question_id]);
                                        if($select_quiz->rowCount() > 0){
                                            while($fetch_quiz = $select_quiz->fetch(PDO::FETCH_ASSOC)){
                                                $id = $_SESSION['id_users'] ?? '';
                                                $select_results = $conn->prepare("SELECT * FROM `results` WHERE id_question = ? && id_users = ?");
                                                $select_results->execute([$question_id, $id]);
                                                if($select_results->rowCount() > 0){
                                                    while($fetch_results = $select_results->fetch(PDO::FETCH_ASSOC)){
                                                       if($fetch_results['results'] == 'True'){ 
                                    ?>
                                    <h2 class="mt-0"><i class="icon dripicons dripicons-checkmark"></i>
                                    </h2>
                                    <h3 class="mt-0">Your Results</h3>
                                    <p class="w-75 mb-2 mx-auto text-success fw-bold">
                                        <?= $fetch_results['results']; ?></p>
                                    <?php } else { ?>
                                    <h2 class="mt-0"><i class="icon dripicons dripicons-cross"></i>
                                    </h2>
                                    <h3 class="mt-0">Your Results</h3>
                                    <p class="w-75 mb-2 mx-auto text-danger fw-bold">
                                        <?= $fetch_results['results']; ?></p>
                                    <?php }}}}} ?>

                                    <?php
                                        $select_quiz = $conn->prepare("SELECT * FROM `question` WHERE id_question = ?");
                                        $select_quiz->execute([$question_id]);
                                        if($select_quiz->rowCount() > 0){
                                            while($fetch_quiz = $select_quiz->fetch(PDO::FETCH_ASSOC)){
                                                $id = $_SESSION['id_users'] ?? '';
                                                $select_results = $conn->prepare("SELECT * FROM `results` WHERE id_question = ? && id_users = ?");
                                                $select_results->execute([$question_id, $id]);
                                                if($select_results->rowCount() == 0){
                                    ?>
                                    <h6 class="card-title">
                                        <strong><?= $fetch_quiz['title']; ?></strong>
                                    </h6>
                                    <hr>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_a"
                                            value="<?= $fetch_quiz['option_a']; ?>">
                                        <label class="form-check-label" for="option_a">
                                            <?= $fetch_quiz['option_a']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_b"
                                            value="<?= $fetch_quiz['option_b']; ?>">
                                        <label class="form-check-label" for="option_b">
                                            <?= $fetch_quiz['option_b']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_c"
                                            value="<?= $fetch_quiz['option_c']; ?>">
                                        <label class="form-check-label" for="option_c">
                                            <?= $fetch_quiz['option_c']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_d"
                                            value="<?= $fetch_quiz['option_d']; ?>">
                                        <label class="form-check-label" for="option_d">
                                            <?= $fetch_quiz['option_d']; ?>
                                        </label>
                                    </div>
                                    <?php
                                        }}}
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }}
                ?>
                <div id="finish" class="tab-pane" role="tabpanel" aria-labelledby="finish">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="text-center">
                                <h2 class="mt-0"><i class="icon dripicons dripicons-upload"></i>
                                </h2>
                                <h3 class="mt-0">Thank You</h3>
                                <p class="w-75 mb-2 mx-auto">
                                    You Are Just One Click Away</p>
                                <div class="mb-3 mt-3">
                                    <button type="submit" class="btn btn-primary text-center"
                                        name="submit2">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Question 3 -->
<div class="card shadow">
    <div class="my-5" id="quiz-header">
    </div>
    <hr class="mt-0">
    <form action="" method="post" enctype="multipart/form-data">
        <div id="smartwizard3">
            <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                <?php
                    $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_lesson = ? LIMIT 1");
                    $select_question->execute([$get_id_lesson]);
                    if($select_question->rowCount() > 0){
                        while($fetch_question = $select_question->fetch(PDO::FETCH_ASSOC)){
                            $question_id = $fetch_question['id_question'] + 2;
                            $id = $_SESSION['id_users'] ?? '';
                            $select_results = $conn->prepare("SELECT * FROM `results` WHERE id_question = ? && id_users = ?");
                            $select_results->execute([$question_id, $id]);
                            if($select_results->rowCount() > 0){
                ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#question3">
                        <span class="d-none d-sm-inline">Question 3</span>
                    </a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#question3">
                        <span class="d-none d-sm-inline">Question 3</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#finish">
                        <i class="icon dripicons dripicons-checkmark"
                            style="font-size: 12px; margin-right: 0.5rem;"></i>
                        <span class="d-none d-sm-inline">Finish</span>
                    </a>
                </li>
                <?php }}} ?>
            </ul>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
            <div class="tab-content">
                <?php
                    $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_lesson = ? LIMIT 1");
                    $select_question->execute([$get_id_lesson]);
                    if($select_question->rowCount() > 0){
                        while($fetch_question = $select_question->fetch(PDO::FETCH_ASSOC)){
                            $question_id = $fetch_question['id_question'] + 2;
                ?>

                <div id="question3" class="tab-pane" role="tabpanel" aria-labelledby="question3">
                    <input class="id_question" type="hidden" name="id_question" value="<?= $question_id; ?>">
                    <input class="id_lesson" type="hidden" name="id_lesson" value="<?= $get_id_lesson; ?>">
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                            <div class="card text-left border shadow mt-3">
                                <div class="card-body">
                                    <?php
                                        $select_quiz = $conn->prepare("SELECT * FROM `question` WHERE id_question = ?");
                                        $select_quiz->execute([$question_id]);
                                        if($select_quiz->rowCount() > 0){
                                            while($fetch_quiz = $select_quiz->fetch(PDO::FETCH_ASSOC)){
                                                $id = $_SESSION['id_users'] ?? '';
                                                $select_results = $conn->prepare("SELECT * FROM `results` WHERE id_question = ? && id_users = ?");
                                                $select_results->execute([$question_id, $id]);
                                                if($select_results->rowCount() > 0){
                                                    while($fetch_results = $select_results->fetch(PDO::FETCH_ASSOC)){
                                                       if($fetch_results['results'] == 'True'){ 
                                    ?>
                                    <h2 class="mt-0"><i class="icon dripicons dripicons-checkmark"></i>
                                    </h2>
                                    <h3 class="mt-0">Your Results</h3>
                                    <p class="w-75 mb-2 mx-auto text-success fw-bold">
                                        <?= $fetch_results['results']; ?></p>
                                    <?php } else { ?>
                                    <h2 class="mt-0"><i class="icon dripicons dripicons-cross"></i>
                                    </h2>
                                    <h3 class="mt-0">Your Results</h3>
                                    <p class="w-75 mb-2 mx-auto text-danger fw-bold">
                                        <?= $fetch_results['results']; ?></p>
                                    <?php }}}}} ?>

                                    <?php
                                        $select_quiz = $conn->prepare("SELECT * FROM `question` WHERE id_question = ?");
                                        $select_quiz->execute([$question_id]);
                                        if($select_quiz->rowCount() > 0){
                                            while($fetch_quiz = $select_quiz->fetch(PDO::FETCH_ASSOC)){
                                                $id = $_SESSION['id_users'] ?? '';
                                                $select_results = $conn->prepare("SELECT * FROM `results` WHERE id_question = ? && id_users = ?");
                                                $select_results->execute([$question_id, $id]);
                                                if($select_results->rowCount() == 0){
                                    ?>
                                    <h6 class="card-title">
                                        <strong><?= $fetch_quiz['title']; ?></strong>
                                    </h6>
                                    <hr>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_a"
                                            value="<?= $fetch_quiz['option_a']; ?>">
                                        <label class="form-check-label" for="option_a">
                                            <?= $fetch_quiz['option_a']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_b"
                                            value="<?= $fetch_quiz['option_b']; ?>">
                                        <label class="form-check-label" for="option_b">
                                            <?= $fetch_quiz['option_b']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_c"
                                            value="<?= $fetch_quiz['option_c']; ?>">
                                        <label class="form-check-label" for="option_c">
                                            <?= $fetch_quiz['option_c']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_d"
                                            value="<?= $fetch_quiz['option_d']; ?>">
                                        <label class="form-check-label" for="option_d">
                                            <?= $fetch_quiz['option_d']; ?>
                                        </label>
                                    </div>
                                    <?php
                                        }}}
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }}
                ?>
                <div id="finish" class="tab-pane" role="tabpanel" aria-labelledby="finish">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="text-center">
                                <h2 class="mt-0"><i class="icon dripicons dripicons-upload"></i>
                                </h2>
                                <h3 class="mt-0">Thank You</h3>
                                <p class="w-75 mb-2 mx-auto">
                                    You Are Just One Click Away</p>
                                <div class="mb-3 mt-3">
                                    <button type="submit" class="btn btn-primary text-center"
                                        name="submit3">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Question 4 -->
<div class="card shadow">
    <div class="my-5" id="quiz-header">
    </div>
    <hr class="mt-0">
    <form action="" method="post" enctype="multipart/form-data">
        <div id="smartwizard4">
            <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                <?php
                    $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_lesson = ? LIMIT 1");
                    $select_question->execute([$get_id_lesson]);
                    if($select_question->rowCount() > 0){
                        while($fetch_question = $select_question->fetch(PDO::FETCH_ASSOC)){
                            $question_id = $fetch_question['id_question'] + 3;
                            $id = $_SESSION['id_users'] ?? '';
                            $select_results = $conn->prepare("SELECT * FROM `results` WHERE id_question = ? && id_users = ?");
                            $select_results->execute([$question_id, $id]);
                            if($select_results->rowCount() > 0){
                ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#question4">
                        <span class="d-none d-sm-inline">Question 4</span>
                    </a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#question4">
                        <span class="d-none d-sm-inline">Question 4</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#finish">
                        <i class="icon dripicons dripicons-checkmark"
                            style="font-size: 12px; margin-right: 0.5rem;"></i>
                        <span class="d-none d-sm-inline">Finish</span>
                    </a>
                </li>
                <?php }}} ?>
            </ul>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
            <div class="tab-content">
                <?php
                    $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_lesson = ? LIMIT 1");
                    $select_question->execute([$get_id_lesson]);
                    if($select_question->rowCount() > 0){
                        while($fetch_question = $select_question->fetch(PDO::FETCH_ASSOC)){
                            $question_id = $fetch_question['id_question'] + 3;
                ?>

                <div id="question4" class="tab-pane" role="tabpanel" aria-labelledby="question4">
                    <input class="id_question" type="hidden" name="id_question" value="<?= $question_id; ?>">
                    <input class="id_lesson" type="hidden" name="id_lesson" value="<?= $get_id_lesson; ?>">
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                            <div class="card text-left border shadow mt-3">
                                <div class="card-body">
                                    <?php
                                        $select_quiz = $conn->prepare("SELECT * FROM `question` WHERE id_question = ?");
                                        $select_quiz->execute([$question_id]);
                                        if($select_quiz->rowCount() > 0){
                                            while($fetch_quiz = $select_quiz->fetch(PDO::FETCH_ASSOC)){
                                                $id = $_SESSION['id_users'] ?? '';
                                                $select_results = $conn->prepare("SELECT * FROM `results` WHERE id_question = ? && id_users = ?");
                                                $select_results->execute([$question_id, $id]);
                                                if($select_results->rowCount() > 0){
                                                    while($fetch_results = $select_results->fetch(PDO::FETCH_ASSOC)){
                                                       if($fetch_results['results'] == 'True'){ 
                                    ?>
                                    <h2 class="mt-0"><i class="icon dripicons dripicons-checkmark"></i>
                                    </h2>
                                    <h3 class="mt-0">Your Results</h3>
                                    <p class="w-75 mb-2 mx-auto text-success fw-bold">
                                        <?= $fetch_results['results']; ?></p>
                                    <?php } else { ?>
                                    <h2 class="mt-0"><i class="icon dripicons dripicons-cross"></i>
                                    </h2>
                                    <h3 class="mt-0">Your Results</h3>
                                    <p class="w-75 mb-2 mx-auto text-danger fw-bold">
                                        <?= $fetch_results['results']; ?></p>
                                    <?php }}}}} ?>

                                    <?php
                                        $select_quiz = $conn->prepare("SELECT * FROM `question` WHERE id_question = ?");
                                        $select_quiz->execute([$question_id]);
                                        if($select_quiz->rowCount() > 0){
                                            while($fetch_quiz = $select_quiz->fetch(PDO::FETCH_ASSOC)){
                                                $id = $_SESSION['id_users'] ?? '';
                                                $select_results = $conn->prepare("SELECT * FROM `results` WHERE id_question = ? && id_users = ?");
                                                $select_results->execute([$question_id, $id]);
                                                if($select_results->rowCount() == 0){
                                    ?>
                                    <h6 class="card-title">
                                        <strong><?= $fetch_quiz['title']; ?></strong>
                                    </h6>
                                    <hr>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_a"
                                            value="<?= $fetch_quiz['option_a']; ?>">
                                        <label class="form-check-label" for="option_a">
                                            <?= $fetch_quiz['option_a']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_b"
                                            value="<?= $fetch_quiz['option_b']; ?>">
                                        <label class="form-check-label" for="option_b">
                                            <?= $fetch_quiz['option_b']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_c"
                                            value="<?= $fetch_quiz['option_c']; ?>">
                                        <label class="form-check-label" for="option_c">
                                            <?= $fetch_quiz['option_c']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_d"
                                            value="<?= $fetch_quiz['option_d']; ?>">
                                        <label class="form-check-label" for="option_d">
                                            <?= $fetch_quiz['option_d']; ?>
                                        </label>
                                    </div>
                                    <?php
                                        }}}
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }}
                ?>
                <div id="finish" class="tab-pane" role="tabpanel" aria-labelledby="finish">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="text-center">
                                <h2 class="mt-0"><i class="icon dripicons dripicons-upload"></i>
                                </h2>
                                <h3 class="mt-0">Thank You</h3>
                                <p class="w-75 mb-2 mx-auto">
                                    You Are Just One Click Away</p>
                                <div class="mb-3 mt-3">
                                    <button type="submit" class="btn btn-primary text-center"
                                        name="submit4">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Question 5 -->
<div class="card shadow">
    <div class="my-5" id="quiz-header">
    </div>
    <hr class="mt-0">
    <form action="" method="post" enctype="multipart/form-data">
        <div id="smartwizard5">
            <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                <?php
                    $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_lesson = ? LIMIT 1");
                    $select_question->execute([$get_id_lesson]);
                    if($select_question->rowCount() > 0){
                        while($fetch_question = $select_question->fetch(PDO::FETCH_ASSOC)){
                            $question_id = $fetch_question['id_question'] + 4;
                            $id = $_SESSION['id_users'] ?? '';
                            $select_results = $conn->prepare("SELECT * FROM `results` WHERE id_question = ? && id_users = ?");
                            $select_results->execute([$question_id, $id]);
                            if($select_results->rowCount() > 0){
                ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#question5">
                        <span class="d-none d-sm-inline">Question 5</span>
                    </a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#question5">
                        <span class="d-none d-sm-inline">Question 5</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#finish">
                        <i class="icon dripicons dripicons-checkmark"
                            style="font-size: 12px; margin-right: 0.5rem;"></i>
                        <span class="d-none d-sm-inline">Finish</span>
                    </a>
                </li>
                <?php }}} ?>
            </ul>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
            <div class="tab-content">
                <?php
                    $select_question = $conn->prepare("SELECT * FROM `question` WHERE id_lesson = ? LIMIT 1");
                    $select_question->execute([$get_id_lesson]);
                    if($select_question->rowCount() > 0){
                        while($fetch_question = $select_question->fetch(PDO::FETCH_ASSOC)){
                            $question_id = $fetch_question['id_question'] + 4;
                ?>

                <div id="question5" class="tab-pane" role="tabpanel" aria-labelledby="question5">
                    <input class="id_question" type="hidden" name="id_question" value="<?= $question_id; ?>">
                    <input class="id_lesson" type="hidden" name="id_lesson" value="<?= $get_id_lesson; ?>">
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                            <div class="card text-left border shadow mt-3">
                                <div class="card-body">
                                    <?php
                                        $select_quiz = $conn->prepare("SELECT * FROM `question` WHERE id_question = ?");
                                        $select_quiz->execute([$question_id]);
                                        if($select_quiz->rowCount() > 0){
                                            while($fetch_quiz = $select_quiz->fetch(PDO::FETCH_ASSOC)){
                                                $id = $_SESSION['id_users'] ?? '';
                                                $select_results = $conn->prepare("SELECT * FROM `results` WHERE id_question = ? && id_users = ?");
                                                $select_results->execute([$question_id, $id]);
                                                if($select_results->rowCount() > 0){
                                                    while($fetch_results = $select_results->fetch(PDO::FETCH_ASSOC)){
                                                       if($fetch_results['results'] == 'True'){ 
                                    ?>
                                    <h2 class="mt-0"><i class="icon dripicons dripicons-checkmark"></i>
                                    </h2>
                                    <h3 class="mt-0">Your Results</h3>
                                    <p class="w-75 mb-2 mx-auto text-success fw-bold">
                                        <?= $fetch_results['results']; ?></p>
                                    <?php } else { ?>
                                    <h2 class="mt-0"><i class="icon dripicons dripicons-cross"></i>
                                    </h2>
                                    <h3 class="mt-0">Your Results</h3>
                                    <p class="w-75 mb-2 mx-auto text-danger fw-bold">
                                        <?= $fetch_results['results']; ?></p>
                                    <?php }}}}} ?>

                                    <?php
                                        $select_quiz = $conn->prepare("SELECT * FROM `question` WHERE id_question = ?");
                                        $select_quiz->execute([$question_id]);
                                        if($select_quiz->rowCount() > 0){
                                            while($fetch_quiz = $select_quiz->fetch(PDO::FETCH_ASSOC)){
                                                $id = $_SESSION['id_users'] ?? '';
                                                $select_results = $conn->prepare("SELECT * FROM `results` WHERE id_question = ? && id_users = ?");
                                                $select_results->execute([$question_id, $id]);
                                                if($select_results->rowCount() == 0){
                                    ?>
                                    <h6 class="card-title">
                                        <strong><?= $fetch_quiz['title']; ?></strong>
                                    </h6>
                                    <hr>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_a"
                                            value="<?= $fetch_quiz['option_a']; ?>">
                                        <label class="form-check-label" for="option_a">
                                            <?= $fetch_quiz['option_a']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_b"
                                            value="<?= $fetch_quiz['option_b']; ?>">
                                        <label class="form-check-label" for="option_b">
                                            <?= $fetch_quiz['option_b']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_c"
                                            value="<?= $fetch_quiz['option_c']; ?>">
                                        <label class="form-check-label" for="option_c">
                                            <?= $fetch_quiz['option_c']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers" id="option_d"
                                            value="<?= $fetch_quiz['option_d']; ?>">
                                        <label class="form-check-label" for="option_d">
                                            <?= $fetch_quiz['option_d']; ?>
                                        </label>
                                    </div>
                                    <?php
                                        }}}
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }}
                ?>
                <div id="finish" class="tab-pane" role="tabpanel" aria-labelledby="finish">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="text-center">
                                <h2 class="mt-0"><i class="icon dripicons dripicons-upload"></i>
                                </h2>
                                <h3 class="mt-0">Thank You</h3>
                                <p class="w-75 mb-2 mx-auto">
                                    You Are Just One Click Away</p>
                                <div class="mb-3 mt-3">
                                    <button type="submit" class="btn btn-primary text-center"
                                        name="submit5">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>