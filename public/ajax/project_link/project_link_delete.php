<?php
require_once __DIR__ . '/../../../app/controllers/ProjectLinkController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;

    if ($id) {
        $controller = new ProjectLinkController();
        $controller->removeProjectLink($id);
        echo "success";
    } else {
        echo "error";
    }
}
