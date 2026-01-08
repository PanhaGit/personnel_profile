<?php
require_once __DIR__ . '/../model/Clubs.php';

class ClubService
{
    private Clubs $club;

    public function __construct()
    {
        $this->club = new Clubs();
    }

    public function getAll()
    {
        return $this->club->getAll();
    }

    public function getById($id)
    {
        return $this->club->find($id);
    }

    public function create($data)
    {
        return $this->club->store(
            $data['club_name'],
            $data['status']
        );
    }

    public function update($id, $data)
    {
        return $this->club->update(
            $id,
            $data['club_name'],
            $data['status']
        );
    }

    public function delete($id)
    {
        return $this->club->delete($id);
    }
}
