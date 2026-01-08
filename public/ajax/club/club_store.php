<?php

require_once __DIR__ . "/../../../app/controllers/ClubController.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $club_name = $_POST["club_name"];
    $status = $_POST["status"] ?? 1;
    if (!empty($club_name) && !empty($status)) {
        $controller = new ClubController();

        $controller->store($club_name, $status);
        echo "success";
    } else {
        echo 'fail';
    }
}

?>