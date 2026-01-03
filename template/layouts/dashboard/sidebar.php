<aside class="layout-sidebar">
    <div style="display: flex; justify-content: center; align-items: center;">
        <img
                style="width: 70px"
                src="https://png.pngtree.com/png-clipart/20230110/ourmid/pngtree-matcha-drink-icon-or-logo-png-image_6557157.png" alt="">
    </div>

    <a href="index.php?page=dashboard" class="<?= (isset($_GET['page']) ? $_GET['page'] : 'dashboard') == 'dashboard' ? 'active' : '' ?>">
        <i class="fa fa-house"></i> <span>Dashboard</span>
    </a>

    <a href="index.php?page=category" class="<?= (isset($_GET['page']) ? $_GET['page'] : '') == 'category' ? 'active' : '' ?>">
        <i class="fa-solid fa-layer-group"></i> <span>Category</span>
    </a>
    <a href="index.php?page=skills" class="<?= (isset($_GET['page']) ? $_GET['page'] : '') == 'skills' ? 'active' : '' ?>">
        <i class="fa fa-code"></i> <span>Skills</span>
    </a>

    <a href="index.php?page=projects" class="<?= (isset($_GET['page']) ? $_GET['page'] : '') == 'projects' ? 'active' : '' ?>">
        <i class="fa fa-briefcase"></i> <span>Projects</span>
    </a>

    <a href="index.php?page=education" class="<?= (isset($_GET['page']) ? $_GET['page'] : '') == 'education' ? 'active' : '' ?>">
        <i class="fa fa-graduation-cap"></i> <span>Education</span>
    </a>

    <a href="index.php?page=experience" class="<?= (isset($_GET['page']) ? $_GET['page'] : '') == 'experience' ? 'active' : '' ?>">
        <i class="fa fa-user-tie"></i> <span>Experience</span>
    </a>
</aside>
