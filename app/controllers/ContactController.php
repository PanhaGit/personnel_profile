<?php
require_once __DIR__ . '/../service/ContactService.php';

class ContactController
{
    private ContactService $service;

    public function __construct()
    {
        $this->service = new ContactService();
    }

    public function index()
    {
        return $this->service->getAll();
    }

    public function store($name = null, $email = null, $message = null)
    {
        if ($name === null)
            $name = $_POST['name'] ?? '';
        if ($email === null)
            $email = $_POST['email'] ?? '';
        if ($message === null)
            $message = $_POST['message'] ?? '';

        // validate
        $name = trim($name);
        $email = trim($email);
        $message = trim($message);

        if (empty($name) || empty($email) || empty($message)) {
            return false;
        }

        // Save message
        return $this->service->create($name, $email, $message);
    }


    public function destroy()
    {
        if (isset($_GET['id'])) {
            $this->service->delete($_GET['id']);
            exit;
        }
    }
}
