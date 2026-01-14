<?php
require_once __DIR__ . '/../../../../../app/controllers/ContactController.php';
$controller = new ContactController();

// get all messages
$getMessage = $controller->index();
?>

<div class="layout-content">
    <header class="layout-header d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <button id="toggleSidebar" class="btn btn-outline-secondary">
                <i class="fa fa-bars"></i>
            </button>
            <h2 class="m-0">
                Contact Messages <span class="badge bg-primary">
                    <?= count($getMessage) ?>
                </span>
            </h2>
        </div>
    </header>

    <!--modal-->
    <div class="modal fade" id="model" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">View Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="form">
                        <input type="hidden" name="id">

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" readonly name="name" id="name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" readonly name="email" id="email">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" id="message" class="form-control" readonly></textarea>
                        </div>

                        <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">Close</button>
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
                        <th>Email</th>
                        <th>Message</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($getMessage)): ?>
                        <tr>
                            <td colspan="5">No Data</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($getMessage as $index => $row): ?>
                            <tr data-id="<?= $row['id'] ?>">
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($row["name"]) ?></td>
                                <td><?= htmlspecialchars($row["email"]) ?></td>
                                <td><?= htmlspecialchars($row["message"]) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-info btnView text-white" data-id="<?= $row['id'] ?>"
                                        title="View Message">
                                        <i class="fas fa-eye"></i>
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
    const modelElement = document.getElementById('model');
    const contactModal = new bootstrap.Modal(modelElement);

    const btnViewOne = document.querySelectorAll(".btnView");

    btnViewOne.forEach((btn) => {
        btn.addEventListener("click", () => {
            const row = btn.closest("tr");

            // get table data
            const name = row.querySelector("td:nth-child(2)").textContent;
            const email = row.querySelector("td:nth-child(3)").textContent;
            const message = row.querySelector("td:nth-child(4)").textContent;

            // file modal
            document.getElementById("name").value = name;
            document.getElementById("email").value = email;
            document.getElementById("message").value = message;

            // show modal
            contactModal.show();
        });
    });
</script>