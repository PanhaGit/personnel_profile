<?php
require_once __DIR__ . '/../../../app/controllers/ProjectLinkController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $source_code_url = $_POST['source_code_url'] ?? '';
    $link_type = $_POST['link_type'] ?? '';
    $icon_class = $_POST['icon_class'] ?? '';
    $status = $_POST['status'] ?? 0;

    if ($source_code_url != '') {
        $controller = new ProjectLinkController();
        $controller->addProjectLink($source_code_url, $link_type, $icon_class, $status);
        echo "success";
    } else {
        echo "error";
    }
}
