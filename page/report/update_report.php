<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h2>Update Report</h2>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="?page=report">Report</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Update Report</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-start">
            <div class="mx-3 fs-5"><i class="icon dripicons dripicons-toggles"></i></div>
            <?php
                    if(isset($_GET['get_id'])){
                        $get_id = $_GET['get_id'];
                    }
                    $select_course = $conn->prepare("SELECT * FROM `course`WHERE id_course = ? ");
                    $select_course->execute([$get_id]);
                    if($select_course->rowCount() > 0){
                        while($fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)){
                ?>
            <div class="fs-5">Update: <?= $fetch_course['title']; ?></div>
            <?php
                    }
                    }
                ?>
        </div>
    </div>

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

    <?php
        if (isset($_SESSION['fail'])) {
        ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> <?= $_SESSION['fail']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
            unset($_SESSION['fail']);
        }
        ?>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body d-flex justify-content-between">
                    <h5 class="header-title">Course Results</h5>
                    <a href="?page=report" class="btn btn-outline-primary rounded-5"><i class="bi bi-arrow-left"></i>
                        Back to Results List</a>
                </div>
                <form action="../page/report/action_report.php" method="post" enctype="multipart/form-data">
                    <div id="smartwizard">
                        <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#answer">
                                    <i class="icon dripicons dripicons-network-3"
                                        style="font-size: 12px; margin-right: 0.5rem;"></i>
                                    <span class="d-none d-sm-inline">Answer</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#results">
                                    <i class="icon dripicons dripicons-pin"
                                        style="font-size: 12px; margin-right: 0.5rem;"></i>
                                    <span class="d-none d-sm-inline">Results</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#note">
                                    <i class="icon dripicons dripicons-paperclip"
                                        style="font-size: 12px; margin-right: 0.5rem;"></i>
                                    <span class="d-none d-sm-inline">Note</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#finish">
                                    <i class="icon dripicons dripicons-checkmark"
                                        style="font-size: 12px; margin-right: 0.5rem;"></i>
                                    <span class="d-none d-sm-inline">Finish</span>
                                </a>
                            </li>
                        </ul>

                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="tab-content">
                            <?php
                                    if(isset($_GET['get_id'])){
                                        $get_id = $_GET['get_id'];
                                    }
                                    $select_results = $conn->prepare("SELECT * FROM `results`,`question` WHERE results.id_question=question.id_question && id_results = ? ");
                                    $select_results->execute([$get_id]);
                                    if($select_results->rowCount() > 0){
                                        while($fetch_results = $select_results->fetch(PDO::FETCH_ASSOC)){
                                ?>
                            <div id="answer" class="tab-pane" role="tabpanel" aria-labelledby="answer">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8">
                                        <div class="form-group row mb-5">
                                            <label class="col-md-2 form-text" for="question">Question</label>
                                            <div class="col-md-10">
                                                <textarea id="question" class="form-control" rows="7"
                                                    readonly><?= $fetch_results['title']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row my-3">
                                            <label class="col-md-2 form-text" for="answers">Answer</label>
                                            <div class="col-md-10">
                                                <textarea name="answers" id="answers" class="form-control" rows="20"
                                                    readonly><?= $fetch_results['answers']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="results" class="tab-pane" role="tabpanel" aria-labelledby="results">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8">
                                        <div class="form-group row mt-2">
                                            <label for="results" class="col-md-2 form-text">Results</label>
                                            <div class="col-md-10">
                                                <select id="results" class="form-select"
                                                    aria-label="Default select example" name="results">
                                                    <option value="<?= $fetch_course['results']; ?>" selected>
                                                        <?= $fetch_course['results']; ?></option>
                                                    <option value="A+">A+</option>
                                                    <option value="A">A</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B">B</option>
                                                    <option value="B-">B-</option>
                                                    <option value="C+">C+</option>
                                                    <option value="C">C</option>
                                                    <option value="C-">C-</option>
                                                    <option value="D">D</option>
                                                    <option value="E">E</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="note" class="tab-pane" role="tabpanel" aria-labelledby="note">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-2 form-text" for="notes">Give Some Notes</label>
                                            <div class="col-md-10">
                                                <textarea name="notes" id="notes" class="form-control"
                                                    rows="20"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                                <input class="last_modified" type="hidden" name="last_modified"
                                                    value="<?php echo date('Y-m-d')?>">
                                                <input class="id_results" type="hidden" name="id_results"
                                                    value="<?= $get_id; ?>">
                                                <button type="submit" class="btn btn-primary text-center"
                                                    name="update">Submit</button>
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
                    </div>
                </form>
            </div>
        </div>
        <!-- End of Tab Content -->
    </div>

</section>