<?php
require_once __DIR__ . '/../service/ClubService.php';

class ClubController
{
    private ClubService $service;

    public function __construct()
    {
        $this->service = new ClubService();
    }

    public function index()
    {
        return $this->service->getAll();
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $this->service->create($_POST);
        }
    }

    public function edit($id)
    {
        return $this->service->getById($id);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $this->service->update($id, $_POST);
        }
    }

    public function destroy($id)
    {
        return $this->service->delete($id);
    }
}
