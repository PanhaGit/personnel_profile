<aside class="layout-sidebar bg-dark vh-100 p-3">
    <div class="text-center mb-4">
        <img style="width:70px"
             src="https://png.pngtree.com/png-clipart/20230110/ourmid/pngtree-matcha-drink-icon-or-logo-png-image_6557157.png"
             alt="Logo">
    </div>

    <ul class="nav flex-column">

        <!-- Dashboard -->
        <li class="nav-item">
            <a href="index.php?page=dashboard"
               class="nav-link <?= (($_GET['page'] ?? 'dashboard') == 'dashboard') ? 'active text-white bg-primary' : 'text-white' ?>">
                <i class="fa-solid fa-gauge-high me-2"></i> Dashboard
            </a>
        </li>

        <!-- Category Dropdown -->
        <li class="nav-item">
            <a class="nav-link text-white d-flex justify-content-between align-items-center"
               data-bs-toggle="collapse" href="#categoryMenu" role="button" aria-expanded="<?= in_array($_GET['page'] ?? '', ['category','skills']) ? 'true' : 'false' ?>" aria-controls="categoryMenu">
                <span><i class="fa-solid fa-list-check me-2"></i> Category</span>
                <i class="fa fa-chevron-down"></i>
            </a>
            <div class="collapse <?= in_array($_GET['page'] ?? '', ['category','skills']) ? 'show' : '' ?>" id="categoryMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a href="index.php?page=category"
                           class="nav-link <?= ($_GET['page'] ?? '') == 'category' ? 'active text-white bg-primary' : 'text-white' ?>">
                            <i class="fa-solid fa-folder me-1"></i> Categories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?page=skills"
                           class="nav-link <?= ($_GET['page'] ?? '') == 'skills' ? 'active text-white bg-primary' : 'text-white' ?>">
                            <i class="fa-solid fa-code me-1"></i> Skills
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Projects Dropdown -->
        <li class="nav-item">
            <a class="nav-link text-white d-flex justify-content-between align-items-center"
               data-bs-toggle="collapse" href="#projectMenu" role="button" aria-expanded="<?= ($_GET['page'] ?? '') == 'projects' ? 'true' : 'false' ?>" aria-controls="projectMenu">
                <span><i class="fa-solid fa-briefcase me-2"></i> Projects</span>
                <i class="fa fa-chevron-down"></i>
            </a>
            <div class="collapse <?= ($_GET['page'] ?? '') == 'projects' ? 'show' : '' ?>" id="projectMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a href="index.php?page=projects"
                           class="nav-link <?= ($_GET['page'] ?? '') == 'projects' ? 'active text-white bg-primary' : 'text-white' ?>">
                            <i class="fa-solid fa-folder-open me-1"></i> All Projects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?page=project_link"
                           class="nav-link <?= ($_GET['page'] ?? '') == 'project_link' ? 'active text-white bg-primary' : 'text-white' ?>">
                            <i class="fa-solid fa-folder-open me-1"></i> Project Links
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Education -->
        <li class="nav-item">
            <a href="index.php?page=education"
               class="nav-link <?= ($_GET['page'] ?? '') == 'education' ? 'active text-white bg-primary' : 'text-white' ?>">
                <i class="fa-solid fa-graduation-cap me-2"></i> Education
            </a>
        </li>

        <!-- Experience -->
        <li class="nav-item">
            <a href="index.php?page=experience"
               class="nav-link <?= ($_GET['page'] ?? '') == 'experience' ? 'active text-white bg-primary' : 'text-white' ?>">
                <i class="fa-solid fa-briefcase-tie me-2"></i> Experience
            </a>
        </li>

    </ul>
</aside>
