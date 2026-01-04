<?php
require_once __DIR__ . '/../../../../app/controllers/SkillController.php';
$skillController = new SkillController();
$skills = $skillController->listSkills();

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
                Skills <span class="badge bg-primary"><?= count($skills) ?></span>
            </h2>
        </div>

        <div>
            <button class="btn btn-success" id="addSkillBtn">
                <i class="fa fa-plus me-1"></i> Add New Skill
            </button>
        </div>
    </header>

    <div class="modal fade" id="skillModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="skillModalTitle">Add Skill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="skillForm">
                        <input type="hidden" name="id" id="skillId">

                        <div class="mb-3">
                            <label class="form-label">Skill Name</label>
                            <input type="text" class="form-control" name="skill_name" id="skillName" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select" name="category_id" id="categoryId" required>
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $category): ?>
                                    <?php
                                        if($category['status'] != 1) continue;
                                        ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Skill Level (%)</label>
                            <input type="number" class="form-control" name="skill_level" id="skillLevel" min="0"
                                max="100" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Level</label>
                            <select class="form-select" name="level" id="level" required>
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Advanced">Advanced</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100" id="skillFormBtn">Save</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <main class="layout-main">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle text-center">
                <thead class="table-active">
                    <tr>
                        <th>ID</th>
                        <th>Skill Name</th>
                        <th>Category</th>
                        <th>Skill Level (%)</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($skills)): ?>
                        <tr>
                            <td colspan="7">No Data</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($skills as $inex => $skill): ?>
                            <tr>
                                <td><?= $skill['id'] ?></td>
                                <td><?= $skill['skill_name'] ?></td>
                                <td><?= $skill['category_name'] ?></td>
                                <td><?= $skill['skill_level'] ?>%</td>
                                <td><?= $skill['level'] ?></td>
                                <td>
                                    <span class="badge <?= $skill['status'] == 1 ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= $skill['status'] == 1 ? 'Active' : 'Inactive' ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary me-1 edit-btn" data-id="<?= $skill['id'] ?>"
                                        data-name="<?= $skill['skill_name'] ?>" data-category="<?= $skill['category_id'] ?>"
                                        data-skilllevel="<?= $skill['skill_level'] ?>" data-level="<?= $skill['level'] ?>"
                                        data-status="<?= $skill['status'] ?>" data-bs-toggle="tooltip" title="Edit Skill">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $skill['id'] ?>"
                                        data-bs-toggle="tooltip" title="Delete Skill">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<script>
    const skillModalEl = document.getElementById("skillModal");
    const skillModal = new bootstrap.Modal(skillModalEl);
    const skillForm = document.getElementById("skillForm");
    const skillModalTitle = document.getElementById("skillModalTitle");
    const skillFormBtn = document.getElementById("skillFormBtn");
    var path = "/personnel_profile/public/ajax/skills/"


    document.getElementById("addSkillBtn").addEventListener("click", () => {
        skillForm.reset();
        document.getElementById("skillId").value = "";
        skillModalTitle.textContent = "Add Skill";
        skillFormBtn.textContent = "Save";
        skillModal.show();
    });

    document.querySelectorAll(".edit-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const category = this.dataset.category;
            const skillLevel = this.dataset.skilllevel;
            const level = this.dataset.level;
            const status = this.dataset.status;
            // console.log({ id, name, category, skillLevel, level, status });

            document.getElementById("skillId").value = id;
            document.getElementById("skillName").value = name;
            document.getElementById("categoryId").value = category;
            document.getElementById("skillLevel").value = skillLevel;
            document.getElementById("level").value = level;
            document.getElementById("status").value = status;

            skillModalTitle.textContent = "Edit Skill";
            skillFormBtn.textContent = "Update";
            skillModal.show();
        });
    });

    skillForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const id = document.getElementById("skillId").value;
        const url = id ? path + "skill_update.php" : path + "skill_store.php";

        fetch(url, { method: "POST", body: new FormData(this) })
            .then(res => res.text())
            .then(data => {
                if (data.trim() === "success") {
                    alert(id ? "Skill updated successfully" : "Skill added successfully");
                    location.reload();
                } else {
                    alert("Failed to save skill");
                }
            });
    });

    document.querySelectorAll(".delete-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            if (!confirm("Are you sure you want to delete this skill?")) return;
            const id = this.dataset.id;

            fetch(path + "skill_delete.php", {
                method: "POST",
                body: new URLSearchParams({ id: id })
            })
                .then(res => res.text())
                .then(data => {
                    if (data.trim() === "success") {
                        alert("Skill deleted successfully");
                        location.reload();
                    } else {
                        alert("Failed to delete skill");
                    }
                });
        });
    });
</script>