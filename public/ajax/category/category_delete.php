<?php
require_once __DIR__ . '/../../../app/controllers/CategoryController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;

    if ($id) {
        $controller = new CategoryController();
        $controller->removeCategory($id);
        echo "success";
    } else {
        echo "error";
    }
}
