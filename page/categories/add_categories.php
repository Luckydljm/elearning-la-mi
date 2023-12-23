<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h2>Add Categories</h2>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="?page=categories">Categories</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Categories</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-start">
                <div class="mx-3 fs-5"><i class="bi bi-stack"></i></div>
                <div class="fs-5">Add New Category</div>
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

        <div class="row justify-content-center">
            <div class="card w-50">
                <div class="card-header">Category Add Form</div>
                <div class="card-body">
                    <form action="../page/categories/action_categories.php" method="post" enctype="multipart/form-data"
                        data-parsley-validate>
                        <div class="form-group">
                            <label for="code" class="form-text">Category Code</label>
                            <input type="text" id="code" class="form-control" name="code" data-parsley-required="true"
                                value="<?php echo substr(md5(rand(0, 1000000)), 0, 10); ?>" readonly />
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-text">Category Title<span
                                    class="text-danger">*)</span></label>
                            <input type="text" id="name" class="form-control" name="name"
                                data-parsley-required="true" />
                        </div>
                        <div class=" form-group">
                            <label for="thumbnail" class="form-text">Category
                                Thumbnail <small>(The image size
                                    should be: 400 X 255)</small>
                            </label>
                            <div class="input-group mb-3">
                                <input type="file" name="thumbnail" class="form-control" id="thumbnail"
                                    accept="image/*">
                            </div>
                        </div>
                        <input class="date_added" type="hidden" name="date_added" value="<?php echo date('Y-m-d')?>">
                        <button type="submit" name="publish" class="btn btn-primary">Publish</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>