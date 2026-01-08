<?php
require_once __DIR__ . "/../../../../../app/controllers/ClubController.php";
$controller = new ClubController();
$clubList = $controller->index();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="layout-content">

    <!-- HEADER -->
    <header class="layout-header d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <button id="toggleSidebar" class="btn btn-outline-secondary">
                <i class="fa fa-bars"></i>
            </button>
            <h2 class="m-0">Clubs & Activities</h2>
        </div>

        <button class="btn btn-success" id="btnNew">
            <i class="fa fa-plus"></i> Add Club
        </button>
    </header>

    <!-- MODAL -->
    <div class="modal fade" id="model">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Club / Activity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="form">

                        <input type="hidden" id="id" name="id">

                        <label>Club / Organization Name</label>
                        <input type="text" class="form-control mb-3" name="club_name" id="club_name" required>

                        <label>Status</label>
                        <select class="form-select mb-3" name="status" id="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>

                        <button class="btn btn-primary w-100">
                            <i class="fa fa-save"></i> Save
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="layout-main">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Club Name</th>
                    <th>Status</th>
                    <th width="120">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($clubList)): ?>
                    <tr>
                        <td colspan="4">No Data</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($clubList as $index => $row): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($row["club_name"]) ?></td>
                            <td>
                                <span class="badge bg-<?= $row["status"] == 1 ? "success" : "secondary" ?>">
                                    <?= $row["status"] == 1 ? "Active" : "Inactive" ?>
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary btnEdit" data-data-edit='<?= json_encode($row) ?>'>
                                    <i class="fa fa-edit"></i>
                                </button>

                                <button class="btn btn-sm btn-danger btnDelete" data-id="<?= $row["id"] ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const model = document.getElementById("model");
    const showModel = new bootstrap.Modal(model);
    const btnNew = document.getElementById("btnNew");
    const form = document.getElementById("form");
    const modalTitle = document.getElementById("modalTitle");
    const path = "/personnel_profile/public/ajax/club/";

    btnNew.addEventListener("click", () => {
        form.reset();
        document.getElementById("id").value = "";
        modalTitle.textContent = "Add Club / Activity";
        showModel.show();
    });

    // SAVE / UPDATE
    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const idTmp = document.getElementById("id").value;
        const url = idTmp ? path + "club_update.php" : path + "club_store.php";

        fetch(url, {
            method: "POST",
            body: formData
        })
            .then(res => res.text())
            .then(data => {
                if (data.trim() === "success") {
                    alert(idTmp ? "Updated successfully!" : "Created successfully!");
                    showModel.hide();
                    location.reload();
                } else {
                    alert(data);
                }
            });
    });

    // EDIT
    document.querySelectorAll(".btnEdit").forEach(btn => {
        btn.addEventListener("click", () => {
            const club = JSON.parse(btn.dataset.dataEdit);

            document.getElementById("id").value = club.id;
            document.getElementById("club_name").value = club.club_name;
            document.getElementById("status").value = club.status;

            modalTitle.textContent = "Update Club";
            showModel.show();
        });
    });

    // DELETE
    document.querySelectorAll(".btnDelete").forEach(btn => {
        btn.addEventListener("click", () => {
            if (!confirm("Delete this club?")) return;

            fetch(path + "club_delete.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id: btn.dataset.id })
            })
                .then(res => res.text())
                .then(data => {
                    if (data.trim() === "success") {
                        location.reload();
                    } else {
                        alert(data);
                    }
                });
        });
    });
</script>