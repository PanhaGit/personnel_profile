<?php
require_once __DIR__ . '/../../../../app/controllers/ProjectController.php';
$controller = new ProjectController();
$projects = $controller->getAllProjects();
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="layout-content">

    <!-- HEADER -->
    <header class="layout-header d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <button id="toggleSidebar" class="btn btn-outline-secondary">
                <i class="fa fa-bars"></i>
            </button>
            <h2 class="m-0">
                Project Links <span class="badge bg-primary"><?= count($projects) ?></span>
            </h2>
        </div>

        <button class="btn btn-success" id="btnNew">
            <i class="fa fa-plus"></i> Add Project
        </button>
    </header>

    <!-- MODAL -->
    <div class="modal fade" id="model">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="form">
                        <input type="hidden" id="projectId" name="id">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Project Name</label>
                                    <input type="text" class="form-control" name="project_name" id="project_name" required>
                                </div>
                                <div class="mb-3">
                                    <label>Type</label>
                                    <input type="text" class="form-control" name="type_project" id="type_project" required>
                                </div>
                                <div class="mb-3">
                                    <label>Source Code (GitHub)</label>
                                    <input type="url" class="form-control" name="project_link_id" id="project_link_id" required>
                                </div>
                                <div class="mb-3">
                                    <label>Demo Link</label>
                                    <textarea class="form-control" name="demo_link" id="demo_link" required></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Description</label>
                                    <input type="text" class="form-control" name="description" id="description" required>
                                </div>
                                <div class="mb-3">
                                    <label>Technologies</label>
                                    <input type="text" class="form-control" name="technologies" id="technologies" required>
                                </div>
                                <div class="mb-3">
                                    <label>Icon Class</label>
                                    <input type="text" class="form-control" name="icon_class" id="icon_class" placeholder="fab fa-github" required>
                                </div>
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select class="form-select" name="status" id="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex gap-2">
                            <button class="btn btn-primary w-50" type="submit">
                                <i class="fas fa-save"></i> Save
                            </button>
                            <button type="button" class="btn btn-danger w-50" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i> Close
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="layout-main">

        <div class="table-responsive">
            <table class="table  table-hover align-middle text-center">
                <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Tech</th>
                    <th>Source</th>
                    <th>Demo</th>
                    <th>Icon</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                <?php if(empty($projects)): ?>
                    <tr><td colspan="10">No Data</td></tr>
                <?php else: ?>
                    <?php foreach($projects as $i=>$p): ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><?= $p["project_name"] ?></td>
                            <td><?= $p["type_project"] ?></td>
                            <td><?= $p["description"] ?></td>
                            <td><?= $p["technologies"] ?></td>

                            <td>
                                <a href="<?= $p["project_link_id"] ?>" target="_blank">
                                    <i class="fab fa-github"></i>
                                </a>
                            </td>

                            <td>
                                <a href="<?= $p["demo_link"] ?>" target="_blank">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </td>

                            <td><i class="<?= $p["icon_class"] ?>"></i></td>

                            <td>
                                <?php if($p["status"]==1): ?>
                                    <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inactive</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <button class="btn btn-sm btn-primary btnEdit"
                                        data-project='<?= json_encode($p) ?>'>
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger btnDelete" data-id="<?= $p["id"] ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
    const modal = new bootstrap.Modal(document.getElementById("model"));
    const form = document.getElementById("form");

    btnNew.onclick = () => {
        form.reset();
        projectId.value = "";
        modalTitle.innerText = "Add Project";
        modal.show();
    };

    document.querySelectorAll(".btnEdit").forEach(btn=>{
        btn.onclick = ()=>{
            const p = JSON.parse(btn.dataset.project);
            projectId.value = p.id;
            project_name.value = p.project_name;
            type_project.value = p.type_project;
            project_link_id.value = p.project_link_id;
            demo_link.value = p.demo_link;
            description.value = p.description;
            technologies.value = p.technologies;
            icon_class.value = p.icon_class;
            status.value = p.status;

            modalTitle.innerText = "Edit Project";
            modal.show();
        }
    });
</script>
