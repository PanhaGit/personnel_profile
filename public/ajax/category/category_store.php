<?php
require_once __DIR__ . '/../../../app/controllers/CategoryController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['category_name'] ?? '';
    $status = $_POST['status'] ?? 0;

    if ($name != '') {
        $controller = new CategoryController();
        $controller->addCategory($name, $status);
        echo "success";
    } else {
        echo "error";
    }
}
