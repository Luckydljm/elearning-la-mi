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
                            <a href="?page=dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Categories</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="d-flex justify-content-between">
                <div class="card-header d-flex justify-content-start">
                    <div class="mx-3 fs-5"><i class="bi bi-stack"></i></div>
                    <div class="fs-5">List Categories</div>
                </div>
                <?php
	                if ($_SESSION['user_type']=="instruktur"){
	            ?>
                <div class="card-header">
                    <a href="?page=add_categories" class="btn btn-outline-primary rounded-5"><i
                            class="bi bi-plus-lg"></i> Add New Category</a>
                    <a href="?page=add_sub_categories" class="btn btn-outline-primary rounded-5"><i
                            class="bi bi-plus-lg"></i> Add Sub Category</a>
                </div>
                <?php } ?>
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
        if (isset($_SESSION['update'])) {
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> <?= $_SESSION['update']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            unset($_SESSION['update']);
        }
        ?>

        <?php
        if (isset($_SESSION['flash'])) {
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> <?= $_SESSION['flash']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            unset($_SESSION['flash']);
        }
        ?>

        <?php
        if (isset($_SESSION['flash_fail'])) {
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed!</strong> <?= $_SESSION['flash_fail']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            unset($_SESSION['flash_fail']);
        }
        ?>

        <?php
        if (isset($_SESSION['img_size'])) {
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed!</strong> <?= $_SESSION['img_size']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            unset($_SESSION['img_size']);
        }
        ?>

        <!-- List for Admin -->
        <?php
            if ($_SESSION['user_type']=="admin" || $_SESSION['user_type']=="direktur"){
        ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            $select_category = $conn->prepare("SELECT * FROM `category`, `instructors` WHERE category.id_instructor = instructors.id_instructor ORDER BY date_added DESC");
            $select_category->execute();
            if($select_category->rowCount() > 0){
                while($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)){
                    $category_id = $fetch_category['id_category'];
            ?>
            <div class="col">
                <div class="card" style="width: 22.5rem;">
                    <img src="../uploaded_thumbnail/<?= $fetch_category['thumbnail']; ?>" class="card-img-top"
                        alt="...">
                    <div class="card-body">
                        <small style="font-style: italic;">
                            <p class="card-text text-primary">#<?= $fetch_category['code']; ?> -
                                <?= $fetch_category['first_name']; ?> <?= $fetch_category['last_name']; ?>
                            </p>
                        </small>
                        <h5 class="card-title"><?= $fetch_category['name']; ?></h5>
                        <?php
                        $select_sub_category = $conn->prepare("SELECT * FROM `sub_category`WHERE id_category = ? ");
                        $select_sub_category->execute([$category_id]);
                        $total_sub_category =  $select_sub_category->rowCount();
                        if($select_sub_category->rowCount() > 0){
                           
                        ?>
                        <small style="font-style: italic;">
                            <p class="card-text"><?= $total_sub_category; ?> Sub Categories</p>
                        </small>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"></li>
                        <?php  
                    while($fetch_sub_category = $select_sub_category->fetch(PDO::FETCH_ASSOC)){
                ?>
                        <li class=" list-group-item" style="font-size: 0.9rem;"><?= $fetch_sub_category['name_sub']; ?>
                        </li>
                        <?php
                            }
                        }else{
                            ?>
                        <small style="font-style: italic;">
                            <p class="card-text">0 Sub Categories</p>
                        </small>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"></li>
                    <li class=" list-group-item text-danger">This category doesn't have sub categories yet</li>
                    <?php
                               }
                            ?>
                    <li class="list-group-item"></li>
                </ul>
                <div class="card-body">
                </div>
            </div>
        </div>
        <?php
                }
            }
            ?>
</div>
<?php } ?>

