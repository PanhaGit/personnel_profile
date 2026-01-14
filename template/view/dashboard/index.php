<?php
include __DIR__ . "/../../../Helper.php";

$page = $_GET['page'] ?? 'dashboard';

$pageMap = [
    'dashboard' => 'dashboard/dashboard_page_admin.php',
    'skills' => 'skill/skills_page_admin.php',
    'projects' => 'project/projects_page_admin.php',
    'project_link' => 'project/project_link_page_admin.php',
    'category' => 'skill/category_page_admin.php',
    'education' => 'education/education_page_admin.php',
    'academic' => 'education/academic_page_admin.php',
    'clubs' => 'education/clubs_page_admin.php',
    'experience' => 'experience/experience_page_admin.php',
    'contact' => 'contact/contact_page_admin.php',
];

// Include layout
include __DIR__ . "/../../layouts/dashboard/header.php";
include __DIR__ . "/../../layouts/dashboard/sidebar.php";

// Include the page if it exists
if (isset($pageMap[$page]) && file_exists(__DIR__ . "/pages/{$pageMap[$page]}")) {
    include __DIR__ . "/pages/{$pageMap[$page]}";
    include __DIR__ . "/../../layouts/dashboard/footer.php";
} else {
    http_response_code(404);
    include __DIR__ . "/../../view/dashboard/pages/errors/404.php";
}
