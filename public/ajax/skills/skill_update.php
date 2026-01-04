<?php

require_once __DIR__ . '/../../../app/controllers/SkillController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $skill_name = $_POST['skill_name'] ?? '';
    $level = $_POST['level'] ?? '';
    $skill_level = $_POST['skill_level'] ?? '';
    $category_id = $_POST['category_id'] ?? 0;
    $status = $_POST['status'] ?? 0;

    if ($skill_name != '') {
        $controller = new SkillController();
        $controller->editSkill($id, $skill_name, $level, $skill_level, $category_id, $status);
        echo "success";
    } else {
        echo "error";
    }
}
?>