<?php
require_once __DIR__ . "/../../../app/controllers/ClubController.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $club_name = $_POST["club_name"];
    $status = $_POST["status"];

    if ($id && $club_name) {
        $controller = new ClubController();
        $controller->update($id, $club_name, $status);
        echo "success";
    } else {
        echo "fail";
    }
}
