<?php
$currentPage = $_GET['page'] ?? 'dashboard';

function isActiveLink(string $page, string $currentPage): string
{
    return $page === $currentPage ? 'active text-white bg-primary' : 'text-white';
}

function isActiveMenu(array $pages, string $currentPage): string
{
    return in_array($currentPage, $pages) ? 'show' : '';
}

// sidebar menu
$sidebarMenu = [
    [
        'title' => 'Dashboard',
        'icon' => 'bi-speedometer2',
        'page' => 'dashboard',
    ],
    [
        'title' => 'Category',
        'icon' => 'bi-list-check',
        'submenu' => [
            ['title' => 'Categories', 'icon' => 'bi-folder', 'page' => 'category'],
            ['title' => 'Skills', 'icon' => 'bi-code-slash', 'page' => 'skills'],
        ]
    ],
    [
        'title' => 'Projects',
        'icon' => 'bi-briefcase',
        'submenu' => [
            ['title' => 'All Projects', 'icon' => 'bi-folder2-open', 'page' => 'projects'],
            ['title' => 'Project Links', 'icon' => 'bi-link-45deg', 'page' => 'project_link'],
        ]
    ],
    [
        'title' => 'Education',
        'icon' => 'bi bi-book',
        'submenu' => [
            ['title' => 'Education', 'icon' => 'fa-solid fa-school', 'page' => 'education'],
            ['title' => 'Academic', 'icon' => 'bi-mortarboard', 'page' => 'academic'],
            ['title' => 'Clubs', 'icon' => 'bi-people', 'page' => 'clubs'],
        ]
    ],
    [
        'title' => 'Contact',
        'icon' => 'bi-person-badge',
        'page' => 'contact',
    ],
];
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<aside class="layout-sidebar vh-100 p-3">
    <div class="text-center mb-4">
        <img style="width:70px"
            src="https://png.pngtree.com/png-clipart/20230110/ourmid/pngtree-matcha-drink-icon-or-logo-png-image_6557157.png"
            alt="Logo">
    </div>

    <ul class="nav flex-column">
        <?php foreach ($sidebarMenu as $menuItem): ?>
            <?php if (isset($menuItem['submenu'])): ?>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                        href="#<?= strtolower(str_replace(' ', '', $menuItem['title'])) ?>Menu" role="button"
                        aria-expanded="<?= isActiveMenu(array_column($menuItem['submenu'], 'page'), $currentPage) ? 'true' : 'false' ?>"
                        aria-controls="<?= strtolower(str_replace(' ', '', $menuItem['title'])) ?>Menu">
                        <span><i class="fa-solid <?= $menuItem['icon'] ?> me-2"></i> <?= $menuItem['title'] ?></span>
                        <i class="fa fa-chevron-down"></i>
                    </a>
                    <div class="collapse <?= isActiveMenu(array_column($menuItem['submenu'], 'page'), $currentPage) ?>"
                        id="<?= strtolower(str_replace(' ', '', $menuItem['title'])) ?>Menu">
                        <ul class="nav flex-column ms-3">
                            <?php foreach ($menuItem['submenu'] as $subItem): ?>
                                <li class="nav-item">
                                    <a href="index.php?page=<?= $subItem['page'] ?>"
                                        class="nav-link <?= isActiveLink($subItem['page'], $currentPage) ?>">
                                        <i class="fa-solid <?= $subItem['icon'] ?> me-1"></i> <?= $subItem['title'] ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a href="index.php?page=<?= $menuItem['page'] ?>"
                        class="nav-link <?= isActiveLink($menuItem['page'], $currentPage) ?>">
                        <i class="fa-solid <?= $menuItem['icon'] ?> me-2"></i> <?= $menuItem['title'] ?>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</aside>