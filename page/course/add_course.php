<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h2>Categories</h2>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="?page=course">Course</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Course</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="d-flex justify-content-between">
                <div class="card-header d-flex justify-content-start">
                    <div class="mx-3 fs-5"><i class="bi bi-archive-fill"></i></div>
                    <div class="fs-5">Add New Course</div>
                </div>
            </div>
        </div>

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
                        <h5 class="header-title">Course Adding Form</h5>
                        <a href="?page=course" class="btn btn-outline-primary rounded-5"><i
                                class="bi bi-arrow-left"></i>
                            Back to Course List</a>
                    </div>
                    <form action="../page/course/action_course.php" method="post" enctype="multipart/form-data">
                        <div id="smartwizard">
                            <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#basic">
                                        <i class="icon dripicons dripicons-pin"
                                            style="font-size: 12px; margin-right: 0.5rem;"></i>
                                        <span class="d-none d-sm-inline">Basic</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#requirements">
                                        <i class="icon dripicons dripicons-paperclip"
                                            style="font-size: 12px; margin-right: 0.5rem;"></i>
                                        <span class="d-none d-sm-inline">Requirements</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#outcomes">
                                        <i class="icon dripicons dripicons-export"
                                            style="font-size: 12px; margin-right: 0.5rem;"></i>
                                        <span class="d-none d-sm-inline">Outcomes</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#media">
                                        <i class="icon dripicons dripicons-media-play"
                                            style="font-size: 12px; margin-right: 0.5rem;"></i>
                                        <span class="d-none d-sm-inline">Media</span>
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

                            <!-- Tab Content -->
                            <div class="tab-content">
                                <div id="basic" class="tab-pane" role="tabpanel" aria-labelledby="basic">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 form-text" for="title">Course Title
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        placeholder="Enter Course Title" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 form-text" for="short_desc">Short
                                                    Description</label>
                                                <div class="col-md-10">
                                                    <textarea name="short_desc" id="short_desc"
                                                        class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 form-text" for="desciption">Description</label>
                                                <div class="col-md-10">
                                                    <textarea name="description" id="textEditor"
                                                        class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 form-text" for="id_sub_category">Category<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-10">
                                                    <select class="form-control select2" data-toggle="select2"
                                                        name="id_sub_category" id="id_sub_category" required>
                                                        <option value="">Select A Category</option>
                                                        <?php
                                                        $id = $_SESSION['id_instructor'] ?? '';
                                                        $select_category = $conn->prepare("SELECT * FROM `category` WHERE id_instructor = ?");
                                                        $select_category->execute([$id]);
                                                        if($select_category->rowCount() > 0){
                                                            while($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)){
                                                                $category_id = $fetch_category['id_category'];
                                                        ?>
                                                        <optgroup label="<?= $fetch_category['name']; ?>">
                                                            <?php
                                                            $select_sub_category = $conn->prepare("SELECT * FROM `sub_category`WHERE id_category = ? ");
                                                            $select_sub_category->execute([$category_id]);
                                                            if($select_sub_category->rowCount() > 0){
                                                                while($fetch_sub_category = $select_sub_category->fetch(PDO::FETCH_ASSOC)){
                                                            ?>
                                                            <option
                                                                value="<?= $fetch_sub_category['id_sub_category']; ?>">
                                                                <?= $fetch_sub_category['name_sub']; ?></option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </optgroup>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="requirements" class="tab-pane" role="tabpanel" aria-labelledby="requirements">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="form-group row mt-2">
                                                <label class="col-md-2 form-text"
                                                    for="requirements">Requirements</label>
                                                <div class="col-md-10">
                                                    <textarea name="requirements" id="requirements"
                                                        class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="outcomes" class="tab-pane" role="tabpanel" aria-labelledby="outcomes">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="form-group row mt-2">
                                                <label class="col-md-2 form-text" for="outcomes">Outcomes</label>
                                                <div class="col-md-10">
                                                    <textarea name="outcomes" id="outcomes"
                                                        class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="media" class="tab-pane" role="tabpanel" aria-labelledby="media">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="form-group row mt-2">
                                                <label class="col-md-2 form-text" for="thumbnail">Course
                                                    Thumbnail<span class="text-danger"> *</span></label>
                                                <div class="col-md-10">
                                                    <!-- <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                                                        class="image-preview-filepond" /> -->
                                                    <input type="file" name="thumbnail" class="form-control"
                                                        id="thumbnail" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="finish" class="tab-pane" role="tabpanel" aria-labelledby="finish">
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <h2 class="mt-0"><i class="icon dripicons dripicons-upload"></i></h2>
                                                <h3 class="mt-0">Thank You</h3>

                                                <p class="w-75 mb-2 mx-auto">
                                                    You Are Just One Click Away</p>

                                                <div class="mb-3 mt-3">
                                                    <input class="date_added" type="hidden" name="date_added"
                                                        value="<?php echo date('Y-m-d')?>">
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
            </div>
            <!-- End of Tab Content -->
        </div>


    </section>
</div>