<!-- List for Instruktur -->
<?php
	if ($_SESSION['user_type']=="instruktur"){
?>
<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
        $id = $_SESSION['id_instructor'] ?? '';
        $select_category = $conn->prepare("SELECT * FROM `category` WHERE id_instructor = ? ORDER BY date_added DESC");
        $select_category->execute([$id]);
        if($select_category->rowCount() > 0){
            while($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)){
                $category_id = $fetch_category['id_category'];
    ?>
    <div class="col">
        <div class="card position-relative" style="width: 22.5rem;">
            <div class="dropdown position-absolute top-0 end-0">
                <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><button class="dropdown-item modal-btn btn-delete-category" id="btnDeleteCategory"
                            data-bs-toggle="modal" data-bs-target="#modalDeleteCategory" data-id="<?= $category_id ?>"
                            data-name="<?= $fetch_category['name']; ?>"><i class="bi bi-trash-fill"></i>
                            Delete</button></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><button class="dropdown-item modal-btn btn-edit-category" id="btnEditCategory"
                            data-bs-toggle="modal" data-bs-target="#modalEditCategory" data-id="<?= $category_id ?>"
                            data-code="<?= $fetch_category['code']; ?>" data-name="<?= $fetch_category['name']; ?>"
                            data-thumbnail="<?= $fetch_category['thumbnail']; ?>"><i class="bi bi-gear-fill"></i>
                            Update</button></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a href="?page=add_sub_categories" class="dropdown-item"><i class="bi bi-pencil-fill"></i> Sub
                            Category</a>
                    </li>
                </ul>
            </div>
            <img src="../uploaded_thumbnail/<?= $fetch_category['thumbnail']; ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <small style="font-style: italic;">
                    <p class="card-text text-primary">#<?= $fetch_category['code']; ?>
                    </p>
                </small>
                <h5 class="card-title"><?= $fetch_category['name']; ?></h5>
                <?php
                        $select_sub_category = $conn->prepare("SELECT * FROM `sub_category`WHERE id_category = ? ");
                        $select_sub_category->execute([$category_id]);
                        $total_sub_category =  $select_sub_category->rowCount();
                        if($select_sub_category->rowCount() > 0){
                           
                        ?>
                <small style="font-style: italic;">
                    <p class="card-text"><?= $total_sub_category; ?> Sub Categories</p>
                </small>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"></li>
                <?php  
                    while($fetch_sub_category = $select_sub_category->fetch(PDO::FETCH_ASSOC)){
                ?>
                <li class=" list-group-item" style="font-size: 0.9rem;"><?= $fetch_sub_category['name_sub']; ?></li>
                <?php
                            }
                        }else{
                            ?>
                <small style="font-style: italic;">
                    <p class="card-text">0 Sub Categories</p>
                </small>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"></li>
            <li class=" list-group-item text-danger">This category doesn't have sub categories yet</li>
            <?php
                               }
                            ?>
            <li class="list-group-item"></li>
        </ul>
        <div class="card-body">
        </div>
    </div>
</div>
<?php
                }
            }
            ?>
</div>
<?php } ?>
</section>
</div>

<!-- modals -->
<!-- edit category-->
<div class="modal text-gray-900" id="modalEditCategory" tabindex="-1">
    <form action="../page/categories/action_categories.php" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="code" class="form-text">Category Code</label>
                        <input type="text" id="code" class="form-control code" name="code" readonly />
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-text">Category Title<span class="text-danger">*)</span></label>
                        <input type="text" id="name" class="form-control name" name="name" />
                    </div>
                    <div class=" form-group">
                        <label for="thumbnail" class="form-text">Category
                            Thumbnail <small>(The image size
                                should be: 400 X 255)</small>
                        </label>
                        <div class="input-group mb-3">
                            <input type="file" name="thumbnail" class="form-control thumbnail" id="thumbnail"
                                accept="image/*">
                        </div>
                    </div>
                    <input type="hidden" class="id_category" name="id_category">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary modal-btn" name="update_category">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- delete category -->
<div class="modal text-gray-900" id="modalDeleteCategory" tabindex="-1">
    <form action="../page/categories/action_categories.php" method="POST" class="modal-form"
        enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Category</h5>
                    <button type="button" class="btn-close modal-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this category <b class="name"></b>?</p>

                </div>
                <input type="hidden" class="id_category" name="id_category">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger modal-btn" name="delete_category">Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>