<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// name page file
// example dahsboard.php
$allowedPages = [
    'dashboard',
    'skills',
    'projects',
    'category'
];


    include __DIR__ . "/../../layouts/dashboard/header.php";
if (in_array($page, $allowedPages, true)) {
    include __DIR__ . "/../../layouts/dashboard/sidebar.php";
    include __DIR__ . "/pages/$page.php";
    include __DIR__ . "/../../layouts/dashboard/footer.php";
} else {
    http_response_code(404);
    include __DIR__ . "/pages/404.php";
}

