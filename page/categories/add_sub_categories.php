<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h2>Add Sub Categories</h2>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="?page=categories">Categories</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Sub Categories</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-start">
                <div class="mx-3 fs-5"><i class="bi bi-stack"></i></div>
                <div class="fs-5">Add New Sub Category</div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="card w-50">
                <div class="card-header">Sub Category Add Form</div>
                <div class="card-body">
                    <form action="../page/categories/action_categories.php" method="post" data-parsley-validate>
                        <div class="form-group">
                            <label for="name_sub" class="form-text">Sub Categories</label>
                            <input type="text" id="name_sub" class="form-control" name="name_sub"
                                data-parsley-required="true" required />
                        </div>
                        <div class=" form-group">
                            <label for="id_category" class="form-text">Category</label>
                            <select id="id_category" class="form-select" aria-label="Default select example"
                                name="id_category">
                                <option selected disabled>Choose Category</option>
                                <?php
                                $id = $_SESSION['id_instructor'] ?? '';
                                $select_category = $conn->prepare("SELECT * FROM `category` WHERE id_instructor = ?");
                                $select_category->execute([$id]);
                                if($select_category->rowCount() > 0){
                                    while($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <option value="<?= $fetch_category['id_category']; ?>"> <?= $fetch_category['name']; ?>
                                </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-header">Sub Category Table</div>
                <div class="card-body">
                    <table class="table table-striped text-gray-900" id="subCategoryTable">
                        <thead>
                            <tr>
                                <th>Sub Categories</th>
                                <th>Parent</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = $_SESSION['id_instructor'] ?? '';
                            $show_sub_category = $conn->prepare("SELECT * FROM `sub_category`, `category` WHERE sub_category.id_category = category.id_category AND id_instructor = ?");
                            $show_sub_category->execute([$id]);
                            if($show_sub_category->rowCount() > 0){
                                while($fetch_sub_category = $show_sub_category->fetch(PDO::FETCH_ASSOC)){
                            
                            ?>
                            <tr>
                                <td><?= $fetch_sub_category['name_sub']; ?></td>
                                <td><?= $fetch_sub_category['name']; ?></td>
                                <td>
                                    <button class="btn btn-danger modal-btn btn-delete-subCategory"
                                        id="btnDeleteSubCategory" data-bs-toggle="modal"
                                        data-bs-target="#modalDeleteSubCategory"
                                        data-id="<?= $fetch_sub_category['id_sub_category']; ?>"
                                        data-name_sub="<?= $fetch_sub_category['name_sub']; ?>"><i
                                            class="bi bi-trash-fill"></i></button>
                                </td>
                            </tr>
                            <?php
                            }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- modals -->
<!-- delete category -->
<div class="modal text-gray-900" id="modalDeleteSubCategory" tabindex="-1">
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
                    <p>Are you sure you want to delete this sub category <b class="name_sub"></b>?</p>

                </div>
                <input type="hidden" class="id_sub_category" name="id_sub_category">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger modal-btn" name="delete_sub_category">Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>