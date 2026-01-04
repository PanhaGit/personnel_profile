<?php
require_once __DIR__ . '/../../../app/controllers/CategoryController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;
    $name = $_POST['category_name'] ?? '';
    $status = $_POST['status'] ?? 0;

    if ($id && $name != '') {
        $controller = new CategoryController();
        $controller->editCategory($name, $status, $id);
        echo "success";
    } else {
        echo "error";
    }
}
