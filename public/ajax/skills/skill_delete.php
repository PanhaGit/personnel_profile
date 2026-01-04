<?php

require_once __DIR__ . '/../../../app/controllers/SkillController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;

    if ($id) {
        $controller = new SkillController();
        $controller->removeSkill($id);
        echo "success";
    } else {
        echo "error";
    }
}
?>