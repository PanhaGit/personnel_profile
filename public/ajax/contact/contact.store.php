<?php
require __DIR__ . "/../../../app/controllers/ContactController.php";

header("Content-Type: application/json");

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = $_POST["name"] ?? '';
        $email = $_POST["email"] ?? '';
        $message = $_POST["message"] ?? '';

        $controller = new ContactController();
        $result = $controller->store($name, $email, $message);

        if ($result) {
            http_response_code(201);
            echo json_encode(["status" => "success", "message" => "Message sent!"]);
        } else {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "All fields are required or failed to save."]);
        }
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
