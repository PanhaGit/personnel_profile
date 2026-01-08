<?php
require_once __DIR__ . "/../../../app/controllers/ClubController.php";

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id'])) {
    $controller = new ClubController();
    $controller->destroy($data['id']);
    echo "success";
} else {
    echo "fail";
}
