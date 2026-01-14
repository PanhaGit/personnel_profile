<?php
require_once __DIR__ . '/../../../../../app/controllers/ProjectLinkController.php';
$projectLinkController = new ProjectLinkController();

$projectLinks = $projectLinkController->listProjectLinks();

?>

<div class="layout-content">
    <header class="layout-header d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <button id="toggleSidebar" class="btn btn-outline-secondary">
                <i class="fa fa-bars"></i>
            </button>
            <h2 class="m-0">
                Project Link <span class="badge bg-primary"><?= count($projectLinks) ?></span>
            </h2>
        </div>

        <div>
            <button class="btn btn-success" id="addBtn">
                <i class="fa fa-plus me-1"></i> Add New Project Link
            </button>
        </div>
    </header>

    <!-- Modal -->
    <div class="modal fade" id="model" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Project Link</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="form">
                        <input type="hidden" name="id" id="projectLinkId">

                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="link_type" id="link_type" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Icon class</label>
                            <input type="text" class="form-control" name="icon_class" id="icon_class" required
                                placeholder="example: fab fa-github fa-lg">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">URL</label>
                            <textarea name="source_code_url" id="source_code_url" class="form-control"
                                placeholder="https://github.com/PanhaGit/personnel_profile" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" id="categoryStatus">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100" id="formBtn">Save</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <main class="layout-main">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle text-center rounded">
                <thead class="table-active">
                    <tr>
                        <th>NO</th>
                        <th>Name</th>
                        <th>ICON</th>
                        <th>URL</th>
                        <th>Status</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($projectLinks)): ?>
                        <tr>
                            <td colspan="6">No Data</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($projectLinks as $index => $row): ?>
                            <tr data-id="<?= $row['id'] ?>">
                                <td><?= $index + 1 ?></td>
                                <td><?= $row["link_type"] ?></td>
                                <td><i class="<?= $row["icon_class"] ?>"></i></td>
                                <td>
                                    <a href="<?= $row["source_code_url"] ?>" target="_blank"
                                        title="<?= $row["source_code_url"] ?>">
                                        Project Link
                                    </a>
                                </td>
                                <td>
                                    <span class="badge <?= $row["status"] == 1 ? "bg-success" : "bg-danger" ?>">
                                        <?= $row["status"] == 1 ? "Active" : "Inactive" ?>
                                    </span>
                                </td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-sm btn-primary me-1 btnEdit" title="Edit Project">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <!-- Delete Button -->
                                    <button class="btn btn-sm btn-danger btnDelete" title="Delete Project">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <!--            <nav>-->
            <!--                <ul class="pagination justify-content-center mt-3">-->
            <!--                    --><?php //for($i=1; $i<=$pagination['totalPages']; $i++): ?>
            <!--                        <li class="page-item --><?php //= $i==$pagination['currentPage']?'active':'' ?><!--">-->
            <!--                            <a class="page-link" href="?page=--><?php //= $i ?><!--">--><?php //= $i ?><!--</a>-->
            <!--                        </li>-->
            <!--                    --><?php //endfor; ?>
            <!--                </ul>-->
            <!--            </nav>-->
        </div>
    </main>
</div>

<script>
    const modelElement = document.getElementById('model');
    const categoryModal = new bootstrap.Modal(modelElement);
    const addBtn = document.getElementById('addBtn');
    const projectLinkForm = document.getElementById('form');
    const btn = document.getElementById('formBtn');
    const path = "/personnel_profile/public/ajax/project_link/";

    // Show Add Modal
    addBtn.addEventListener('click', () => {
        projectLinkForm.reset();
        document.getElementById('projectLinkId').value = '';
        document.getElementById('modalTitle').innerText = 'Add Project Link';
        btn.innerText = 'Save';
        categoryModal.show();
    });

    // Handle Edit Buttons
    document.querySelectorAll('.btnEdit').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const id = row.dataset.id;
            const link_type = row.children[1].innerText;
            const icon_class = row.children[2].querySelector('i').className;
            const source_code_url = row.children[3].querySelector('a').href;
            const status_value = row.children[4].innerText === 'Active' ? 1 : 0;

            // console.log({
            //     id,
            //     link_type,
            //     icon_class,
            //     source_code_url,
            //     status_value
            // })
            document.getElementById('projectLinkId').value = id;
            document.getElementById('link_type').value = link_type;
            document.getElementById('icon_class').value = icon_class;
            document.getElementById('source_code_url').value = source_code_url;
            document.getElementById('categoryStatus').value = status_value;

            document.getElementById('modalTitle').innerText = 'Update Project Link';
            btn.innerText = 'Update';
            categoryModal.show();
        });
    });

    // Handle Delete Buttons
    document.querySelectorAll('.btnDelete').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const id = row.dataset.id;
            if (!confirm('Are you sure you want to delete this project link?')) return;

            fetch(path + "project_link_delete.php", {
                method: "POST",
                body: new URLSearchParams({ id: id })
            })
                .then(res => res.text())
                .then(data => {
                    if (data.trim() === "success") {
                        row.remove();
                        alert('Deleted successfully!');
                    } else {
                        alert('Delete failed!');
                    }
                });
        });
    });

    // Handle Add / Update Form Submit
    projectLinkForm.addEventListener('submit', function (e) {
        e.preventDefault();
        btn.innerText = 'Saving...';

        // const formData = new FormData(projectLinkForm);
        const tmpId = document.getElementById("projectLinkId").value;
        const url = tmpId ? path + "project_link_update.php" : path + "project_link_store.php";
        // console.log(formData) //
        console.log(url)
        fetch(url, { method: "POST", body: new FormData(this) })

            .then(res => res.text())
            .then(data => {
                console.log(data)
                if (data.trim() === "success") {
                    alert(tmpId ? "Project Link updated successfully!" : "Project Link added successfully!");
                    location.reload();
                } else {
                    alert("Operation failed. Please try again.");
                }
            })
            .catch(err => {
                console.error(err);
                btn.innerText = 'Save';
            });
    });
</script>