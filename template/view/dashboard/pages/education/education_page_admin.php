<?php
//include __DIR__ . '/../../../../../Helper.php';
require_once __DIR__ . '/../../../../../app/controllers/EducationController.php';
$controller = new EducationController();
$education = $controller->listAllAsTable();
//dd($controller);
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
<!--                Project Links <span class="badge bg-primary">--><?php //= count($projects) ?><!--</span>-->
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
                        <input type="hidden" id="educationId" name="id">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>University Name</label>
                                    <input type="text" class="form-control" name="university_name" id="university_name" required>
                                </div>

                                <div class="mb-3">
                                    <label>Degree</label>
                                    <input type="text" class="form-control" name="degree" id="degree" required>
                                </div>

                                <div class="mb-3">
                                    <label>Field of Study</label>
                                    <input type="text" class="form-control" name="field_of_study" id="field_of_study" required>
                                </div>

                                <div class="mb-3">
                                    <label>Start Year</label>
                                    <input type="number" class="form-control" name="start_year" id="start_year" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>End Year</label>
                                    <input type="number" class="form-control" name="end_year" id="end_year" required>
                                </div>

                                <div class="mb-3">
                                    <label>GPA</label>
                                    <input type="text" class="form-control" name="gpa" id="gpa" required>
                                </div>

                                <div class="mb-3">
                                    <label>Year of Study</label>
                                    <input type="text" class="form-control" name="year_of_study" id="year_of_study" required>
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
            <table class="table table-bordered  table-hover align-middle text-center">
                <thead class="table-light">
                <tr>
                    <th>NO</th>
                    <th>University Name</th>
                    <th>Degree</th>
                    <th>Field of Study</th>
                    <th>Start year</th>
                    <th>End year</th>
                    <th>GPA</th>
                    <th>Year of Study</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                <?php if (empty($education)): ?>
                    <tr>
                        <td colspan="10">No Data</td>
                    </tr>
                <?php else: ?>
                <?php endif;?>

                <?php foreach ($education as $index=>$edu): ?>
                    <tr>
                        <td><?= $index+1 ?></td>
                        <td>The University of Cambodia</td>
                        <td>Bachelor of Science</td>
                        <td>Information Technology</td>
                        <td>2020</td>
                        <td>2024</td>
                        <td>3.70</td>
                        <td>Final Year (4th Year)</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>

            </table>
        </div>
    </div>

</div>
