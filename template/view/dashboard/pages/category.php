<?php
require_once __DIR__ . '/../../../../app/controllers/CategoryController.php';
$categoryController = new CategoryController();
$categories = $categoryController->listCategories();
?>

<div class="layout-content">
    <header class="layout-header d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <button id="toggleSidebar" class="btn btn-outline-secondary">
                <i class="fa fa-bars"></i>
            </button>
            <h2 class="m-0">
                Category <span class="badge bg-primary"><?= count($categories) ?></span>
            </h2>
        </div>

        <div>
            <button class="btn btn-success" id="addCategoryBtn">
                <i class="fa fa-plus me-1"></i> Add New Category
            </button>
        </div>
    </header>


    <!-- it work 2 create and uodate modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalTitle">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="categoryForm">
                        <input type="hidden" name="id" id="categoryId">

                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="category_name" id="categoryName" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" id="categoryStatus">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100" id="categoryFormBtn">Save</button>
                    </form>
                </div>

            </div>
        </div>
    </div>



    <!-- Table -->
    <main class="layout-main">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle text-center">
                <thead class="table-active">
                    <tr>
                        <th>NO</th>
                        <th>Skill Name</th>
                        <th>Status</th>
                        <th width="120">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $row => $category): ?>
                        <tr>
                            <td>
                                <?= $row + 1 ?>
                            </td>
                            <td><?= $category['category_name'] ?></td>
                            <td>
                                <span class="badge <?= $category['status'] == 1 ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $category['status'] == 1 ? 'Active' : 'Inactive' ?>
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary me-1 edit-btn" data-id="<?= $category['id'] ?>"
                                    data-name="<?= $category['category_name'] ?>" data-status="<?= $category['status'] ?>"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Category">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $category['id'] ?>"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Category">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<script>
    const categoryModalEl = document.getElementById("categoryModal");
    const categoryModal = new bootstrap.Modal(categoryModalEl);

    const categoryForm = document.getElementById("categoryForm");
    const categoryModalTitle = document.getElementById("categoryModalTitle");
    const categoryFormBtn = document.getElementById("categoryFormBtn");

    var path = "/personnel_profile/public/ajax/category/";

    document.getElementById("addCategoryBtn").addEventListener("click", () => {
        categoryModalTitle.textContent = "Add Category";
        categoryFormBtn.textContent = "Save";
        categoryForm.reset();
        document.getElementById("categoryId").value = "";
        categoryModal.show();
    });

    // edit button
    document.querySelectorAll(".edit-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const status = this.dataset.status;

            categoryModalTitle.textContent = "Edit Category";
            categoryFormBtn.textContent = "Update";

            document.getElementById("categoryId").value = id;
            document.getElementById("categoryName").value = name;
            document.getElementById("categoryStatus").value = status;

            categoryModal.show();
        });
    });

    // it work 2 method create and update
    categoryForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const id = document.getElementById("categoryId").value;
        // C:\xampp\htdocs\personnel_profile\public\ajax\category\category_store.php
        const url = id ? path + "category_update.php" : path + "category_store.php";

        fetch(url, {
            method: "POST",
            body: new FormData(this)
        })
            .then(res => res.text())
            .then(data => {
                if (data.trim() === "success") {
                    alert(id ? "Category updated successfully" : "Category added successfully");
                    location.reload();
                } else {
                    alert("Failed to save category");
                }
            });
    });

    // delete
    document.querySelectorAll(".delete-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            if (confirm("Are you sure you want to delete this category?")) {
                const id = this.dataset.id;
                fetch(path + "category_delete.php", {
                    method: "POST",
                    body: new URLSearchParams({ id: id })
                })
                    .then(res => res.text())
                    .then(data => {
                        if (data.trim() === "success") {
                            alert("Category deleted successfully");
                            location.reload();
                        } else {
                            alert("Failed to delete category");
                        }
                    });
            }
        });
    });
</script>